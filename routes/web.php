<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [Controller::class, 'home'])->name('home');
Route::get('/home/dashboard', [Controller::class, 'dashboard'])->name('home.dashboard');
Route::get('/index', [Controller::class, 'index']);

Route::get('/home/login', [Controller::class, 'login'])->name('home.login');



Route::post('/home/aksilogin', [Controller::class, 'aksilogin'])->name('home.aksilogin');
Route::get('/home/logout', [Controller::class, 'logout'])->name('home.logout');
Route::get('/generateCaptcha', [Controller::class, 'generateCaptcha'])->name('home.generateCaptcha');


Route::get('/home/profile/{id}', [Controller::class, 'profile'])->name('home.profile');
Route::post('/home/aksieprofile', [Controller::class, 'aksieprofile'])->name('home.aksieprofile');
Route::post('/home/aksi_changepass', [Controller::class, 'aksi_changepass'])->name('home.aksi_changepass');

Route::get('/home/user', [Controller::class, 'user'])->name('home.user');
Route::get('/home/tambah_user', [Controller::class, 'tambah_user'])->name('home.tambah_user');
Route::get('/home/edit_user/{id}', [Controller::class, 'edit_user'])->name('home.edit_user');
Route::get('/home/undo_edit_user/{id}', [Controller::class, 'undo_edit_user'])->name('home.undo_edit_user');
Route::get('/home/hapususer/{id}', [Controller::class, 'hapususer'])->name('home.hapususer');
Route::get('/home/aksi_reset/{id}', [Controller::class, 'aksi_reset'])->name('home.aksi_reset');
Route::post('/home/aksi_tambah_user', [Controller::class, 'aksi_tambah_user'])->name('home.aksi_tambah_user');
Route::post('/home/aksi_edit_user', [Controller::class, 'aksi_edit_user'])->name('home.aksi_edit_user');
Route::post('/home/aksi_unedit_user', [Controller::class, 'aksi_unedit_user'])->name('home.aksi_unedit_user');


Route::get('/home/event', [Controller::class, 'event'])->name('home.event');
Route::get('/home/tambah_event', [Controller::class, 'tambah_event'])->name('home.tambah_event');
Route::get('/home/edit_event/{id}', [Controller::class, 'edit_event'])->name('home.edit_event');
Route::get('/home/undo_edit_event/{id}', [Controller::class, 'undo_edit_event'])->name('home.undo_edit_event');
Route::get('/home/hapusevent/{id}', [Controller::class, 'hapusevent'])->name('home.hapusevent');
Route::post('/home/aksi_tambah_event', [Controller::class, 'aksi_tambah_event'])->name('home.aksi_tambah_event');
Route::post('/home/aksi_edit_event', [Controller::class, 'aksi_edit_event'])->name('home.aksi_edit_event');
Route::post('/home/aksi_unedit_event', [Controller::class, 'aksi_unedit_event'])->name('home.aksi_unedit_event');

Route::get('/home/suara', [Controller::class, 'suara'])->name('home.suara');
Route::get('/home/tambah_suara', [Controller::class, 'tambah_suara'])->name('home.tambah_suara');
Route::get('/home/edit_suara/{id}', [Controller::class, 'edit_suara'])->name('home.edit_suara');
Route::get('/home/undo_edit_suara/{id}', [Controller::class, 'undo_edit_suara'])->name('home.undo_edit_suara');
Route::get('/home/hapussuara/{id}', [Controller::class, 'hapussuara'])->name('home.hapussuara');
Route::post('/home/aksi_tambah_suara', [Controller::class, 'aksi_tambah_suara'])->name('home.aksi_tambah_suara');
Route::post('/home/aksi_edit_suara', [Controller::class, 'aksi_edit_suara'])->name('home.aksi_edit_suara');
Route::post('/home/aksi_unedit_suara', [Controller::class, 'aksi_unedit_suara'])->name('home.aksi_unedit_suara');

Route::get('/home/jadwal', [Controller::class, 'jadwal'])->name('home.jadwal');
Route::get('/home/tambah_jadwal', [Controller::class, 'tambah_jadwal'])->name('home.tambah_jadwal');
Route::get('/home/edit_jadwal/{id}', [Controller::class, 'edit_jadwal'])->name('home.edit_jadwal');
Route::get('/home/undo_edit_jadwal/{id}', [Controller::class, 'undo_edit_jadwal'])->name('home.undo_edit_jadwal');
Route::get('/home/hapusjadwal/{id}', [Controller::class, 'hapusjadwal'])->name('home.hapusjadwal');
Route::post('/home/aksi_tambah_jadwal', [Controller::class, 'aksi_tambah_jadwal'])->name('home.aksi_tambah_jadwal');
Route::post('/home/aksi_edit_jadwal', [Controller::class, 'aksi_edit_jadwal'])->name('home.aksi_edit_jadwal');
Route::post('/home/aksi_unedit_jadwal', [Controller::class, 'aksi_unedit_jadwal'])->name('home.aksi_unedit_jadwal');


Route::get('/home/setting', [Controller::class, 'setting'])->name('home.setting');
Route::post('/home/aksisetting', [Controller::class, 'aksisetting'])->name('home.aksisetting');
Route::get('/home/profile/{id}', [Controller::class, 'profile'])->name('home.profile');
Route::post('/home/aksieprofile', [Controller::class, 'aksieprofile'])->name('home.aksieprofile');
Route::post('/home/aksi_changepass', [Controller::class, 'aksi_changepass'])->name('home.aksi_changepass');
Route::get('/home/log', [Controller::class, 'log'])->name('home.log');

Route::get('/home/restore_user', [Controller::class, 'restore_user'])->name('home.restore_user');
Route::get('/home/aksi_restore_user/{id}', [Controller::class, 'aksi_restore_user'])->name('home.aksi_restore_user');
Route::get('/home/restore_event', [Controller::class, 'restore_event'])->name('home.restore_event');
Route::get('/home/aksi_restore_event/{id}', [Controller::class, 'aksi_restore_event'])->name('home.aksi_restore_event');
Route::get('/home/restore_jadwal', [Controller::class, 'restore_jadwal'])->name('home.restore_jadwal');
Route::get('/home/aksi_restore_jadwal/{id}', [Controller::class, 'aksi_restore_jadwal'])->name('home.aksi_restore_jadwal');
Route::get('/home/restore_suara', [Controller::class, 'restore_suara'])->name('home.restore_suara');
Route::get('/home/aksi_restore_suara/{id}', [Controller::class, 'aksi_restore_suara'])->name('home.aksi_restore_suara');

Route::get('/home/bell', [Controller::class, 'bell'])->name('home.bell');
Route::post('/update-status/{id_event}', [Controller::class, 'updateStatus']);


Route::get('/home/kalkulator', [Controller::class, 'kalkulator'])->name('home.kalkulator');
Route::post('/home/history_kalkulator', [Controller::class, 'historyKalkulator']);
Route::post('/home/delete_kalkulator', [Controller::class, 'deleteKalkulator']);


