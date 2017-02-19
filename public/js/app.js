new Vue({
	el: '#app',
	data: {
		teachers: [],
		form: new Form({
			name: '',
			email: ''
		}),
 	},
	mounted() {
		axios.get('/teachers')
			.then(response => this.teachers = response.data)
	},
	methods: {
		onSubmit() {
			this.form.post('/teachers')
				.then(data => {
						this.teachers.push(data.object);
						Event.$emit('added', {resource: 'profesor'})})
				.catch(error => console.log(error));
		}
	}
});