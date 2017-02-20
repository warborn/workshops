<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Teacher;

class TeachersController extends Controller
{
    public function index()
    {
    	return response()->json(Teacher::all());
    }

    public function store()
    {
    	$this->validate(request(), [
    		'name' => 'required',
    		'email' => 'required|email|unique:teachers'
  		]);

  		$teacher = Teacher::forceCreate([
  			'name' => request('name'),
  			'email' => request('email')
  		]);

  		return ['message' => 'Profesor Agregado!', 'object' => $teacher];
    }

    public function destroy(Teacher $teacher)
    {
      if(!$teacher->hasWorkshops()) {
        $teacher->delete();
        return ['message' => 'Profesor Eliminado!', 'object' => $teacher];
      } else {
        return response()->json(['message' => 'No se pudo eliminar el profesor!'], 422);
      }
    }
}
