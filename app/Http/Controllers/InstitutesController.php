<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\InstituteRequest;
use App\Institute;
use Redirect;
use View;

class InstitutesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.notAdmin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutes = Institute::all();

        return View::make('institutes.index', compact('institutes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('institutes.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\InstituteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstituteRequest $request)
    {
        Institute::create(['name' => $request->input('name')]);

        return Redirect::route('institutes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $institute = Institute::findOrFail($id);

        return View::make('institutes.show', compact('institute'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $institute = Institute::findOrFail($id);

        return View::make('institutes.forms.edit', compact('institute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\InstituteRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstituteRequest $request, $id)
    {
        /** @var Institute $institute */
        $institute = Institute::findOrFail($id);
        $institute->update(['name' => $request->input('name')]);

        return Redirect::route('institutes.show', $institute->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $title = Institute::findOrFail($id);

        if ($this->destroyPrototype($title, 'delete', 'Instituto')) {
            return Redirect::route('institutes.index');
        }

        return Redirect::route('institutes.show', $id);
    }
}
