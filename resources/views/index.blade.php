@extends('layouts.app')

@section('content')
@include('shared.message')
<div class="container">
	<div class="columns">
		<div class="column is-4" id="app">
			<h4 class="title is-4">Profesores</h4>
			<form @submit.prevent="onSubmit" @keydown="errors.clear($event.target.name)">
				<p class="control">
				  <input class="input" type="text" name="name" placeholder="Nombre completo" v-model="name">
				  <span class="help is-danger" v-text="errors.get('name')" v-if="errors.has('name')"></span>
				</p>
				<p class="control">
				  <input class="input" type="text" name="email" placeholder="Correo electrónico" v-model="email">
				  <span class="help is-danger" v-text="errors.get('email')" v-if="errors.has('email')"></span>
				</p>
				<p class="control has-addons has-addons-centered">
			    <button class="button is-primary" :disabled="errors.any()">Agregar</button>
			  </p>
			</form>

			<hr>
			
			<transition name="fade">
				<table class="table is-bordered is-narrow" v-if="teachers.length > 0">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Correo Electrónico</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="teacher in teachers">
							<td>@{{teacher.name}}</td>
							<td>@{{teacher.email}}</td>
						</tr>
					</tbody>
				</table>
			<transition>
		</div>
	</div>
</div>
@endsection