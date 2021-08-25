<?php

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
    $aTextData = file_get_contents(__DIR__ . '/../resources/text-data/about-second.html');

    return view('index', [
        'heading' => $aTextData
    ]);
});
Route::get('about-us', function () {
    return view('about-us');
});

Route::get('about-us/{slug}', function ($slug) {

    $sPath = __DIR__ . "/../resources/text-data/{$slug}.html";
    ddd($sPath);

    try {
        file_get_contents($sPath);
    } catch (Exception $exception) {
        return redirect('/');
//        abort(404);
    }


    $aData = file_get_contents($sPath);


    return view($slug, [
        'heading' => $aData
    ]);
});
