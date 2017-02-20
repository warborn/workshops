<div id="app-courses">
	<h4 class="title is-4">Cursos</h4>
	<form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
		<p class="control">
		  <input class="input" type="text" name="name" placeholder="Nombre del curso" v-model="form.name">
		  <span class="help is-danger" v-text="form.errors.get('name')" v-if="form.errors.has('name')"></span>
		</p>
		<p class="control">
		  <input class="input" type="text" name="id" placeholder="Clave del curso" v-model="form.id">
		  <span class="help is-danger" v-text="form.errors.get('id')" v-if="form.errors.has('id')"></span>
		</p>
		<p class="control has-addons has-addons-centered">
	    <button class="button is-primary" :disabled="form.errors.any()" v-bind:class="{'is-loading': form.isSubmitting}">Agregar</button>
	  </p>
	</form>

	<hr>

	<table class="table is-bordered is-narrow" v-if="lists.courses.length > 0">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Clave</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody tag="div" name="fade" id="transition-group" v-cloak>
			<tr v-for="course in lists.courses" :key="course.id">
				<td>@{{course.name}}</td>
				<td>@{{course.id}}</td>
				<td>
					<a class="button" @click="onDelete(course.id)">
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
	el: '#app-courses',
	data: {
		lists: lists,
		form: new Form({
			name: '',
			id:   ''
		}),
 	},
	mounted() {
		axios.get('/courses')
			.then(response => this.lists.courses = response.data)
	},
	methods: {
		onSubmit() {
			this.form.post('/courses')
				.then(data => {
						this.lists.courses.push(data.object);
						Event.$emit('notify', {notification: data.message})
				})
				.catch(error => console.log(error));
		},
		onDelete(id) {
			this.form.delete(`/courses/${id}`)
				.then(data => {
					this.lists.courses.splice(this.lists.courses.findIndex(course => course.id == data.object.id), 1);
					Event.$emit('notify', {notification: data.message});
				})
				.catch(error => {
					console.log(error);
					Event.$emit('notify', {notification: error.message});
				});
		}
	}
});
</script>
@endpush