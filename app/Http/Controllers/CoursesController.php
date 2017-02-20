<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;

class CoursesController extends Controller
{
    public function index()
    {
    	return response()->json(Course::all());
    }

    public function store()
    {
    	$this->validate(request(), [
    		'name' => 'required',
    		'id' => 'required|unique:courses'
  		]);

  		$course = Course::forceCreate([
  			'name' => request('name'),
  			'id' => request('id')
  		]);

  		return ['message' => 'Curso Agregado!', 'object' => $course];
    }

    public function destroy(Course $course)
    {
      if(!$course->hasWorkshops()) {
        $course->delete();
        return ['message' => 'Curso Eliminado!', 'object' => $course];
      } else {
        return response()->json(['message' => 'No se pudo eliminar el curso!'], 422);
      }
    }
}
