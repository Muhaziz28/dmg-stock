<?php

use App\Http\Controllers\BahanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KeluarController;
use App\Http\Controllers\MasukController;
use App\Http\Controllers\VariasiController;
use App\Http\Controllers\ViewController;
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

Route::get('/', [ViewController::class, 'index'])->name('dmg.index');

Route::get('/barang', [ViewController::class, 'barang'])->name(('dmg.barang'));
Route::get('getBarang', [BarangController::class, 'getBarang'])->name('dmg.getBarang');
Route::post('addBarang', [BarangController::class, 'addBarang'])->name('dmg.addBarang');
Route::post('deleteBarang', [BarangController::class, 'deleteBarang'])->name('dmg.deleteBarang');
Route::post('updateBarang', [BarangController::class, 'updateBarang'])->name('dmg.updateBarang');
Route::post('detailBarang', [BarangController::class, 'detailBarang'])->name('dmg.detailBarang');

Route::get('/variasi', [ViewController::class, 'variasi'])->name(('dmg.variasi'));
Route::get('getVariasi', [VariasiController::class, 'getVariasi'])->name('dmg.getVariasi');
Route::post('addVariasi', [VariasiController::class, 'addVariasi'])->name('dmg.addVariasi');
Route::post('detailVariasi', [VariasiController::class, 'detailVariasi'])->name('dmg.detailVariasi');
Route::post('updateVariasi', [VariasiController::class, 'updateVariasi'])->name('dmg.updateVariasi');
Route::post('deleteVariasi', [VariasiController::class, 'deleteVariasi'])->name('dmg.deleteVariasi');

Route::get('/bahan', [ViewController::class, 'bahan'])->name(('dmg.bahan'));
Route::get('getBahan', [BahanController::class, 'getBahan'])->name('dmg.getBahan');
Route::post('addBahan', [BahanController::class, 'addBahan'])->name('dmg.addBahan');
Route::post('detailBahan', [BahanController::class, 'detailBahan'])->name('dmg.detailBahan');
Route::post('updateBahan', [BahanController::class, 'updateBahan'])->name('dmg.updateBahan');
Route::post('deleteBahan', [BahanController::class, 'deleteBahan'])->name('dmg.deleteBahan');

Route::get('/masuk', [ViewController::class, 'masuk'])->name(('dmg.masuk'));
Route::get('getMasuk', [MasukController::class, 'getMasuk'])->name('dmg.getMasuk');
Route::post('addMasuk', [MasukController::class, 'addMasuk'])->name('dmg.addMasuk');

Route::get('/keluar', [ViewController::class, 'keluar'])->name(('dmg.keluar'));
Route::get('getKeluar', [KeluarController::class, 'getKeluar'])->name('dmg.getKeluar');
Route::post('addKeluar', [KeluarController::class, 'addKeluar'])->name('dmg.addKeluar');
