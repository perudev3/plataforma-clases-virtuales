<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'WelcomeController@index' );

Route::get('/nosotros', function () {
    return view('nosotros');
});

Route::get('/mision_vision', function () {
    return view('mision_vision');
});

Route::get('/especializaciones', function () {
    $programas = \App\Course::where('programa', 'especializacion')->paginate(12); 
    return view('especializaciones.index', compact('programas'))->with('title', 'Cursos');
})->name('especializaciones.index');

Route::get('/diplomados', function () {
    $programas = \App\Course::where('programa', 'diplomado')->paginate(12); 
    return view('diplomados.index', compact('programas'))->with('title', 'Cursos');
})->name('diplomados.index');

Route::get('/cursos', function () {
    $programas = \App\Course::where('programa', 'curso')->paginate(12); 
    return view('cursos.index', compact('programas'))->with('title', 'Cursos');
})->name('cursos.index');

Route::get('/seminarios', function () {
    $programas = \App\Course::where('programa', 'curso')->paginate(12); 
    return view('seminarios.index', compact('programas'))->with('title', 'Cursos');
})->name('seminarios.index');

Route::get('/courses/{course}', 'WelcomeController@show')->name('courses.show');
Route::get('/checkout/{course}', 'CheckoutController@show')->name('checkout');

Route::post('/izipay/webhook', 'CheckoutController@webhook')->name('izipay.webhook');

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

    Route::get('/cursos/{id}/editar', 'Docente\CourseController@edit')
        ->name('courses.edit');

    Route::put('/cursos/{id}', 'Docente\CourseController@update')
        ->name('courses.update');


    //MODULO CRUD SILABOS DEL CURSO
    Route::get('/cursos/{course}/syllabus', 'Docente\SyllabusController@index')
            ->name('syllabus.index');

    Route::get('/cursos/{course}/syllabus/create', 'Docente\SyllabusController@create')
            ->name('syllabus.create');

    Route::post('/cursos/{course}/syllabus', 'Docente\SyllabusController@store')
            ->name('syllabus.store');

    Route::get('/cursos/{course}/syllabus/{syllabus}/edit', 'Docente\SyllabusController@edit')
            ->name('syllabus.edit');
    
    Route::put('/cursos/{course}/syllabus/{syllabus}', 'Docente\SyllabusController@update')
            ->name('syllabus.update');


    //MODULO CRUD DOCENTE 
    Route::resource('docentes', 'Admin\DocenteController');
    
    // MÓDULO GESTIÓN DE ESTUDIANTES
	Route::get('/estudiantes', 'Admin\StudentController@index')->name('admin.students.index');
	Route::get('/estudiantes/{student}', 'Admin\StudentController@show')->name('admin.students.show');
	Route::delete('/estudiantes/{student}', 'Admin\StudentController@destroy')->name('admin.students.destroy');
	Route::patch('/estudiantes/{student}/cursos/{courseId}/paid', 'Admin\StudentController@togglePaid')->name('admin.students.toggle-paid');
});


Route::middleware(['auth', 'role:student'])
    ->prefix('alumno')
    ->name('alumno.')
    ->group(function () {

        // Lista de cursos
        Route::get('/courses', 'Student\CourseController@index')->name('courses.index');

       
        // Cursos inscritos
        Route::get('/mis-cursos', 'Student\EnrollmentController@myCourses')->name('mis-courses');

        // Ver sílabo
        Route::get('/mis-cursos/{course}', 'Student\CourseController@show')->name('courses.show');

         // ✅ Vista de progreso + temario + videos
        Route::get('/mis-cursos/{course}/progress', 'Student\CourseController@progress')->name('courses.progress');

        // ✅ Marcar lección como completada
        Route::post('/mis-cursos/{course}/lessons/{lesson}/complete', 'Student\CourseController@completeLesson')->name('lessons.complete');

        // Checkout (solo alumno autenticado)
        Route::get('/checkout/{course}', 'CheckoutController@show')->name('checkout');

         // Inscribirse a un curso
        Route::post('/courses/{course}/enroll', 'Student\EnrollmentController@enroll')->name('courses.enroll');

        // Pagar el curso
        Route::post('/curso/{course}/checkout', 'CheckoutController@pay')->name('checkout.pay');

        Route::post('/courses/{course}/review', 'WelcomeController@storeStart')->name('reviews.store');
        
        Route::get('/perfil', 'Student\ProfileController@index')->name('perfil');
	Route::post('/perfil/update', 'Student\ProfileController@update')->name('perfil.update');
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

