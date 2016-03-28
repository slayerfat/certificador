<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ProfessorLeadsForInstituteRequest;
use App\Institute;
use App\Professor;
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

        return View::make(
            'institutesProfessors.forms.createLeadInstitute',
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
    public function storeLeadForInstitute(
        $id,
        ProfessorLeadsForInstituteRequest $request
    ) {
        /** @var Institute $institute */
        $institute = Institute::findOrFail($id);
        $input     = $request->input('professors');
        $this->insertProfessor($institute, $input);

        return Redirect::route('institutes.show', $institute->id);
    }

    /**
     * Inserta adecuadamente algun profesor a la base de datos.
     *
     * @param \App\Institute $institute
     * @param int $id
     */
    public function insertProfessor(Institute $institute, $id)
    {
        $isEmpty = $institute->professors()->whereId($id)->get()->isEmpty();

        // si no esta vacio debemos separar a este
        // profesor para reasignarlo como lider
        if (!$isEmpty) {
            $institute->professors()->detach($id);
        }

        $institute->professors()->attach($id, [
            'leads' => true,
        ]);
    }
}
