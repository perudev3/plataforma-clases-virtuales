<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

    Route::resource('docentes', 'Admin\DocenteController');
});


Route::middleware(['auth', 'role:teacher'])->prefix('docente')->name('docente.')->group(function () {

    Route::get('/dashboard', 'Docente\DashboardController@index')
        ->name('dashboard');

    Route::get('/cursos', 'Docente\CourseController@index')
        ->name('courses.index');

    Route::get('/cursos/crear', 'Docente\CourseController@create')
        ->name('courses.create');

    Route::post('/cursos', 'Docente\CourseController@store')
        ->name('courses.store');

     Route::get('/cursos/{course}/syllabus', 'Docente\SyllabusController@index')
            ->name('syllabus.index');

        Route::get('/cursos/{course}/syllabus/create', 'Docente\SyllabusController@create')
            ->name('syllabus.create');

        Route::post('/cursos/{course}/syllabus', 'Docente\SyllabusController@store')
            ->name('syllabus.store');
});


