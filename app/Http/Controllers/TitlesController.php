<?php

namespace App\Http\Controllers;

use App\Http\Requests\TitleRequest;
use App\Title;
use Redirect;
use View;

class TitlesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.notAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $titles = Title::all();

        return View::make('titles.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create()
    {
        return View::make('titles.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\TitleRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(TitleRequest $request)
    {
        Title::create(['desc' => $request->input('desc')]);

        return Redirect::route('titles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($id)
    {
        $title = Title::findOrFail($id)->load(
            'professors',
            'professors.personalDetails',
            'professors.personalDetails.user'
        );

        return View::make('titles.show', compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit($id)
    {
        $title = Title::findOrFail($id);

        return View::make('titles.forms.edit', compact('title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\TitleRequest $request
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(TitleRequest $request, $id)
    {
        /** @var Title $title */
        $title = Title::findOrFail($id);
        $title->update($request->all());

        return Redirect::route('titles.show', $title->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        $title = Title::findOrFail($id);

        if ($this->destroyPrototype($title, 'delete', 'Titulo Descriptivo', 'Usuarios')) {
            return Redirect::route('titles.index');
        }

        return Redirect::route('titles.show', $id);
    }
}
