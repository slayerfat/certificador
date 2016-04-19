<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ProfessorRequest;
use App\PersonalDetail;
use App\Professor;
use App\Title;
use Flash;
use Gate;
use Redirect;
use View;

class ProfessorsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professors = Professor::all();

        return View::make('professors.index', compact('professors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $details = PersonalDetail::findOrFail($id);

        if (Gate::denies('createProfessor', $details)) {
            Flash::error('Ud. no tiene permisos para esta acción.');

            return Redirect::back();
        }

        $titles = Title::pluck('desc', 'id');

        return View::make(
            'professors.forms.create',
            compact('details', 'titles')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $id
     * @param \App\Http\Requests\ProfessorRequest $request
     * @param \App\Professor $professor
     * @return \Illuminate\Http\Response
     */
    public function store($id, ProfessorRequest $request, Professor $professor)
    {
        /** @var PersonalDetail $details */
        $details = PersonalDetail::findOrFail($id);

        if (Gate::denies('createProfessor', $details)) {
            Flash::error('Ud. no tiene permisos para esta acción.');

            return Redirect::back();
        }

        $professor->title_id = $request->input('title_id');
        $details->professor()->save($professor);

        return Redirect::route('users.show', $details->user_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $professor = Professor::findOrFail($id);

        if (Gate::denies('update', $professor)) {
            Flash::error('Ud. no tiene permisos para esta acción.');

            return Redirect::back();
        }

        $titles = Title::pluck('desc', 'id');

        return View::make(
            'professors.forms.edit',
            compact('professor', 'titles')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ProfessorRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfessorRequest $request, $id)
    {
        /** @var Professor $professor */
        $professor = Professor::findOrFail($id)->load('personalDetails');

        if (Gate::denies('update', $professor)) {
            Flash::error('Ud. no tiene permisos para esta acción.');

            return Redirect::back();
        }

        $professor->title_id = $request->input('title_id');
        $professor->save();

        return Redirect::route(
            'users.show',
            $professor->personalDetails->user_id
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** @var Professor $professor */
        $professor = Professor::findOrFail($id);
        $user      = $professor->personalDetails->user;

        $this->destroyPrototype($professor, 'delete', 'Profesor');

        return Redirect::route('users.show', $user->id);
    }
}
