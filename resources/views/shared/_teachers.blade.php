<div id="app-teachers">
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

	<table class="table is-bordered is-narrow" v-if="lists.teachers.length > 0">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Correo Electrónico</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody tag="div" name="fade" id="transition-group" v-cloak>
			<tr v-for="teacher in lists.teachers" :key="teacher.id">
				<td>@{{teacher.name}}</td>
				<td>@{{teacher.email}}</td>
				<td>
					<a class="button" @click="onDelete(teacher.id)">
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
	el: '#app-teachers',
	data: {
		lists: lists,
		form: new Form({
			name: '',
			email: ''
		}),
 	},
	mounted() {
		axios.get('/teachers')
			.then(response => this.lists.teachers = response.data)
	},
	methods: {
		onSubmit() {
			this.form.post('/teachers')
				.then(data => {
						this.lists.teachers.push(data.object);
						Event.$emit('notify', {notification: data.message})
				})
				.catch(error => console.log(error));
		},
		onDelete(id) {
			this.form.delete(`/teachers/${id}`)
				.then(data => {
					this.lists.teachers.splice(this.lists.teachers.findIndex(teacher => teacher.id == data.object.id), 1);
					Event.$emit('notify', {notification: data.message});
				});
		}
	}
});
</script>
@endpush