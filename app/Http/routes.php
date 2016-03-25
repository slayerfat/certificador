<?php

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::get('/pdf', function () {
    $pdf = App::make('dompdf.wrapper');

    $pdf->loadView('events.pdf.CUFM');
    $pdf->setOrientation('landscape');

    return $pdf->stream();
});

Route::get('/view', function () {
    return view('events.pdf.CUFM');
});

Route::group(['middleware' => ['web']], function () {
    Route::auth();

    Route::get(
        '/home',
        ['as' => 'home.index', 'uses' => 'HomeController@index']
    );

    // Prof.
    Route::get(
        '/profesores',
        ['as' => 'professors.index', 'uses' => 'ProfessorsController@index']
    );
    Route::get(
        '/profesores/crear/{personalDetailsID}',
        ['as' => 'professors.create', 'uses' => 'ProfessorsController@create']
    );
    Route::post(
        '/profesores/{personalDetailsID}',
        ['as' => 'professors.store', 'uses' => 'ProfessorsController@store']
    );
    Route::get(
        '/profesores/{id}/editar',
        ['as' => 'professors.edit', 'uses' => 'ProfessorsController@edit']
    );
    Route::patch(
        '/profesores/{id}',
        ['as' => 'professors.update', 'uses' => 'ProfessorsController@update']
    );
    Route::delete(
        '/profesores/{id}',
        ['as' => 'professors.destroy', 'uses' => 'ProfessorsController@destroy']
    );

    // Users
    Route::get(
        '/usuarios',
        ['as' => 'users.index', 'uses' => 'UsersController@index']
    );
    Route::get(
        '/usuarios/crear',
        ['as' => 'users.create', 'uses' => 'UsersController@create']
    );
    Route::get(
        '/usuarios/{id}',
        ['as' => 'users.show', 'uses' => 'UsersController@show']
    );
    Route::post(
        '/usuarios',
        ['as' => 'users.store', 'uses' => 'UsersController@store']
    );
    Route::get(
        '/usuarios/{id}/editar',
        ['as' => 'users.edit', 'uses' => 'UsersController@edit']
    );
    Route::patch(
        '/usuarios/{id}',
        ['as' => 'users.update', 'uses' => 'UsersController@update']
    );
    Route::delete(
        '/usuarios/{id}',
        ['as' => 'users.destroy', 'uses' => 'UsersController@destroy']
    );

    // Personal Details
    Route::get(
        '/datos-personales/crear/{userID}',
        ['as' => 'personalDetails.create', 'uses' => 'PersonalDetailsController@create']
    );
    Route::post(
        '/datos-personales/{userID}',
        ['as' => 'personalDetails.store', 'uses' => 'PersonalDetailsController@store']
    );
    Route::get(
        '/datos-personales/{id}/editar',
        ['as' => 'personalDetails.edit', 'uses' => 'PersonalDetailsController@edit']
    );
    Route::patch(
        '/datos-personales/{id}',
        ['as' => 'personalDetails.update', 'uses' => 'PersonalDetailsController@update']
    );

    // Titles
    Route::get(
        '/titulos',
        ['as' => 'titles.index', 'uses' => 'TitlesController@index']
    );
    Route::get(
        '/titulos/crear',
        ['as' => 'titles.create', 'uses' => 'TitlesController@create']
    );
    Route::get(
        '/titulos/{id}',
        ['as' => 'titles.show', 'uses' => 'TitlesController@show']
    );
    Route::post(
        '/titulos',
        ['as' => 'titles.store', 'uses' => 'TitlesController@store']
    );
    Route::get(
        '/titulos/{id}/editar',
        ['as' => 'titles.edit', 'uses' => 'TitlesController@edit']
    );
    Route::patch(
        '/titulos/{id}',
        ['as' => 'titles.update', 'uses' => 'TitlesController@update']
    );
    Route::delete(
        '/titulos/{id}',
        ['as' => 'titles.destroy', 'uses' => 'TitlesController@destroy']
    );
});
