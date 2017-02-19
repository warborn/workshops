@extends('layouts.app')

@section('content')
@include('shared.message')
<div class="container">
	<div class="columns">
		<div class="column is-4">
			@include('shared._teachers')
		</div>
		<div class="column is-4">
			@include('shared._courses')
		</div>
		<div class="column is-4">
			@include('shared._classrooms')
		</div>
	</div>
</div>
@endsection