<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalDetailsRequest;
use App\PersonalDetail;
use App\Title;
use App\User;
use Flash;
use Redirect;
use View;

class PersonalDetailsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('personalDetails');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create($id)
    {
        $user   = User::findOrFail($id);
        $titles = Title::pluck('desc', 'id');

        return View::make('personalDetails.forms.create', compact('user', 'titles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $id
     * @param \App\Http\Requests\PersonalDetailsRequest $request
     * @param \App\PersonalDetail $details
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(
        $id,
        PersonalDetailsRequest $request,
        PersonalDetail $details
    ) {
        /** @var User $user */
        $user = User::findOrFail($id);

        $details->fill($request->all());

        $user->personalDetails()->save($details);

        Flash::success('Información personal añadida correctamente.');

        return Redirect::route('users.show', $user->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit($id)
    {
        $details = PersonalDetail::findOrFail($id);
        $titles  = Title::pluck('desc', 'id');

        return View::make('personalDetails.forms.edit', compact('details', 'titles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\PersonalDetailsRequest $request
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(PersonalDetailsRequest $request, $id)
    {
        $details = PersonalDetail::findOrFail($id)->load('user');

        $details->update($request->all());

        Flash::success('Datos personales actualizados correctamente.');

        return Redirect::route('users.show', $details->user->name);
    }
}
