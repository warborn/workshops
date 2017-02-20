<div id="app-classrooms">
	<h4 class="title is-4">Aulas</h4>
	<form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
		<p class="control">
		  <input class="input" type="text" name="name" placeholder="Nombre del aula" v-model="form.name">
		  <span class="help is-danger" v-text="form.errors.get('name')" v-if="form.errors.has('name')"></span>
		</p>
		<p class="control">
		  <input class="input" type="text" name="id" placeholder="Clave del aula" v-model="form.id">
		  <span class="help is-danger" v-text="form.errors.get('id')" v-if="form.errors.has('id')"></span>
		</p>
		<p class="control has-addons has-addons-centered">
	    <button class="button is-primary" :disabled="form.errors.any()" v-bind:class="{'is-loading': form.isSubmitting}">Agregar</button>
	  </p>
	</form>

	<hr>

	<table class="table is-bordered is-narrow" v-if="lists.classrooms.length > 0">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Clave</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody tag="div" name="fade" id="transition-group" v-cloak>
			<tr v-for="classroom in lists.classrooms" :key="classroom.id">
				<td>@{{classroom.name}}</td>
				<td>@{{classroom.id}}</td>
				<td>
					<a class="button" @click="onDelete(classroom.id)">
				    <span class="icon is-small">
				      ✖
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
	el: '#app-classrooms',
	data: {
		lists: lists,
		form: new Form({
			name: '',
			id:   ''
		}),
 	},
	mounted() {
		axios.get('/classrooms')
			.then(response => this.lists.classrooms = response.data)
	},
	methods: {
		onSubmit() {
			this.form.post('/classrooms')
				.then(data => {
						this.lists.classrooms.push(data.object);
						Event.$emit('notify', {notification: data.message})
				})
				.catch(error => console.log(error));
		},
		onDelete(id) {
			this.form.delete(`/classrooms/${id}`)
				.then(data => {
					this.lists.classrooms.splice(this.lists.classrooms.findIndex(classroom => classroom.id == data.object.id), 1);
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