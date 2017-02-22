<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Workshop;

class WorkshopsController extends Controller
{
    public function index()
    {
    	return response()->json(Workshop::orderBy('day')->orderBy('start_hour')->with('teacher')->with('course')->with('classroom')->get());
    }

    public function store()
    {
    	$this->validate(request(), [
    		'teacher_id' => 'required',
    		'course_id' => 'required',
    		'classroom_id' => 'required',
    		'start_hour' => 'required',
    		'end_hour' => 'required',
    		'day' => 'required',
  		]);

  		$workshop = Workshop::forceCreate([
  			'teacher_id' => request('teacher_id'),
    		'course_id' => request('course_id'),
    		'classroom_id' => request('classroom_id'),
    		'start_hour' => request('start_hour'),
    		'end_hour' => request('end_hour'),
    		'day' => request('day'),
  		]);
      $workshop->load('teacher')->load('course')->load('classroom');
  		return ['message' => 'Taller Agregado!', 'object' => $workshop];
    }

    public function destroy(Workshop $workshop)
    {
      $workshop->delete();
      return ['message' => 'Taller Eliminado!', 'object' => $workshop];
    }
}
