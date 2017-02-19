@extends('layouts.app')

@section('content')
@include('shared.message')
<div class="container">
	<div class="columns">
		<div class="column is-4" id="app">
			<h4 class="title is-4">Profesores</h4>
			<form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
				<p class="control">
				  <input class="input" type="text" name="name" placeholder="Nombre completo" v-model="form.name">
				  <span class="help is-danger" v-text="form.errors.get('name')" v-if="form.errors.has('name')"></span>
				</p>
				<p class="control">
				  <input class="input" type="text" name="email" placeholder="Correo electrónico" v-model="form.email">
				  <span class="help is-danger" v-text="form.errors.get('email')" v-if="form.errors.has('email')"></span>
				</p>
				<p class="control has-addons has-addons-centered">
			    <button class="button is-primary" :disabled="form.errors.any()" v-bind:class="{'is-loading': form.isSubmitting}">Agregar</button>
			  </p>
			</form>

			<hr>

			<table class="table is-bordered is-narrow" v-if="teachers.length > 0">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Correo Electrónico</th>
					</tr>
				</thead>
				<tbody tag="div" name="fade" id="transition-group" v-cloak>
					<tr v-for="teacher in teachers" :key="teacher.id">
						<td>@{{teacher.name}}</td>
						<td>@{{teacher.email}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection