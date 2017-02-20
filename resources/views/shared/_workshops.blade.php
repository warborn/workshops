<div id="app-workshops">
	<h4 class="title is-4">Talleres</h4>
	<form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)">
	  <div class="control is-horizontal">
		  <div class="control is-grouped">
		    <p class="control">
		      <span class="select">
				    <select name="teacher_id" v-model="form.teacher_id">
				      <option  disabled="disabled" value="">Profesor</option>
				      <option v-for="teacher in lists.teachers" v-text="teacher.name" :value="teacher.id"></option>
				    </select>
				  </span>
				  <span class="help is-danger" v-text="form.errors.get('teacher_id')" v-if="form.errors.has('teacher_id')"></span>
		    </p>
		    <p class="control">
		      <span class="select">
				    <select name="course_id" v-model="form.course_id">
				      <option  disabled="disabled" value="">Curso</option>
				      <option v-for="course in lists.courses" v-text="course.name" :value="course.id"></option>
				    </select>
				  </span>
				  <span class="help is-danger" v-text="form.errors.get('course_id')" v-if="form.errors.has('course_id')"></span>
		    </p>
		    <p class="control">
		      <span class="select">
				    <select name="classroom_id" v-model="form.classroom_id">
				      <option  disabled="disabled" value="">Aula</option>
				      <option v-for="classroom in lists.classrooms" v-text="classroom.name" :value="classroom.id"></option>
				    </select>
				  </span>
				  <span class="help is-danger" v-text="form.errors.get('classroom_id')" v-if="form.errors.has('classroom_id')"></span>
		    </p>
		    <p class="control">
		      <span class="select">
				    <select name="day" v-model="form.day">
				      <option  disabled="disabled" value="">Dia</option>
				      <option v-for="day in days" v-text="day" :value="day"></option>
				    </select>
				  </span>
				  <span class="help is-danger" v-text="form.errors.get('day')" v-if="form.errors.has('day')"></span>
		    </p>
		    <p class="control is-expanded">
		      <input class="input" type="time" name="start_hour" v-model="form.start_hour">
				  <span class="help is-danger" v-text="form.errors.get('start_hour')" v-if="form.errors.has('start_hour')"></span>
		    </p>
		    <p class="control is-expanded">
		      <input class="input" type="time" name="end_hour" v-model="form.end_hour">
				  <span class="help is-danger" v-text="form.errors.get('end_hour')" v-if="form.errors.has('end_hour')"></span>
		    </p>
		    <p class="control">
			    <button class="button is-primary" :disabled="form.errors.any()" v-bind:class="{'is-loading': form.isSubmitting}">Agregar</button>
			  </p>
		  </div>
		</div>
	</form>

	<hr>

	<table class="table is-bordered is-narrow" v-if="workshops.length > 0">
		<thead>
			<tr>
				<th>Dia</th>
				<th>Profesor</th>
				<th>Curso</th>
				<th>Aula</th>
				<th>Hora de Inicio</th>
				<th>Hora de Termino</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody tag="div" name="fade" id="transition-group" v-cloak>
			<tr v-for="workshop in workshops" :key="workshop.id">
				<td>@{{workshop.day}}</td>
				<td>@{{workshop.teacher.name}}</td>
				<td>@{{workshop.course.name}}</td>
				<td>@{{workshop.classroom.name}}</td>
				<td>@{{workshop.start_hour.to12()}}</td>
				<td>@{{workshop.end_hour.to12()}}</td>
				<td>
					<a class="button" @click="onDelete(workshop.id)">
				    <span class="icon is-small">
				      <i class="fa fa-times" aria-hidden="true"></i>
				    </span>
				  </a>
				</td>
			</tr>
		</tbody>
	</table>
</div>

@push('vue')
<script>
new Vue({
	el: '#app-workshops',
	data: {
		lists: lists,
		days: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'], 
		workshops: [],
		form: new Form({
			teacher_id: '',
			course_id:   '',
			classroom_id: '',
			start_hour: '',
			end_hour: '',
			day: ''
		}),
 	},
	mounted() {
		axios.get('/workshops')
			.then(response => this.workshops = response.data)
	},
	methods: {
		onSubmit() {
			this.form.post('/workshops')
				.then(data => {
						this.workshops.push(data.object);
						Event.$emit('notify', {notification: data.message})
				})
				.catch(error => console.log(error));
		},
		onDelete(id) {
			this.form.delete(`/workshops/${id}`)
				.then(data => {
					this.workshops.splice(this.workshops.findIndex(workshop => workshop.id == data.object.id), 1);
					Event.$emit('notify', {notification: data.message});
				});
		}
	}
});
</script>
@endpush