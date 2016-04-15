<?php

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('welcome');
    });
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
        ['as'   => 'personalDetails.create',
         'uses' => 'PersonalDetailsController@create',
        ]
    );
    Route::post(
        '/datos-personales/{userID}',
        ['as'   => 'personalDetails.store',
         'uses' => 'PersonalDetailsController@store',
        ]
    );
    Route::get(
        '/datos-personales/{id}/editar',
        ['as'   => 'personalDetails.edit',
         'uses' => 'PersonalDetailsController@edit',
        ]
    );
    Route::patch(
        '/datos-personales/{id}',
        ['as'   => 'personalDetails.update',
         'uses' => 'PersonalDetailsController@update',
        ]
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

    // Institutes
    Route::get(
        '/institutos',
        ['as' => 'institutes.index', 'uses' => 'InstitutesController@index']
    );
    Route::get(
        '/institutos/crear',
        ['as' => 'institutes.create', 'uses' => 'InstitutesController@create']
    );
    Route::get(
        '/institutos/{id}',
        ['as' => 'institutes.show', 'uses' => 'InstitutesController@show']
    );
    Route::post(
        '/institutos',
        ['as' => 'institutes.store', 'uses' => 'InstitutesController@store']
    );
    Route::get(
        '/institutos/{id}/editar',
        ['as' => 'institutes.edit', 'uses' => 'InstitutesController@edit']
    );
    Route::patch(
        '/institutos/{id}',
        ['as' => 'institutes.update', 'uses' => 'InstitutesController@update']
    );
    Route::delete(
        '/institutos/{id}',
        ['as' => 'institutes.destroy', 'uses' => 'InstitutesController@destroy']
    );

    // Events
    Route::get(
        '/eventos',
        ['as' => 'events.index', 'uses' => 'EventsController@index']
    );
    Route::get(
        '/eventos/crear',
        ['as' => 'events.create', 'uses' => 'EventsController@create']
    );
    Route::get(
        '/eventos/{id}',
        ['as' => 'events.show', 'uses' => 'EventsController@show']
    );
    Route::post(
        '/eventos',
        ['as' => 'events.store', 'uses' => 'EventsController@store']
    );
    Route::get(
        '/eventos/{id}/editar',
        ['as' => 'events.edit', 'uses' => 'EventsController@edit']
    );
    Route::patch(
        '/eventos/{id}',
        ['as' => 'events.update', 'uses' => 'EventsController@update']
    );
    Route::delete(
        '/eventos/{id}',
        ['as' => 'events.destroy', 'uses' => 'EventsController@destroy']
    );

    // Asignar profesores a eventos
    Route::get(
        '/eventos/crear-profesores/{id}',
        [
            'as'   => 'events.createProfessors',
            'uses' => 'EventsController@createProfessors',
        ]
    );
    Route::post(
        '/eventos/crear-profesores/{id}',
        [
            'as'   => 'events.storeProfessors',
            'uses' => 'EventsController@storeProfessors',
        ]
    );

    // asignar participantes a evento
    Route::get(
        '/eventos/crear-participantes/{id}',
        [
            'as'   => 'events.createAttendants',
            'uses' => 'EventsController@createAttendants',
        ]
    );
    Route::post(
        '/eventos/crear-participantes/{id}',
        [
            'as'   => 'events.storeAttendants',
            'uses' => 'EventsController@storeAttendants',
        ]
    );

    // Elimina profesor de evento
    Route::delete(
        '/eventos/eliminar-profesor/{professor}/{event}',
        [
            'as'   => 'events.destroyProfessor',
            'uses' => 'EventsController@destroyProfessor',
        ]
    );

    // Elimina participante de evento
    Route::delete(
        '/eventos/eliminar-participante/{professor}/{event}',
        [
            'as'   => 'events.destroyAttendant',
            'uses' => 'EventsController@destroyAttendant',
        ]
    );

    // Certificados
    Route::get(
        '/eventos/pdf/{event}',
        ['as' => 'events.indexPdf', 'uses' => 'EventsController@indexPdf']
    );

    Route::get(
        '/eventos/pdf/{attendant}/{event}',
        ['as' => 'events.showPdf', 'uses' => 'EventsController@showPdf']
    );

    // InstitutesProfessors
    // Desde instituto a profesor (LEAD)
    Route::get(
        '/institutos-profesores/crear-lead-inst-to-prof/{id}',
        [
            'as'   => 'institutesProfessors.createLeadFromInstToProf',
            'uses' => 'InstitutesProfessorsController@createLeadFromInstituteToProfessor',
        ]
    );
    Route::post(
        '/institutos-profesores/crear-lead-inst-to-prof/{id}',
        [
            'as'   => 'institutesProfessors.storeLeadFromInstToProf',
            'uses' => 'InstitutesProfessorsController@storeLeadFromInstituteToProfessor',
        ]
    );

    // Desde instituto a profesor (NO LEAD)
    Route::get(
        '/institutos-profesores/crear-no-lead-from-inst-to-prof/{id}',
        [
            'as'   => 'institutesProfessors.createNoLeadFromInstToProf',
            'uses' => 'InstitutesProfessorsController@createNoLeadFromInstituteToProfessor',
        ]
    );
    Route::post(
        '/institutos-profesores/crear-no-lead-from-inst-to-prof/{id}',
        [
            'as'   => 'institutesProfessors.storeNoLeadFromInstToProf',
            'uses' => 'InstitutesProfessorsController@storeNoLeadFromInstituteToProfessor',
        ]
    );

    // Desde Profesor a Instituto (LEAD)
    Route::get(
        '/institutos-profesores/crear-lead-prof-to-inst/{id}',
        [
            'as'   => 'institutesProfessors.createLeadFromProfToInst',
            'uses' => 'InstitutesProfessorsController@createLeadFromProfessorToInstitute',
        ]
    );
    Route::post(
        '/institutos-profesores/crear-lead-prof-to-inst/{id}',
        [
            'as'   => 'institutesProfessors.storeLeadFromProfToInst',
            'uses' => 'InstitutesProfessorsController@storeLeadFromProfessorToInstitute',
        ]
    );

    // Desde Profesor a Instituto (NO LEAD)
    Route::get(
        '/institutos-profesores/crear-no-lead-from-prof-to-inst/{id}',
        [
            'as'   => 'institutesProfessors.createNoLeadFromProfToInst',
            'uses' => 'InstitutesProfessorsController@createNoLeadFromProfessorToInstitute',
        ]
    );
    Route::post(
        '/institutos-profesores/crear-no-lead-from-prof-to-inst/{id}',
        [
            'as'   => 'institutesProfessors.storeNoLeadFromProfToInst',
            'uses' => 'InstitutesProfessorsController@storeNoLeadFromProfessorToInstitute',
        ]
    );

    // Eliminar profesor de instituto
    Route::delete(
        '/institutos-profesores/eliminar-prof-inst/{professor}/{institute}',
        [
            'as'   => 'institutesProfessors.destroyProfInst',
            'uses' => 'InstitutesProfessorsController@destroyProfessorInstitute',
        ]
    );
});
