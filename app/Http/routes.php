<?php

Route::get('/', function () {
    return view('welcome');
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
});
