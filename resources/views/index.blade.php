@extends('layouts.app')

@section('content')
@include('shared.message')
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
<div class="columns">
	<div class="column is-12">
		@include('shared._workshops')
	</div>
</div>
@endsection