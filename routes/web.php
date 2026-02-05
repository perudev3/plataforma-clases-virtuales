<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/nosotros', function () {
    return view('nosotros');
});

Route::get('/mision_vision', function () {
    return view('mision_vision');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

    //MODULO CRUD CURSOS
     Route::get('/cursos', 'Docente\CourseController@index')
        ->name('courses.index');

    Route::get('/cursos/crear', 'Docente\CourseController@create')
        ->name('courses.create');

    Route::post('/cursos', 'Docente\CourseController@store')
        ->name('courses.store');

    //MODULO CRUD SILABOS DEL CURSO
    Route::get('/cursos/{course}/syllabus', 'Docente\SyllabusController@index')
            ->name('syllabus.index');

    Route::get('/cursos/{course}/syllabus/create', 'Docente\SyllabusController@create')
            ->name('syllabus.create');

    Route::post('/cursos/{course}/syllabus', 'Docente\SyllabusController@store')
            ->name('syllabus.store');


    //MODULO CRUD DOCENTE 
    Route::resource('docentes', 'Admin\DocenteController');
});


Route::middleware(['auth', 'role:student'])
    ->prefix('alumno')
    ->name('alumno.')
    ->group(function () {

    //LISTA DE CURSOS A EXPLORAR
    Route::get('/courses', 'Student\CourseController@index')
        ->name('courses.index');

    //INSCRIBIRSE A UN CURSO
    Route::post('/courses/{course}/enroll', 'Student\EnrollmentController@enroll')
        ->name('courses.enroll');

    //CURSOS INSCRITOS DEL ALUMNO
    Route::get('/mis-cursos', 'Student\EnrollmentController@myCourses')
        ->name('courses');

    //MODULO VISOR DEL SILABO DEL CURSO
    Route::get('/mis-cursos/{course}', 'Student\CourseController@show')
        ->name('courses.show');

});

Route::get('/inscritos', function () {
    return view('student.inscritos.index');
});


/* Route::middleware(['auth', 'role:teacher'])->prefix('docente')->name('docente.')->group(function () {

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
 */

