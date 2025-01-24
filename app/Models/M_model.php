<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_model extends Model
{
    // Mengambil data dari tabel dengan urutan tertentu
    public function tampil($tabel, $id)
    {
        return DB::table($tabel)
                ->orderBy($id, 'desc')
                ->get();
    }

    // Join dua tabel
    public function join($tabel, $tabel2, $on, $id)
    {
        return DB::table($tabel)
                ->join($tabel2, $on, 'left')
                ->orderBy($id, 'desc')
                ->get();
    }

    // Mencari activity log berdasarkan parameter tertentu
    public function searchActivityLogs($id_user = null, $nama_user = null, $activity = null, $timestamp = null)
    {
        $query = DB::table('activity_log')
                    ->join('user', 'user.id_user', '=', 'activity_log.id_user');

        if ($id_user) {
            $query->where('activity_log.id_user', 'like', "%$id_user%");
        }
        if ($nama_user) {
            $query->where('user.nama_user', 'like', "%$nama_user%");
        }
        if ($activity) {
            $query->where('activity_log.activity', 'like', "%$activity%");
        }
        if ($timestamp) {
            $query->where('activity_log.timestamp', 'like', "%$timestamp%");
        }

        return $query->orderBy('activity_log.timestamp', 'desc')->get();
    }

    public function tampilkondisi($table, $order_by, $where = [])
{
    return DB::table($table)
             ->where($where)
             ->orderBy($order_by)
             ->get();
}


    // Mengambil backup user berdasarkan ID
    public function getBackupUser($id_user)
    {
        return DB::table('backup_user')->where('id_user', $id_user)->first();
    }
    public function getBackupevent($id_event)
    {
        return DB::table('backup_event')->where('id_event', $id_event)->first();
    }
    public function getBackupjadwal($id_jadwal)
    {
        return DB::table('backup_jadwal')->where('id_jadwal', $id_jadwal)->first();
    }

    public function getBackupsuara($id_suara)
    {
        return DB::table('backup_suara')->where('id_suara', $id_suara)->first();
    }

    // Join tabel dengan kondisi
    public function joinkondisi($tabel, $tabel2, $on, $id, $where = [])
    {
        $query = \DB::table($tabel)
                    ->join($tabel2, function ($join) use ($on) {
                        // Split the on condition to get the column names
                        list($left, $right) = explode('=', $on);
                        $join->on(trim($left), '=', trim($right));
                    })
                    ->orderBy($id, 'desc');
    
        // If there are where conditions, add them to the query
        if (!empty($where)) {
            $query->where($where);
        }
    
        return $query->get();
    }
    
    public function joinTigaTabel($tabel1, $tabel2, $tabel3, $on1, $on2, $id, $where = [])
    {
        $query = \DB::table($tabel1)
                    ->join($tabel2, function ($join) use ($on1) {
                        // Split the on condition to get the column names for the first join
                        list($left, $right) = explode('=', $on1);
                        $join->on(trim($left), '=', trim($right));
                    })
                    ->join($tabel3, function ($join) use ($on2) {
                        // Split the on condition to get the column names for the second join
                        list($left, $right) = explode('=', $on2);
                        $join->on(trim($left), '=', trim($right));
                    })
                    ->orderBy($id, 'desc');
    
        // If there are where conditions, add them to the query
        if (!empty($where)) {
            $query->where($where);
        }
    
        return $query->get();
    }
    
    // Join tiga tabel dengan kondisi
    public function joinkondisi3($tabel, $tabel2, $tabel3, $on, $on2, $id, $where = [])
    {
        $query = DB::table($tabel)
                    ->join($tabel2, $on, 'left')
                    ->join($tabel3, $on2, 'left')
                    ->orderBy($id, 'desc');

        if (!empty($where)) {
            $query->where($where);
        }

        return $query->get();
    }

    // Join dua tabel dengan kondisi where
    public function joinWhere($tabel, $tabel2, $on, $where)
    {
        return DB::table($tabel)
                ->join($tabel2, $on, 'left')
                ->where($where)
                ->first(); // Mengembalikan 1 baris data
    }

    // Join dua tabel dengan banyak hasil
    public function joinWherebaru($tabel, $tabel2, $on, $where)
    {
        return DB::table($tabel)
                ->join($tabel2, $on, 'left')
                ->where($where)
                ->get(); // Mengembalikan banyak hasil
    }

    // Mengambil data berdasarkan kondisi
    public function getWhere($tabel, $where)
    {
        return DB::table($tabel)
                ->where($where)
                ->first(); // Mengembalikan 1 baris data
    }

    // Mengambil data berdasarkan kondisi dengan banyak hasil
    public function getWhereres($tabel, $where)
    {
        $query = DB::table($tabel)->where($where);
        return $query->exists() ? $query->get() : []; // Mengembalikan array kosong jika tidak ada hasil
    }

    // Insert batch
    public function tambahBatch($table, $data)
    {
        return DB::table($table)->insert($data);
    }

    // Upload file
    public function upload($photo)
    {
        $path = $photo->store('public/images');
        return basename($path);
    }

    public function uploadsuara($suara)
{
    // Ambil nama file asli
    $suaraName = $suara->getClientOriginalName();

    // Pindahkan file ke folder 'public/sound'
    $suara->move(public_path('sound'), $suaraName);

    // Mengembalikan nama file yang disimpan
    return $suaraName;
}




    // Join tiga tabel dengan kondisi where
    public function jointigawhere($tabel, $tabel2, $tabel3, $on, $on2, $id, $where)
    {
        return DB::table($tabel)
                ->join($tabel2, $on, 'left')
                ->join($tabel3, $on2, 'left')
                ->orderBy($id, 'desc')
                ->where($where)
                ->get();
    }

    // Join empat tabel dengan kondisi where
    public function joinempatwhere($tabel, $tabel2, $tabel3, $tabel4, $on, $on2, $on3, $id, $where)
    {
        return DB::table($tabel)
                ->join($tabel2, $on, 'left')
                ->join($tabel3, $on2, 'left')
                ->join($tabel4, $on3, 'left')
                ->orderBy($id, 'desc')
                ->where($where)
                ->get();
    }

    // Insert data
    public function tambah($tabel, $isi)
    {
        return DB::table($tabel)->insert($isi);
    }

    // Update data
    public function edit($tabel, $isi, $where)
    {
        return DB::table($tabel)->where($where)->update($isi);
    }

    // Hapus data
    public function hapus($tabel, $where)
    {
        return DB::table($tabel)->where($where)->delete();
    }

    // Mendapatkan password user berdasarkan ID
    public function getPassword($userId)
    {
        return DB::table('user')
                ->where('id_user', $userId)
                ->value('password');
    }

    // Mengambil activity logs
    public function getActivityLogs()
    {
        return DB::table('activity_log')
                ->join('user', 'activity_log.id_user', '=', 'user.id_user', 'left')
                ->select('activity_log.*', 'user.nama_user')
                ->orderBy('activity_log.timestamp', 'desc')
                ->get();
    }

    // Mengambil user berdasarkan ID
    public function getUserById($id)
    {
        return DB::table('user')->where('id_user', $id)->first();
    }
    public function geteventById($id)
    {
        return DB::table('event')->where('id_event', $id)->first();
    }
    public function getjadwalById($id)
    {
        return DB::table('jadwal')->where('id_jadwal', $id)->first();
    }

    public function getsuaraById($id)
    {
        return DB::table('suara')->where('id_suara', $id)->first();
    }
}
