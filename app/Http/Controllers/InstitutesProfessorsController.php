<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ProfessorLeadsForInstituteRequest;
use App\Institute;
use App\Professor;
use Flash;
use Redirect;
use View;

class InstitutesProfessorsController extends Controller
{

    /**
     * Añade un instituto a un profesor como lider del mismo.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function createLeadForProfessor($id)
    {
        $professor  = Professor::findOrFail($id);
        $institutes = Institute::pluck('name', 'id');

        return View::make(
            'institutesProfessors.forms.createLeadProfessor',
            compact('professor', 'institutes')
        );
    }

    /**
     * Añade un profesor en un instituto como lider del mismo.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function createLeadForInstitute($id)
    {
        $professors = [];
        $institute  = Institute::findOrFail($id);
        Professor::all()
            ->load('personalDetails')
            ->each(function (Professor $professor) use (&$professors) {
                $surname = $professor->personalDetails->first_surname;
                $name    = $professor->personalDetails->first_name;
                $ci      = $professor->personalDetails->ci;
                $data    = "{$surname}, {$name}. {$ci}";

                $professors[$professor->id] = $data;
            });

        if (!$professors) {
            Flash::error('No hay Profesores disponibles para asignar');

            return Redirect::back();
        }

        return View::make(
            'institutesProfessors.forms.createLeadInstitute',
            compact('institute', 'professors')
        );
    }

    /**
     * Añade un profesor en un instituto como lider del mismo.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function createProfessorForInstitute($id)
    {
        $professors = [];
        /** @var Institute $institute */
        $institute = Institute::findOrFail($id);
        $existing  = $institute->professors()->pluck('id');

        Professor::whereNotIn('id', $existing)
            ->with('personalDetails')
            ->get()
            ->each(function (Professor $professor) use (&$professors) {
                $surname = $professor->personalDetails->first_surname;
                $name    = $professor->personalDetails->first_name;
                $ci      = $professor->personalDetails->ci;
                $data    = "{$surname}, {$name}. {$ci}";

                $professors[$professor->id] = $data;
            });

        if (!$professors) {
            Flash::error('No hay Profesores disponibles para asignar');

            return Redirect::back();
        }

        return View::make(
            'institutesProfessors.forms.createProfInstitute',
            compact('institute', 'professors')
        );
    }

    /**
     * Guarda un profesor en un instituto como lider del mismo.
     *
     * @param int $id
     * @param \App\Http\Requests\ProfessorLeadsForInstituteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeProfessorForInstitute(
        $id,
        ProfessorLeadsForInstituteRequest $request
    ) {
        /** @var Institute $institute */
        $institute = Institute::findOrFail($id);
        $input     = $request->input('professors');
        $position  = $request->input('position');
        $this->insertProfessor($institute, $input, $position, false);

        return Redirect::route('institutes.show', $institute->id);
    }

    /**
     * Inserta adecuadamente algun profesor a la base de datos.
     *
     * @param \App\Institute $institute
     * @param int $id
     * @param string $position detalla el cargo asociado al profesor
     * @param bool $leads determina si es o no encargado del instituto
     */
    public function insertProfessor(
        Institute $institute,
        $id,
        $position,
        $leads
    ) {
        $isEmpty = $institute->professors()->whereId($id)->get()->isEmpty();

        // si no esta vacio debemos separar a este
        // profesor para reasignarlo como lider
        if (!$isEmpty) {
            $institute->professors()->detach($id);
        }

        $institute->professors()->attach($id, [
            'leads'    => $leads,
            'position' => $position,
        ]);
    }

    /**
     * Guarda un profesor en un instituto como lider del mismo.
     *
     * @param int $id
     * @param \App\Http\Requests\ProfessorLeadsForInstituteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLeadForInstitute(
        $id,
        ProfessorLeadsForInstituteRequest $request
    ) {
        /** @var Institute $institute */
        $institute = Institute::findOrFail($id);
        $input     = $request->input('professors');
        $position  = $request->input('position');
        $this->insertProfessor($institute, $input, $position, true);

        return Redirect::route('institutes.show', $institute->id);
    }

    /**
     * Elimina la relacion entre un profesor y un instituto
     *
     * @param int $professorId
     * @param int $instituteId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyProfessorInstitute($professorId, $instituteId)
    {
        /** @var Institute $institute */
        $institute = Institute::findOrFail($instituteId);
        $institute->professors()->detach([$professorId]);

        Flash::success('Profesor eliminado correctamente.');

        return Redirect::route('institutes.show', $institute->id);
    }
}
