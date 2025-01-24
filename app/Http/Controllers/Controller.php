<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\M_model; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home()
    {
        
        if (Session::get('level') > 0) {
            $model = new M_model();
            $id_user = Session::get('id'); // Ambil ID user dari session
            
            // Tambahkan log aktivitas
            $activity = 'Mengakses halaman dashboard';
            $this->addLog($id_user, $activity);

            // Ambil data setting
            $where = ['id_setting' => 1];
            $data['setting'] = $model->getWhere('setting', $where);
            $data['currentMenu'] = 'dashboard'; // Menu aktif

            // Menampilkan view menggunakan echo seperti CodeIgniter
            echo view('header', $data);
            echo view('menu', $data);
            echo view('dashboard', $data);
            echo view('footer');
        } else {
            return redirect()->route('home.login');
        }
    }
    public function login()
    {
        $model= new M_model();
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
        echo view('header', $data);
        echo view('login', $data);

} 

public function aksilogin(Request $request)
{
    $name = $request->input('nama');
    $pw =  $request->input('password');
    $captchaResponse =  $request->input('g-recaptcha-response');
    $backupCaptcha = $request->input('backup_captcha');
    
    $secretKey = '6LdLhiAqAAAAAPxNXDyusM1UOxZZkC_BLCgfyoQf'; // Ganti dengan secret key Anda yang sebenarnya
    $recaptchaSuccess = false;

    $captchaModel = new M_model();

    // Cek koneksi internet
    if ($this->isInternetAvailable()) {
        // Verifikasi reCAPTCHA
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captchaResponse");
        $responseKeys = json_decode($response, true);
        $recaptchaSuccess = $responseKeys["success"];
    }
    
    if ($recaptchaSuccess) {
        // reCAPTCHA berhasil
        $where = [
            'nama_user' => $name,
            'password' => md5($pw),
        ];

        $model = new M_model();
        $check = $model->getWhere('user', $where);

        if ($check) {
            session()->put('id', $check->id_user);
            session()->put('nama', $check->nama_user);
            session()->put('level', $check->level);
           
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('error', 'Login gagal, silakan coba lagi.');

        }
    } else {
        // Validasi CAPTCHA offline
        $storedCaptcha = Session::get('captcha_code'); // Ambil CAPTCHA dari session
        
        if ($storedCaptcha !== null) {
            if ($storedCaptcha === $backupCaptcha) {
                // CAPTCHA valid
                $where = [
                    'nama_user' => $name,
                    'password' => md5($pw),
                ];

                $model = new M_model();
                $check = $model->getWhere('user', $where);

                if ($check) {
                    session()->put('id', $check->id_user);
                    session()->put('nama', $check->nama_user);
                    session()->put('level', $check->level);
                   
                    return redirect()->route('home');
                } else {
                    return redirect()->back()->with('error', 'Login gagal, silakan coba lagi.');

                }
            } else {
                // CAPTCHA tidak valid
                return redirect()->route('home.login')->with('error', 'Invalid CAPTCHA.');
            }
        } else {
            return redirect()->route('home.login')->with('error', 'CAPTCHA session is not set.');
        }
    }
}

public function generateCaptcha()
{
    // Generate CAPTCHA code
    $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

    // Simpan CAPTCHA code di session
    Session::put('captcha_code', $code);

    // Buat gambar CAPTCHA
    $image = imagecreatetruecolor(120, 40);
    $bgColor = imagecolorallocate($image, 255, 255, 255); // Background putih
    $textColor = imagecolorallocate($image, 0, 0, 0);     // Teks hitam

    // Tambahkan teks ke gambar
    imagefilledrectangle($image, 0, 0, 120, 40, $bgColor);
    imagestring($image, 5, 10, 10, $code, $textColor);

    // Kirim gambar sebagai response
    ob_start();
    imagepng($image); // Hasilkan output PNG
    $imageData = ob_get_clean(); // Ambil data dari buffer

    // Hapus resource gambar
    imagedestroy($image);

    // Kirim response ke browser
    return response($imageData, 200)->header('Content-Type', 'image/png');
}


    private function isInternetAvailable()
    {
        $connected = @fsockopen("www.google.com", 80);
        if ($connected) {
            fclose($connected);
            return true;
        }
        return false;
    }
    public function logout()
{
    // Destroy the session
    session::flush(); // Atau bisa menggunakan auth()->logout() jika menggunakan autentikasi Laravel
    
    // Redirect ke halaman login
    return redirect()->route('home.login'); // Mengarahkan ke rute 'home.login'
}


    public function profile($id)
    {
        if (!session()->has('level') || !session()->has('id')) {
            // Jika session level atau id tidak ada, arahkan ke halaman login
            return redirect()->route('home.login');
        }
        // Cek level user dari session
        if (session()->get('level') == 0 || session()->get('level') == 1) {
            $model = new M_model();
            $id_user = session()->get('id');
            
            // Cek apakah ID yang diminta sesuai dengan ID user yang ada di session
            if ($id == $id_user) {
                $activity = 'Mengakses halaman profile'; // Deskripsi aktivitas
                $this->addLog($id_user, $activity);
    
                // Ambil data user
                $where = ['id_user' => $id]; // Query user berdasarkan ID
                $data['user'] = $model->getWhere('user', $where);
    
                // Ambil setting
                $where = ['id_setting' => 1]; // Query setting
                $data['setting'] = $model->getWhere('setting', $where);
                $data['currentMenu'] = 'profile'; // Sesuaikan dengan menu yang aktif
    
                // Return view dengan data
                echo view('header', $data);
                echo view('menu', $data);
                echo view('profile', $data);
                echo view('footer', $data);
            } else {
                // Redirect ke halaman error jika ID tidak sesuai
                return redirect()->route('home.error');
            }
        } else {
            // Redirect ke halaman error jika level user tidak sesuai
            return redirect()->route('home.error');
        }
    }
    

public function aksieprofile(Request $request)
{
    $model = new M_model();

    $id_user = session()->get('id');
    $activity = 'Mengubah data profile'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);

    $a = $request->input('nama');
    $id = $request->input('id');

    $existingBackup = $model->getWhere('backup_user', ['id_user' => $id]);

    if ($existingBackup) {
        // Hapus data lama di user_backup jika ada
        $model->hapus('backup_user', ['id_user' => $id]);
    }

    // Ambil data user lama berdasarkan id_user
    $userLama = $model->getUserById($id);

    // Simpan data user lama ke tabel user_backup
    $backupData = (array) $userLama; // Ubah objek menjadi array
    $model->tambah('backup_user', $backupData);

    $isi = [
        'nama_user' => $a,
        'updated_at' => now(), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    ];

    $model->edit('user', $isi, ['id_user' => $id]);

    return redirect()->route('home.profile', ['id' => $id]);
}


public function aksi_changepass(Request $request)
{
    $model = new M_model();
    $id_user = session()->get('id');
    $activity = 'mengubah password profile'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $oldPassword = $request->input('old');
    $newPassword = $request->input('new');

    // Dapatkan password lama dari database
    $currentPassword = $model->getPassword($id_user);

    // Verifikasi apakah password lama cocok
    if (md5($oldPassword) !== $currentPassword) {
        // Set pesan error jika password lama salah
        return redirect()->back()->withInput()->with('error', 'Password lama tidak valid.');
    }

    // Update password baru
    $data = [
        'password' => md5($newPassword),
        'updated_by' => $id_user,
        'updated_at' => now() // Gunakan helper now() untuk waktu saat ini
    ];
    $where = ['id_user' => $id_user];
    
    $model->edit('user', $data, $where);
    
    // Set pesan sukses
    return redirect()->route('home.profile', ['id' => $id_user])->with('success', 'Password berhasil diperbarui.');


}

    public function log() 
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();

        // Menambahkan log aktivitas ketika user mengakses halaman log
        $id_user = session()->get('id');
        $activity = 'Mengakses halaman log aktivitas';
        $this->addLog($id_user, $activity);
        
        // Ambil data pencarian dari input GET
        $id_user_search = request()->query('id_user');
        $nama_user_search = request()->query('nama_user');
        $activity_search = request()->query('activity');
        $timestamp_search = request()->query('timestamp');
        

        // Mengambil data log aktivitas dengan filter
        $data['logs'] = $model->searchActivityLogs($id_user_search, $nama_user_search, $activity_search, $timestamp_search);
        
        // Menambahkan data pencarian ke array data
        $data['id_user'] = $id_user_search;
        $data['nama_user'] = $nama_user_search;
        $data['activity'] = $activity_search;
        $data['timestamp'] = $timestamp_search;

        // Ambil setting seperti biasa
        $where = array('id_setting' => 1);
        $data['setting'] = $model->getWhere('setting', $where);

        $data['currentMenu'] = 'log';
        echo view('header', $data);
        echo view('menu', $data);
        echo view('log', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

    public function addLog($id_user, $activity)
    {
        $model = new M_model(); // Gunakan model M_kedaikopi
        $id_user = session()->get('id');
        $data = [
            'id_user' => $id_user,
            'activity' => $activity,
            'timestamp' => now(),
        ];
        $model->tambah('activity_log', $data); // Pastikan 'activity_log' adalah nama tabel yang benar
    }   
    

    //user
    public function user()
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        $data['elly'] = $model->tampil('user', 'id_user');
        $data['backup_users'] = []; // Inisialisasi array untuk backup user

        foreach ($data['elly'] as $user) {
            $data['backup_users'][$user->id_user] = $model->getBackupUser($user->id_user);
        }

        $data['satu'] = $model->getWhere('user', ['id_user' => $id_user]);

        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('user', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

public function tambah_user()
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses form tambah user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        

        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('tambah_user', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

public function aksi_tambah_user(Request $request)
    {
        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menambah data user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       
      
        $a =  $request->input('nama');
        $b =  $request->input('level');
        $c = md5( $request->input('password'));
        
    
        
        $isi = array(
            'nama_user' => $a,
            'level' => 1,
            'password' => $c,
            'created_at' => now(), // Waktu saat produk dibuat
            'created_by' => $id_user,
            'isdelete'=> 0 // ID user yang login
            

        );
        $model ->tambah('user', $isi);
        
        return redirect()->route('home.user');
    }

    public function edit_user($id)
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses form edit user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
        $where= array('id_user'=>$id);
        $data['elly']=$model->getwhere('user',$where);

        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('edit_user', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

public function aksi_edit_user(Request $request)
{
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Mengubah data user'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
        
       
    $a =  $request->input('nama');
    $id =  $request->input('id');

    $backupWhere = ['id_user' => $id];
    $existingBackup = $model->getWhere('backup_user', $backupWhere);

    if ($existingBackup) {
        // Hapus data lama di user_backup jika ada
        $model->hapus('backup_user', $backupWhere);
    }

    // Ambil data user lama berdasarkan id_user
    $userLama = $model->getUserById($id);

    // Simpan data user lama ke tabel user_backup
    $backupData = (array) $userLama;  // Ubah objek menjadi array
    $model->tambah('backup_user', $backupData);


    $isi = array(
        'nama_user' => $a,
        'updated_at' =>now(), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    $where = array('id_user' => $id);
    $model->edit('user', $isi, $where);

    return redirect()->route('home.user');
}

public function undo_edit_user($id)
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses form undo edit user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
        $where = array('id_user' => $id);
        $data['elly'] = $model->getwhere('user', $where);

        // Pastikan data yang didapat adalah array atau objek yang dapat diiterasi
        if (!empty($data['elly'])) {
            // Inisialisasi array untuk backup jurusan
            $data['backup_user'] = [];

            // Mendapatkan data backup untuk setiap jurusan jika data 'elly' adalah array
            if (is_array($data['elly'])) {
                foreach ($data['elly'] as $user) {
                    $data['backup_user'][$user->id_user] = $model->getBackupUser($user->id_user);
                }
            } else {
                // Jika hanya satu data, tetap memprosesnya
                $data['backup_user'][$data['elly']->id_user] = $model->getBackupUser($data['elly']->id_user);
            }
        } else {
            $data['backup_user'] = []; // Jika data kosong, set backup_jurusan menjadi array kosong
        }


        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
       
        echo view('undo_edit_user', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

public function aksi_unedit_user(Request $request)
{
    $model = new M_model();
    $id = $request->input('id'); 
    
    if (!$id) {
        return redirect()->route('home.user')->with('error', 'ID user tidak ditemukan.');
    }
    
    $id_user = session()->get('id'); 
    $activity = 'Undo edit data user';
    $this->addLog($id_user, $activity);
    $backupData = $model->getWhere('backup_user', ['id_user' => $id]);
    if ($backupData) {
        $restoreData = (array) $backupData;
        unset($restoreData['id_user']);
        $model->edit('user', $restoreData, ['id_user' => $id]);
        $model->hapus('backup_user', ['id_user' => $id]);
    }

    return redirect()->route('home.user');
}

public function aksi_reset($id)
{
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mereset password user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       
      
    $where = array('id_user' => $id);
    
    $isi = array(
        'password' => md5('12345'),
        'updated_at' =>now(),
        'updated_by' => $id_user
    );
    $model->edit('user', $isi, $where);

    return redirect()->route('home.user');
}

public function hapususer($id){
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus data user'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' =>now() // Format datetime untuk deleted_at
    ];
      
    $model->edit('user', $data, ['id_user' => $id]);

    // Hapus data dari tabel backup_kelas
$where = array('id_user' => $id);
$model->hapus('backup_user', $where);
return redirect()->route('home.user');
}

//event
public function event()
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID event dari session
        $activity = 'Mengakses halaman event'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        $data['elly'] = $model->tampil('event', 'id_event');
        $data['backup_event'] = []; // Inisialisasi array untuk backup user

        foreach ($data['elly'] as $event) {
            $data['backup_event'][$event->id_event] = $model->getBackupevent($event->id_event);
        }


        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'event'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('event', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

public function tambah_event()
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses form tambah event'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('tambah_event', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

public function aksi_tambah_event(Request $request)
    {
        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menambah event'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       
      
        $a =  $request->input('event');
        
        $isi = array(
            'deskripsi_event' => $a,
            'created_at' => now(), // Waktu saat produk dibuat
            'created_by' => $id_user,
            'isdelete'=> 0,
            'status'=> 0
            

        );
        $model ->tambah('event', $isi);
        
        return redirect()->route('home.event');
    }

    public function edit_event($id)
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses form edit event'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
        $where= array('id_event'=>$id);
        $data['elly']=$model->getwhere('event',$where);

        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'event'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('edit_event', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

public function aksi_edit_event(Request $request)
{
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Mengubah data event'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
        
       
    $a =  $request->input('event');
    $id =  $request->input('id');

    $backupWhere = ['id_event' => $id];
    $existingBackup = $model->getWhere('backup_event', $backupWhere);

    if ($existingBackup) {
        // Hapus data lama di user_backup jika ada
        $model->hapus('backup_event', $backupWhere);
    }

    // Ambil data user lama berdasarkan id_user
    $userLama = $model->geteventById($id);

    // Simpan data user lama ke tabel user_backup
    $backupData = (array) $userLama;  // Ubah objek menjadi array
    $model->tambah('backup_event', $backupData);


    $isi = array(
        'deskripsi_event' => $a,
        'updated_at' =>now(), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    $where = array('id_event' => $id);
    $model->edit('event', $isi, $where);

    return redirect()->route('home.event');
}

public function undo_edit_event($id)
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses form undo edit event'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
        $where = array('id_event' => $id);
        $data['elly'] = $model->getwhere('event', $where);

        // Pastikan data yang didapat adalah array atau objek yang dapat diiterasi
        if (!empty($data['elly'])) {
            // Inisialisasi array untuk backup jurusan
            $data['backup_event'] = [];

            // Mendapatkan data backup untuk setiap jurusan jika data 'elly' adalah array
            if (is_array($data['elly'])) {
                foreach ($data['elly'] as $event) {
                    $data['backup_event'][$event->id_event] = $model->getBackupevent($event->id_event);
                }
            } else {
                // Jika hanya satu data, tetap memprosesnya
                $data['backup_event'][$data['elly']->id_event] = $model->getBackupevent($data['elly']->id_event);
            }
        } else {
            $data['backup_event'] = []; // Jika data kosong, set backup_jurusan menjadi array kosong
        }


        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'event'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
       
        echo view('undo_edit_event', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

public function aksi_unedit_event(Request $request)
{
    $model = new M_model();
    $id = $request->input('id'); 
    
    if (!$id) {
        return redirect()->route('home.event')->with('error', 'ID event tidak ditemukan.');
    }
    
    $id_user = session()->get('id'); 
    $activity = 'Undo edit data event';
    $this->addLog($id_user, $activity);
    $backupData = $model->getWhere('backup_event', ['id_event' => $id]);
    if ($backupData) {
        $restoreData = (array) $backupData;
        unset($restoreData['id_event']);
        $model->edit('event', $restoreData, ['id_event' => $id]);
        $model->hapus('backup_event', ['id_event' => $id]);
    }

    return redirect()->route('home.event');
}


public function hapusevent($id){
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus data event'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' =>now(),
        'status'=> 0 
    ];
      
    $model->edit('event', $data, ['id_event' => $id]);

    // Hapus data dari tabel backup_kelas
$where = array('id_event' => $id);
$model->hapus('backup_event', $where);
return redirect()->route('home.event');
}

//jadwal

public function jadwal()
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID event dari session
        $activity = 'Mengakses halaman jadwal'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        $data['elly'] = $model->joinTigaTabel('jadwal', 'event','suara', 'jadwal.id_event = event.id_event', 'jadwal.id_suara = suara.id_suara', 'jadwal.id_jadwal', ['jadwal.isdelete' => 0]);

        //$data['elly'] = $model->tampil('jadwal', 'id_jadwal');

        $data['backup_jadwal'] = []; // Inisialisasi array untuk backup user

        foreach ($data['elly'] as $jadwal) {
            $data['backup_jadwal'][$jadwal->id_jadwal] = $model->getBackupjadwal($jadwal->id_jadwal);
        }
        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'jadwal'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('jadwal', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

public function tambah_jadwal()
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses form tambah jadwal'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        $data['elly'] = $model->tampilkondisi('event', 'id_event', ['isdelete' => 0]);
        $data['suara'] = $model->tampilkondisi('suara', 'id_suara', ['isdelete' => 0]);
        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'jadwal'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('tambah_jadwal', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

public function aksi_tambah_jadwal(Request $request)
    {
        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menambah data jadwal'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $a =  $request->input('event');
        $b =  $request->input('keterangan');
        $c =  $request->input('waktu');
        $d =  $request->input('suara');
        $e =  $request->input('hari');
        $isi = array(
            'id_event' => $a,
            'keterangan' => $b,
            'waktu' => $c,
            'id_suara' => $d,
            'hari' => $e,
            'created_at' => now(), // Waktu saat produk dibuat
            'created_by' => $id_user,
            'isdelete'=> 0 // ID user yang login
         
            

        );
        $model ->tambah('jadwal', $isi);
        
        return redirect()->route('home.jadwal');
    }

    public function edit_jadwal($id)
    {
        if (!session()->has('level') || !session()->has('id')) {
            // Jika session level atau id tidak ada, arahkan ke halaman login
            return redirect()->route('home.login');
        }
        if (session()->get('level') == 0 || session()->get('level') == 1) {
    
            $model = new M_model();
            $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Mengakses form edit jadwal'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
           
            $where= array('id_jadwal'=>$id);
            $data['elly']=$model->getwhere('jadwal',$where);

            $whereevent = ['isdelete' => 0];
            $data['event'] = $model->getWhereres('event', $whereevent); // Ambil data user dengan level 5

            $wheresuara = ['isdelete' => 0];
            $data['suara'] = $model->getWhereres('suara', $wheresuara); // Ambil data user dengan level 5
    
            $where = ['id_setting' => 1];
            $data['setting'] = $model->getWhere('setting', $where);
            $data['currentMenu'] = 'jadwal'; // Sesuaikan dengan menu yang aktif
            echo view('header', $data);
            echo view('edit_jadwal', $data);
            echo view('footer');
        } else {
            return redirect()->route('home.error');
        }
    }

    public function aksi_edit_jadwal(Request $request)
{
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Mengubah data jadwal'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
        
       
    $a =  $request->input('event');
    $b =  $request->input('keterangan');
    $c =  $request->input('waktu');
    $d =  $request->input('suara');
    $e =  $request->input('hari');
    $id =  $request->input('id');

    $backupWhere = ['id_jadwal' => $id];
    $existingBackup = $model->getWhere('backup_jadwal', $backupWhere);

    if ($existingBackup) {
        $model->hapus('backup_jadwal', $backupWhere);
    }

    $userLama = $model->getjadwalById($id);

    $backupData = (array) $userLama; 
    $model->tambah('backup_jadwal', $backupData);


    $isi = array(
        'id_event' => $a,
        'keterangan' => $b,
        'waktu' => $c,
        'id_suara' => $d,
        'hari' => $e,
        'updated_at' =>now(), 
        'updated_by' => $id_user 
    );

    $where = array('id_jadwal' => $id);
    $model->edit('jadwal', $isi, $where);

    return redirect()->route('home.jadwal');
}

public function undo_edit_jadwal($id)
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); 
        $activity = 'Mengakses form undo edit jadwal'; 
        $this->addLog($id_user, $activity);
       
        $where = array('id_jadwal' => $id);
        $data['elly'] = $model->getwhere('jadwal', $where);

        if (!empty($data['elly'])) {
           
            $data['backup_jadwal'] = [];
            if (is_array($data['elly'])) {
                foreach ($data['elly'] as $jadwal) {
                    $data['backup_jadwal'][$jadwal->id_jadwal] = $model->getBackupjadwal($jadwal->id_jadwal);
                }
            } else {
                $data['backup_jadwal'][$data['elly']->id_jadwal] = $model->getBackupjadwal($data['elly']->id_jadwal);
            }
        } else {
            $data['backup_jadwal'] = []; 
        }

        $whereevent = ['isdelete' => 0];
        $data['event'] = $model->getWhereres('event', $whereevent); // Ambil data user dengan level 5

        $wheresuara = ['isdelete' => 0];
        $data['suara'] = $model->getWhereres('suara', $wheresuara); // Ambil data user dengan level 5

        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'jadwal';
        echo view('header', $data);
       
        echo view('undo_edit_jadwal', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

public function aksi_unedit_jadwal(Request $request)
{
    $model = new M_model();
    $id = $request->input('id'); 
    
    if (!$id) {
        return redirect()->route('home.jadwal')->with('error', 'ID jadwal tidak ditemukan.');
    }
    
    $id_user = session()->get('id'); 
    $activity = 'Undo edit data jadwal';
    $this->addLog($id_user, $activity);
    $backupData = $model->getWhere('backup_jadwal', ['id_jadwal' => $id]);
    if ($backupData) {
        $restoreData = (array) $backupData;
        unset($restoreData['id_jadwal']);
        $model->edit('jadwal', $restoreData, ['id_jadwal' => $id]);
        $model->hapus('backup_jadwal', ['id_jadwal' => $id]);
    }

    return redirect()->route('home.jadwal');
}

public function hapusjadwal($id){
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus data jadwal'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' =>now() // Format datetime untuk deleted_at
    ];
      
    $model->edit('jadwal', $data, ['id_jadwal' => $id]);

    // Hapus data dari tabel backup_kelas
$where = array('id_jadwal' => $id);
$model->hapus('backup_jadwal', $where);
return redirect()->route('home.jadwal');
}



//suara
public function suara()
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID event dari session
        $activity = 'Mengakses halaman suara'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        $data['elly'] = $model->tampil('suara', 'id_suara');
        $data['backup_suara'] = []; // Inisialisasi array untuk backup user

        foreach ($data['elly'] as $suara) {
            $data['backup_suara'][$suara->id_suara] = $model->getBackupsuara($suara->id_suara);
        }


        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'suara'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('suara', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

public function tambah_suara()
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses form tambah suara'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'suara'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('tambah_suara', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

public function aksi_tambah_suara(Request $request)
{
    $model = new M_model();
    $id_user = session()->get('id'); 
    $activity = 'Menambah data suara'; 
    $this->addLog($id_user, $activity);

    $a = $request->input('keterangan');
    $fileSuara = $request->file('file');

    if ($fileSuara) {
        $fileName = $model->uploadsuara($fileSuara); // Nama file yang disimpan
    } else {
        $fileName = null;
    }

    $isi = array(
        'keterangan_suara' => $a,
        'file' => $fileName,  // Nama file yang telah diupload
        'created_at' => now(), 
        'created_by' => $id_user,
        'isdelete'=> 0 
    );

    $model->tambah('suara', $isi);

    return redirect()->route('home.suara');
}




    public function edit_suara($id)
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses form edit suara'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
        $where= array('id_suara'=>$id);
        $data['elly']=$model->getwhere('suara',$where);

        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'suara'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('edit_suara', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

public function aksi_edit_suara(Request $request)
{
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Mengubah data suara'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);

    $a =  $request->input('keterangan');
    $id =  $request->input('id');

    $backupWhere = ['id_suara' => $id];
    $existingBackup = $model->getWhere('backup_suara', $backupWhere);

    if ($existingBackup) {
        // Hapus data lama di user_backup jika ada
        $model->hapus('backup_suara', $backupWhere);
    }

    // Ambil data suara lama berdasarkan id
    $userLama = $model->getsuaraById($id);

    // Simpan data suara lama ke tabel backup_suara
    $backupData = (array) $userLama;  // Ubah objek menjadi array
    $model->tambah('backup_suara', $backupData);

    // Ambil file suara jika ada
    $fileSuara = $request->file('file');

    // Jika ada file baru diupload, lakukan proses upload
    if ($fileSuara) {
        $fileName = $model->uploadsuara($fileSuara); // Simpan file baru
    } else {
        // Jika tidak ada file baru, gunakan file lama
        $fileName = $userLama->file;
    }

    $isi = array(
        'keterangan_suara' => $a,
        'file' => $fileName,  // Gunakan nama file baru atau lama
        'updated_at' => now(), // Waktu saat data diperbarui
        'updated_by' => $id_user // ID user yang login
    );

    $where = array('id_suara' => $id);
    $model->edit('suara', $isi, $where);

    return redirect()->route('home.suara');
}


public function undo_edit_suara($id)
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses form undo edit suara'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
        $where = array('id_suara' => $id);
        $data['elly'] = $model->getwhere('suara', $where);

        // Pastikan data yang didapat adalah array atau objek yang dapat diiterasi
        if (!empty($data['elly'])) {
            // Inisialisasi array untuk backup jurusan
            $data['backup_suara'] = [];

            // Mendapatkan data backup untuk setiap jurusan jika data 'elly' adalah array
            if (is_array($data['elly'])) {
                foreach ($data['elly'] as $suara) {
                    $data['backup_suara'][$suara->id_suara] = $model->getBackupsuara($suara->id_suara);
                }
            } else {
                // Jika hanya satu data, tetap memprosesnya
                $data['backup_suara'][$data['elly']->id_suara] = $model->getBackupsuara($data['elly']->id_suara);
            }
        } else {
            $data['backup_suara'] = []; // Jika data kosong, set backup_jurusan menjadi array kosong
        }


        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'suara'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
       
        echo view('undo_edit_suara', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

public function aksi_unedit_suara(Request $request)
{
    $model = new M_model();
    $id = $request->input('id'); 
    
    if (!$id) {
        return redirect()->route('home.suara')->with('error', 'ID suara tidak ditemukan.');
    }
    
    $id_user = session()->get('id'); 
    $activity = 'Undo edit data suara';
    $this->addLog($id_user, $activity);
    $backupData = $model->getWhere('backup_suara', ['id_suara' => $id]);
    if ($backupData) {
        $restoreData = (array) $backupData;
        unset($restoreData['id_suara']);
        $model->edit('suara', $restoreData, ['id_suara' => $id]);
        $model->hapus('backup_suara', ['id_suara' => $id]);
    }

    return redirect()->route('home.suara');
}


public function hapussuara($id){
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus data suara'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' =>now() // Format datetime untuk deleted_at
    ];
      
    $model->edit('suara', $data, ['id_suara' => $id]);

    // Hapus data dari tabel backup_kelas
$where = array('id_suara' => $id);
$model->hapus('backup_suara', $where);
return redirect()->route('home.suara');
}

public function restore_suara()
    {   
        if (!session()->has('level') || !session()->has('id')) {
            // Jika session level atau id tidak ada, arahkan ke halaman login
            return redirect()->route('home.login');
        }
        if (session()->get('level') == 0 || session()->get('level') == 1) {
    	$model= new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore suara'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $data['elly'] = $model->tampil('suara', 'id_suara');
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'restore_suara'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('restore_suara',$data);
        echo view ('footer');
         }else{
        return redirect()->route('home.error');
 
    } 
    
}
    public function aksi_restore_suara($id) {
        $model = new M_model();
         $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Merestore data suara'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
        
        // Data yang akan diupdate untuk mengembalikan produk
        $data = [
            'isdelete' => 0,
            'deleted_by' => null,
            'deleted_at' => null
            
        ];
    
        // Update data produk dengan kondisi id_produk sesuai
        $model->edit('suara', $data, ['id_suara' => $id]);
    
        return redirect()->route('home.restore_suara');
    
}
//setting

public function setting()
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    // Memeriksa level akses user
    if (session()->get('level') == 0||session()->get('level') == 1 ) {
      
        $model = new M_model();
        
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman setting'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        $id = 1; // id_toko yang diinginkan

        // Menyusun kondisi untuk query
        $where = array('id_setting' => $id);

        // Mengambil data dari tabel 'toko' berdasarkan kondisi
        $data['user'] = $model->getWhere('setting', $where);
 
        // Memuat view
        $where=array(
          'id_setting'=> 1
        );
        $data['setting'] = $model->getWhere('setting',$where);
        $data['currentMenu'] = 'setting'; 
        echo view('header', $data);
        echo view('menu', $data);
        echo view('setting', $data);
        echo view('footer', $data);
    } else {
        return redirect()->route('home.error');
    } 
}

public function aksisetting(Request $request)
{
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data setting'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
      
    
       
    $nama = $request->input('nama');
    $alamat =  $request->input('alamat');
    $nohp =  $request->input('nohp');
    $sekolah =  $request->input('sekolah');
    $id = $request->input('id');
    $uploadedFile = $request->input('foto');

    $where = array('id_setting' => $id);

    $isi = array(
        'nama_setting' => $nama,
        'alamat' => $alamat,
        'nohp' => $nohp,
        'nama_sekolah'=> $sekolah,
        'updated_at' => now(), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
        $foto = $request->file('foto')->getClientOriginalName();
        $request->file('foto')->move(public_path('images'), $foto);
        $isi['logo'] = $foto;
    }

    $model->edit('setting', $isi, $where);

    return redirect()->route('home.setting', ['id' => $id]);

}

public function restore_user()
    {   
        if (!session()->has('level') || !session()->has('id')) {
            // Jika session level atau id tidak ada, arahkan ke halaman login
            return redirect()->route('home.login');
        }
        if (session()->get('level') == 0 || session()->get('level') == 1) {
    	$model= new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $data['elly'] = $model->tampil('user', 'id_user');
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'restore_user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('restore_user',$data);
        echo view ('footer');
         }else{
        return redirect()->route('home.error');
 
    } 
    
}
    public function aksi_restore_user($id) {
        $model = new M_model();
         $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Merestore data user'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
        
        // Data yang akan diupdate untuk mengembalikan produk
        $data = [
            'isdelete' => 0,
            'deleted_by' => null,
            'deleted_at' => null
        ];
    
        // Update data produk dengan kondisi id_produk sesuai
        $model->edit('user', $data, ['id_user' => $id]);
    
        return redirect()->route('home.restore_user');
    
}

public function restore_event()
    {   
        if (!session()->has('level') || !session()->has('id')) {
            // Jika session level atau id tidak ada, arahkan ke halaman login
            return redirect()->route('home.login');
        }
        if (session()->get('level') == 0 || session()->get('level') == 1) {
    	$model= new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore event'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $data['elly'] = $model->tampil('event', 'id_event');
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'restore_event'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('restore_event',$data);
        echo view ('footer');
         }else{
        return redirect()->route('home.error');
 
    } 
    
}
    public function aksi_restore_event($id) {
        $model = new M_model();
         $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Merestore data event'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
        
        // Data yang akan diupdate untuk mengembalikan produk
        $data = [
            'isdelete' => 0,
            'deleted_by' => null,
            'deleted_at' => null
            
        ];
    
        // Update data produk dengan kondisi id_produk sesuai
        $model->edit('event', $data, ['id_event' => $id]);
    
        return redirect()->route('home.restore_event');
    
}

public function restore_jadwal()
    {   
        if (!session()->has('level') || !session()->has('id')) {
            // Jika session level atau id tidak ada, arahkan ke halaman login
            return redirect()->route('home.login');
        }
        if (session()->get('level') == 0 || session()->get('level') == 1) {
    	$model= new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore jadwal'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $data['elly'] = $model->joinTigaTabel('jadwal', 'event','suara', 'jadwal.id_event = event.id_event', 'jadwal.id_suara = suara.id_suara', 'jadwal.id_jadwal', ['jadwal.isdelete' => 1]);
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'restore_jadwal'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('restore_jadwal',$data);
        echo view ('footer');
         }else{
        return redirect()->route('home.error');
 
    } 
    
}
    public function aksi_restore_jadwal($id) {
        $model = new M_model();
         $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Merestore data jadwal'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
        
        // Data yang akan diupdate untuk mengembalikan produk
        $data = [
            'isdelete' => 0,
            'deleted_by' => null,
            'deleted_at' => null
        ];
    
        // Update data produk dengan kondisi id_produk sesuai
        $model->edit('jadwal', $data, ['id_jadwal' => $id]);
    
        return redirect()->route('home.restore_jadwal');
    
}

//bell

public function bell()
{
    if (!session()->has('level') || !session()->has('id')) {
        // Jika session level atau id tidak ada, arahkan ke halaman login
        return redirect()->route('home.login');
    }
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id');
        $activity = 'Mengakses halaman bell';
        $this->addLog($id_user, $activity);

        // Ambil data jadwal yang belum dihapus
        $data['elly'] = $model->joinTigaTabel('jadwal', 'event', 'suara', 'jadwal.id_event = event.id_event', 'jadwal.id_suara = suara.id_suara', 'jadwal.id_jadwal', ['jadwal.isdelete' => 0]);

        Log::info('Data jadwal diambil', ['data' => $data['elly']]);

        // Ambil setting yang diperlukan
        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'bell';

        // Get current day in Indonesian
        $currentDay = $this->getCurrentDayIndo();

        // Mengirim data jadwal ke frontend dengan filter hari
        // $data['events'] = $this->prepareEventsForFrontend($data['elly'], $currentDay);

        // Log::info('Data event untuk frontend', ['events' => $data['events']]);

        echo view('header', $data);
        echo view('menu', $data);
        echo view('bell', $data);
        echo view('footer');
    } else {
        return redirect()->route('home.error');
    }
}

// Function to get the current day in Indonesian
private function getCurrentDayIndo()
{
    $daysIndo = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
    $currentDayEng = date('l'); // Get the current day in English
    return $daysIndo[$currentDayEng];
}

private function prepareEventsForFrontend($elly, $currentDay)
{
    $events = [];
    foreach ($elly as $event) {
        if ($event->status == 1 && $event->hari == $currentDay) { // Filter events for current day
            $events[] = [
                'id_jadwal' => $event->id_jadwal,
                'id_event' => $event->id_event,
                'status' => $event->status,
                'hari' => $event->hari,
                'waktu' => $event->waktu,
                'id_suara' => $event->id_suara,
                'deskripsi_event' => $event->deskripsi_event,
                'file' => $event->file
            ];
        }
    }
    return $events;
}


public function updateStatus($id_event, Request $request)
{
    $model = new M_model();
    
    // Ambil status baru dari request
    $status = $request->input('status');
    
    // Update status event di tabel jadwal
    $data = [
        'status' => $status
    ];
    
    // Update status berdasarkan id_event
    $updated = $model->edit('event', $data, ['id_event' => $id_event]);
    
    // Cek apakah status berhasil diupdate
    if ($updated) {
        return response()->json(['success' => true, 'newStatus' => $status]);
    } else {
        return response()->json(['success' => false, 'message' => 'Gagal memperbarui status']);
    }
}


    }