<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests;
use App\Http\Requests\EventRequest;
use App\Institute;
use Redirect;
use View;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();

        return View::make('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institutes = Institute::pluck('name', 'id');

        return View::make('events.forms.create', compact('institutes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\EventRequest $request
     * @param \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request, Event $event)
    {
        /** @var Institute $institute */
        $institute = Institute::findOrFail($request->input('institute_id'));
        $event->fill($request->all());
        $institute->events()->save($event);

        return Redirect::route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);

        return View::make('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event      = Event::findOrFail($id);
        $institutes = Institute::pluck('name', 'id');

        return View::make(
            'events.forms.edit',
            compact('event', 'institutes')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\EventRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {
        $event               = Event::findOrFail($id)->load('institute');
        $event->institute_id = $request->input('institute_id');
        $event->update($request->all());

        return Redirect::route('events.show', $event->id);
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
