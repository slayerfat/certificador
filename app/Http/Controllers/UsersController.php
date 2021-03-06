<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Flash;
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

        $this->middleware('auth.notAdmin', [
            'only' => [
                'index',
                'create',
                'store',
            ],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $users = User::all()->load('personalDetails');

        return View::make('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create()
    {
        return View::make('users.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\UserRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'admin'    => $request->input('admin') ? true : false,
        ]);

        Flash::success('Usuario creado correctamente.');

        return Redirect::route('users.show', $user->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param \Slayerfat\PhoneParser\Interfaces\PhoneParserInterface $phoneParser
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($id, PhoneParserInterface $phoneParser)
    {
        $user = User::whereName($id)->first();

        if (!$user) {
            $user = User::findOrFail($id);
        }

        $user->load('personalDetails', 'personalDetails.professor', 'personalDetails.events');

        return View::make('users.show', compact('user', 'phoneParser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\Response
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
     * @return \Symfony\Component\HttpFoundation\Response
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
        $user->admin = $request->input('admin') ? true : false;

        $user->save();

        Flash::success('Usuario actualizado correctamente.');

        return Redirect::route('users.show', $user->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = User::findOrFail($id);

        if ($this->destroyPrototype($user, 'delete', 'Usuario', 'Eventos')) {
            return Redirect::route('users.index');
        }

        return Redirect::route('users.show', $id);
    }
}
