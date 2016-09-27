<?php

namespace App\Http\Controllers;

use App;
use App\Event;
use App\Http\Requests\EventAttendantRequest;
use App\Http\Requests\EventProfessorRequest;
use App\Http\Requests\EventRequest;
use App\Institute;
use App\PersonalDetail;
use App\Professor;
use Auth;
use Carbon\Carbon;
use Flash;
use Redirect;
use View;

class EventsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.notAdmin', [
            'except' => ['index', 'show', 'createAttendantFromSelf', 'showPdf'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $events = Event::all();

        return View::make('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Symfony\Component\HttpFoundation\Response
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
     * @return \Symfony\Component\HttpFoundation\Response
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
     * @return \Symfony\Component\HttpFoundation\Response
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
     * @return \Symfony\Component\HttpFoundation\Response
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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(EventRequest $request, $id)
    {
        $event               = Event::findOrFail($id)->load('institute');
        $event->institute_id = $request->input('institute_id');
        $event->update($request->all());

        return Redirect::route('events.show', $event->id);
    }

    /**
     * Genera el formulario para insertar profesores al evento.
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAttendants($id)
    {
        /** @var Event $event */
        $event      = Event::findOrFail($id);
        $attendants = [];
        $existing   = $event->attendants()->pluck('id');

        PersonalDetail::whereNotIn('id', $existing)->each(
            function (PersonalDetail $attendant) use (&$attendants) {
                $surname = $attendant->first_surname;
                $name    = $attendant->first_name;
                $ci      = $attendant->ci;
                $data    = "{$surname}, {$name}. {$ci}";

                $attendants[$attendant->id] = $data;
            }
        );

        if (!$attendants) {
            Flash::error('No hay Participantes disponibles para asignar');

            return Redirect::back();
        }

        return View::make(
            'events.forms.createAttendants',
            compact('event', 'attendants')
        );
    }

    /**
     * Genera el formulario para insertar profesores al evento.
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAttendantFromSelf($id)
    {
        /** @var Event $event */
        $event = Event::findOrFail($id);
        $user  = Auth::user();

        if (!$user->personalDetails) {
            Flash::error('Para poder participar debe Ud. poseer datos personales.');

            return Redirect::back();
        }

        $event->attendants()->sync([
            $user->personalDetails->id => [
                'approved' => $user->admin,
            ],
        ]);

        Flash::success('Participante añadido correctamente.');

        return Redirect::route('events.show', $event->id);
    }

    /**
     * Guarda los profesores a ser asignados a un evento.
     *
     * @param int $id
     * @param \App\Http\Requests\EventAttendantRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function storeAttendants($id, EventAttendantRequest $request)
    {
        /** @var Event $event */
        $event = Event::findOrFail($id);
        $event->attendants()->attach($request->input('attendants'), [
            'approved' => Auth::user()->admin,
        ]);

        Flash::success('Evento actualizado correctamente.');

        return Redirect::route('events.show', $event->id);
    }

    /**
     * Guarda los profesores a ser asignados a un evento.
     *
     * @param int $attendantId
     * @param int $eventId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function approveAttendant($attendantId, $eventId)
    {
        if (!Auth::user()->admin) {
            Flash::error('Ud. no tiene permisos para esta acción');

            Auth::logout();

            return Redirect::back();
        }

        /** @var PersonalDetail $attendant */
        $attendant = PersonalDetail::findOrFail($attendantId);
        $event     = $attendant->events()->where('id', $eventId)->first();

        $event->attendants()->updateExistingPivot($attendantId, [
            'approved' => true,
        ]);

        Flash::success('Participante actualizado correctamente.');

        return Redirect::route('events.show', $event->id);
    }

    /**
     * Genera el formulario para insertar profesores al evento.
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createProfessors($id)
    {
        /** @var Event $event */
        $event      = Event::findOrFail($id);
        $professors = [];
        $existing   = $event->professors()->pluck('id');

        Professor::whereNotIn('id', $existing)->with('personalDetails')->each(
            function (Professor $professor) use (&$professors) {
                $surname = $professor->personalDetails->first_surname;
                $name    = $professor->personalDetails->first_name;
                $ci      = $professor->personalDetails->ci;
                $data    = "{$surname}, {$name}. {$ci}";

                $professors[$professor->id] = $data;
            }
        );

        if (!$professors) {
            Flash::error('No hay Profesores disponibles para asignar');

            return Redirect::back();
        }

        return View::make(
            'events.forms.createProfessors',
            compact('event', 'professors')
        );
    }

    /**
     * Guarda los profesores a ser asignados a un evento.
     *
     * @param int $id
     * @param \App\Http\Requests\EventProfessorRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function storeProfessors($id, EventProfessorRequest $request)
    {
        /** @var Event $event */
        $event = Event::findOrFail($id);
        $event->professors()->attach($request->input('professors'), [
            'position' => $request->input('position'),
        ]);

        Flash::success('Evento actualizado correctamente.');

        return Redirect::route('events.show', $event->id);
    }

    /**
     * Elimina un profesor de un evento
     *
     * @param int $professorId
     * @param int $eventId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyProfessor($professorId, $eventId)
    {
        /** @var Event $event */
        $event = Event::findOrFail($eventId);
        $event->professors()->detach([$professorId]);

        Flash::success('Profesor eliminado correctamente.');

        return Redirect::route('events.show', $event->id);
    }

    /**
     * Elimina un profesor de un evento
     *
     * @param int $attendantId
     * @param int $eventId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyAttendant($attendantId, $eventId)
    {
        /** @var Event $event */
        $event = Event::findOrFail($eventId);
        $event->attendants()->detach([$attendantId]);

        Flash::success('Participante eliminado correctamente.');

        return Redirect::route('events.show', $event->id);
    }

    /**
     * Genera un pdf de certificado de participante
     *
     * @param int $attendantId
     * @param int $eventId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showPdf($attendantId, $eventId)
    {
        /** @var PersonalDetail $attendant */
        $attendant = PersonalDetail::findOrFail($attendantId);

        if (!Auth::user()->isOwnerOrAdmin($attendant->user_id)) {
            Flash::error('Ud. no tiene permisos para esta acción.');

            return Redirect::back();
        }

        $event = $attendant->events()->where('id', $eventId)->first();

        if (!$event->pivot->approved) {
            Flash::error('Este Participante no esta aprobado para estar en este evento.');

            return Redirect::back();
        }

        $attendants = collect()->push($attendant);
        $pdf        = App::make('dompdf.wrapper');

        $pdf->loadView('events.pdf.CUFM', compact('attendants', 'event'));
        $pdf->setOrientation('landscape');

        return $pdf->stream();
    }

    public function indexPdf($eventId)
    {
        /** @var Event $event */
        $event      = Event::findOrFail($eventId);
        $attendants = $event->attendants()
                            ->wherePivot('approved', '=', true)
                            ->get();

        if ($attendants->isEmpty()) {
            Flash::error('No hay participantes asignados o aprobados para este evento.');

            return Redirect::back();
        }

        $pdf = App::make('dompdf.wrapper');

        $pdf->loadView('events.pdf.CUFM', compact('attendants', 'event'));
        $pdf->setOrientation('landscape');

        return $pdf->stream();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        /** @var Event $event */
        $event = Event::findOrFail($id);

        if ($event->date < Carbon::now()) {
            Flash::error('Este evento ya ocurrió, no puede ser eliminado.');

            return Redirect::route('events.show', $id);
        }

        if ($this->destroyPrototype($event, 'delete', 'Evento', 'Involucrados')) {
            return Redirect::route('events.index');
        }

        return Redirect::route('events.show', $id);
    }
}
