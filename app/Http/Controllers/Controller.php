<?php

namespace App\Http\Controllers;

use Exception;
use HttpException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Ejecuta un delete en la base de datos por medio de Eloquent.
     * Cuando se ejecuta el delete tambien genera el flash
     * de sesion relacion a la actividad por medio de
     * los parametros establecidos de recurso e hijo
     * junto al metodo (tal vez borrar parametro).
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $method el tipo de metodo a ejecutar (delete|forceDelete)
     * @param string $resource El nombre del recurso en texto legible.
     * @param string $child El nombre del recurso hijo en texto legible.
     * @return bool|\Illuminate\Database\Eloquent\Model
     * @throws \HttpException
     */
    protected function destroyPrototype(
        Model $model,
        $method,
        $resource = "Recurso",
        $child = "Recursos"
    ) {
        try {
            $model->$method();
        } catch (Exception $e) {
            // si la excepcion es una instancia de QueryException es muy probable
            // que sea por algun error en cuanto a la relacion,
            // es decir, por violacion de integridad.
            if ($e instanceof QueryException || $e->getCode() == 23000) {
                flash()->error("No deben haber {$child} asociados.");

                return $model;
            }
            // si no es una instancia de QueryException,
            // entonces hay problemas inesperados.
            throw new HttpException(
                500,
                "No se pudo eliminar al {$resource}, error inesperado.",
                $e
            );
        }

        flash()->success("El {$resource} ha sido eliminado correctamente.");

        return true;
    }
}
