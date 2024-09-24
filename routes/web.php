<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('download', function () {
//     return 'latihan pdf';
// })->name('download.tes');


Route::get('/invoice/{id}/export', [PDFController::class, 'exportInvoice'])->name('invoice.export');

Route::get('/invoice/{id}/preview', [PDFController::class, 'preview'])->name('invoice.preview');


