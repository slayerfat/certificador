<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\User;
use Flash;
use Illuminate\Http\Request;
use Redirect;
use Slayerfat\PhoneParser\Interfaces\PhoneParserInterface;
use View;

class UsersController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param PhoneParserInterface $phoneParser
     * @return \Illuminate\Http\Response
     */
    public function show($id, PhoneParserInterface $phoneParser)
    {
        $user = User::whereName($id)->firstOrFail()->load('personalDetails');

        return View::make('users.show', compact('user', 'phoneParser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return View::make('users.forms.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UserRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        /** @var User $user */
        $user = User::findOrFail($id);

        if (!empty($request->input('password'))) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->name  = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        Flash::success('Usuario actualizado correctamente.');

        return Redirect::route('users.show', $user->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
