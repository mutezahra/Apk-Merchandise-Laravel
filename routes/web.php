<?php

use App\Http\Controllers\HomeC;
use App\Http\Controllers\UserC;
use App\Http\Controllers\KategoriC;
use App\Http\Controllers\ProductsC;
use App\Http\Controllers\TransactionsC;
use App\Http\Controllers\LaporanC;
use App\Http\Controllers\LogC;
use App\Http\Controllers\LoginC;
use App\Http\Controllers\ProfileC;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $subtitle = "Home Page";
    return view('login', compact('subtitle'));
});



Route::get('/dashboard', [HomeC::class, 'index'])->name('dashboard');
Route::get('laporan', [LaporanC::class, 'index'])->name('laporan');
Route::get('/laporan/filter', [LaporanC::class, 'filter'])->name('laporan.filter');
Route::get('/laporan/export', [LaporanC::class, 'export'])->name('laporan.export');

Route::get('transactions/pdf2',  [TransactionsC::class, 'pdf2'])->name('transactions.pdf2')->middleware('userAkses:admin,owner');
Route::get('/pertanggal/{tgl_awal}/{tgl_akhir}', [TransactionsC::class, 'pertanggal'])->name('transactions.pertanggal')->middleware('userAkses:admin,owner');
Route::get('/transactions/struk/{id}', [TransactionsC::class,'Struk'])->name('transactions.struk')->middleware('userAkses:kasir,admin');


Route::get('login/admin',[LoginC::class,'login'])->name('login')->middleware('guest');
Route::get('logout',[LoginC::class, 'logout'])->name('logout')->middleware('auth');
Route::post('login_action', [LoginC::class, 'login_action'])->name('login.action')->middleware('guest');






Route::get('profile', [ProfileC::class, 'index'])->name('profile.index')->middleware('auth');
Route::get('profile/edit/{id}', [ProfileC::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('profile/update/{id}', [ProfileC::class, 'update'])->name('profile.update')->middleware('auth');
// Route::put('profile/change/{id}', [ProfileC::class, 'change'])->name('profile.change')->middleware('auth');
// Route::get('profile/changepassword/{id}',[ProfileC::class,'changepassword'])->name('profile.changepassword')->middleware('auth');


Route::resource('users', UserC::class)->middleware('auth');
Route::put('users/change/{id}', [UserC::class, 'change'])->name('users.change')->middleware('auth');
Route::get('users/changepassword/{id}',[UserC::class,'changepassword'])->name('users.changepassword')->middleware('auth');
// Route::get('users', [UserC::class, 'index'])->name('users');
// Route::post('users/create', [UserC::class, 'create'])->name('users.create');

Route::resource('kategori', KategoriC::class)->middleware('userAkses:owner,admin');



Route::get('products', [ProductsC::class, 'index'])->name('products.index')->middleware('auth');
Route::get('products/create', [ProductsC::class, 'create'])->name('products.create')->middleware('userAkses:owner,admin');
Route::post('products/store', [ProductsC::class, 'store'])->name('products.store')->middleware('userAkses:owner,admin');
Route::get('products/edit{id}', [ProductsC::class, 'edit'])->name('products.edit')->middleware('userAkses:owner,admin');
Route::put('products/update{id}', [ProductsC::class, 'update'])->name('products.update')->middleware('userAkses:owner,admin');
Route::delete('products/delete/{id}', [ProductsC::class, 'destroy'])->name('products.destroy')->middleware('userAkses:owner,admin');

Route::get('transactions', [TransactionsC::class, 'index'])->name('transactions.index')->middleware('userAkses:kasir,admin,owner');
Route::get('transactions/create', [TransactionsC::class, 'create'])->name('transactions.create')->middleware('userAkses:kasir,admin');
Route::post('transactions/store', [TransactionsC::class, 'store'])->name('transactions.store')->middleware('userAkses:kasir,admin');
Route::get('transactions/edit/{id}', [TransactionsC::class, 'edit'])->name('transactions.edit')->middleware('userAkses:admin');
Route::put('transactions/update/{id}', [TransactionsC::class, 'update'])->name('transactions.update')->middleware('userAkses:admin');
Route::delete('transactions/delete/{id}', [TransactionsC::class, 'destroy'])->name('transactions.delete')->middleware('userAkses:admin');


Route::get('laporan', [LaporanC::class, 'index'])->name('laporan.index');
// Route::get('/laporan/pertanggal/{tgl_awal}/{tgl_akhir}', [LaporanC::class, 'Pdfpertanggal'])->name('laporan.pertanggal');
// Route::post('/laporan/filter', [LaporanC::class, 'filterdata'])->name('laporan.filterdata');


Route::get('log', [LogC::class, 'index'])->name('log')->middleware('userAkses:owner');




