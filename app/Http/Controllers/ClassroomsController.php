<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Classroom;

class ClassroomsController extends Controller
{
    public function index()
    {
    	return response()->json(Classroom::all());
    }

    public function store()
    {
    	$this->validate(request(), [
    		'name' => 'required',
    		'id' => 'required|unique:classrooms'
  		]);

  		$classroom = Classroom::forceCreate([
  			'name' => request('name'),
  			'id' => request('id')
  		]);

  		return ['message' => 'Aula Agregada!', 'object' => $classroom];
    }

    public function destroy(Classroom $classroom)
    {
      $classroom->delete();
      return ['message' => 'Aula Eliminada!', 'object' => $classroom];
    }
}
