<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\InstituteLeadForProfessorRequest;
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
    public function createLeadFromProfessorToInstitute($id)
    {
        /** @var Professor $professor */
        $professor = Professor::findOrFail($id);

        $ids = $professor->institutes()->where('leads', true)->pluck('id');

        /** @var \Illuminate\Support\Collection $institutes */
        $institutes = Institute::whereNotIn('id', $ids)->pluck('name', 'id');

        if ($institutes->isEmpty()) {
            Flash::error('No hay Institutos disponibles para asignar');

            return Redirect::back();
        }

        return View::make(
            'institutesProfessors.forms.createLeadFromProfToInst',
            compact('professor', 'institutes')
        );
    }

    /**
     * Añade un instituto a un profesor como lider del mismo.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function createNoLeadFromProfessorToInstitute($id)
    {
        /** @var Professor $professor */
        $professor = Professor::findOrFail($id);
        $ids       = $professor->institutes()->pluck('id');

        /** @var \Illuminate\Support\Collection $institutes */
        $institutes = Institute::whereNotIn('id', $ids)->pluck('name', 'id');

        if ($institutes->isEmpty()) {
            Flash::error('No hay Institutos disponibles para asignar');

            return Redirect::back();
        }

        return View::make(
            'institutesProfessors.forms.createNoLeadFromProfToInst',
            compact('professor', 'institutes')
        );
    }

    /**
     * Añade un profesor en un instituto como lider del mismo.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function createLeadFromInstituteToProfessor($id)
    {
        $professors = [];
        $institute  = Institute::findOrFail($id);
        Professor::all()
            ->load('personalDetails')
            ->each(
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
            'institutesProfessors.forms.createLeadFromInstToProf',
            compact('institute', 'professors')
        );
    }

    /**
     * Añade un profesor en un instituto como lider del mismo.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function createNoLeadFromInstituteToProfessor($id)
    {
        $professors = [];
        /** @var Institute $institute */
        $institute = Institute::findOrFail($id);
        $existing  = $institute->professors()->pluck('id');

        Professor::whereNotIn('id', $existing)
            ->with('personalDetails')
            ->get()
            ->each(
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
            'institutesProfessors.forms.createNoLeadFromInstToProf',
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
    public function storeNoLeadFromInstituteToProfessor(
        $id,
        ProfessorLeadsForInstituteRequest $request
    ) {
        /** @var Institute $institute */
        $institute = Institute::findOrFail($id);
        $input     = $request->input('professors');
        $position  = $request->input('position');
        $this->insertProfessor($institute, $input, $position, false);

        Flash::success('Profesor asignado correctamente.');

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

        // si se pretende insertar un lead, debemos determinar
        // si hay uno existente para separarlo
        if ($leads) {
            $leader = $institute->leader();

            if ($leader) {
                $institute->professors()->updateExistingPivot(
                    $leader->id,
                    [
                        'leads'    => false,
                        'position' => $leader->position,
                    ]
                );
            }
        }

        $institute->professors()->attach(
            $id,
            [
                'leads'    => $leads,
                'position' => $position,
            ]
        );
    }

    /**
     * Guarda un profesor en un instituto como lider del mismo.
     *
     * @param int $id
     * @param \App\Http\Requests\ProfessorLeadsForInstituteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLeadFromInstituteToProfessor(
        $id,
        ProfessorLeadsForInstituteRequest $request
    ) {
        /** @var Institute $institute */
        $institute = Institute::findOrFail($id);
        $input     = $request->input('professors');
        $position  = $request->input('position');
        $this->insertProfessor($institute, $input, $position, true);

        Flash::success('Profesor asignado correctamente.');

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

    /**
     * Guarda un profesor en un instituto como lider del mismo.
     *
     * @param int $id
     * @param \App\Http\Requests\InstituteLeadForProfessorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLeadFromProfessorToInstitute(
        $id,
        InstituteLeadForProfessorRequest $request
    ) {
        /** @var Professor $professor */
        $professor = Professor::findOrFail($id)
            ->load('personalDetails', 'personalDetails.user');
        $input     = $request->input('institutes');
        $position  = $request->input('position');
        $this->insertProfessorFromSelf($professor, $input, $position, true);

        Flash::success('Profesor asignado correctamente.');

        return Redirect::route(
            'users.show',
            $professor->personalDetails->user->id
        );
    }

    /**
     * Inserta adecuadamente algun profesor a la base de datos.
     *
     * @param \App\Professor $professor
     * @param int $id
     * @param string $position detalla el cargo asociado al profesor
     * @param bool $leads determina si es o no encargado del instituto
     */
    public function insertProfessorFromSelf(
        Professor $professor,
        $id,
        $position,
        $leads
    ) {
        $isEmpty = $professor->institutes()->whereId($id)->get()->isEmpty();

        // si no esta vacio debemos separar a este
        // profesor para reasignarlo como lider
        if (!$isEmpty) {
            $professor->institutes()->detach($id);
        }

        $professor->institutes()->attach(
            $id,
            [
                'leads'    => $leads,
                'position' => $position,
            ]
        );
    }

    /**
     * Guarda un profesor en un instituto.
     *
     * @param int $id
     * @param \App\Http\Requests\InstituteLeadForProfessorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeNoLeadFromProfessorToInstitute(
        $id,
        InstituteLeadForProfessorRequest $request
    ) {
        /** @var Professor $professor */
        $professor = Professor::findOrFail($id)
            ->load('personalDetails', 'personalDetails.user');
        $input     = $request->input('institutes');
        $position  = $request->input('position');
        $this->insertProfessorFromSelf($professor, $input, $position, false);

        Flash::success('Profesor asignado correctamente.');

        return Redirect::route(
            'users.show',
            $professor->personalDetails->user->id
        );
    }

    /**
     * Guarda un profesor en un instituto.
     *
     * @param int $id
     * @param \App\Http\Requests\InstituteLeadForProfessorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeInstituteForProfessor(
        $id,
        InstituteLeadForProfessorRequest $request
    ) {
        /** @var Professor $professor */
        $professor = Professor::findOrFail($id);
        $input     = $request->input('institutes');
        $position  = $request->input('position');
        $this->insertProfessorFromSelf($professor, $input, $position, false);

        Flash::success('Profesor asignado correctamente.');

        return Redirect::route('professors.show', $professor->id);
    }
}
