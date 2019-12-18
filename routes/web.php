<?php

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

Route::get('admin', function () {
    return view('admin.home ');
});

Route::get('/', function () {
    return view('frontend/index');
});
Route::get('about', function () {
    return view('frontend/about');
});
Route::get('blog', function () {
    return view('frontend/blog');
});
Route::get('contact', function () {
    return view('frontend/contact');
});
Route::get('project', function () {
    return view('frontend/project');
});
Route::get('service', function () {
    return view('frontend/service');
});
Route::get('team', function () {
    return view('frontend/team');

});
Route::get('show_about', 'AboutHandler@process_and_display');