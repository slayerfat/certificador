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
        '/usuarios/{id}/edit',
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
        '/datos-personales/{id}/edit',
        ['as' => 'personalDetails.edit', 'uses' => 'PersonalDetailsController@edit']
    );
    Route::patch(
        '/datos-personales/{id}',
        ['as' => 'personalDetails.update', 'uses' => 'PersonalDetailsController@update']
    );
});
