<?php

use Illuminate\Support\Facades\Route;
use App\Models\About;

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
    $aTextData = file_get_contents(__DIR__ . '/../resources/text-data/about-second.html');

    return view('index', [
        'heading' => $aTextData
    ]);
});

Route::get('/{slug}', function ($slug) {
    return view($slug, [
        'heading' => About::getHeadersData($slug),
        'data' => About::getInsideData($slug)
    ]);
})->where('slug', '[A-z_\-]+');
