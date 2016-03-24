<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PersonalDetailsRequest;
use App\PersonalDetail;
use App\User;
use Flash;
use Illuminate\Http\Request;
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::findOrFail($id);

        return View::make('personalDetails.forms.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $id
     * @param \App\Http\Requests\PersonalDetailsRequest $request
     * @param \App\PersonalDetail $details
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $user = User::findOrFail($id);
//
//        return View::make('users.forms.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var User $user */
//        $user = User::findOrFail($id);
//
//        if (!empty($request->input('password'))) {
//            $user->password = bcrypt($request->input('password'));
//        }
//
//        $user->name  = $request->input('name');
//        $user->email = $request->input('email');
//
//        $user->save();
//
//        Flash::success('Usuario actualizado correctamente.');
//
//        return Redirect::route('users.show', $user->name);
    }
}
