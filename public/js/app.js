window.Event = new Vue();

class Errors {
	constructor() {
		this.list = {};
	}

	any() {
		return Object.keys(this.list).length > 0;
	}

	has(field) {
		return this.list.hasOwnProperty(field);
	}

	get(field) {
		if(this.list[field]) {
			return this.list[field][0];
		}
	}

	record(errors) {
		this.list = errors;
	}

	clear(field) {
		delete this.list[field];
	}
}

new Vue({
	el: '#app',
	data: {
		teachers: [],
		name: '',
		email: '',
		errors: new Errors()
 	},
	mounted() {
		axios.get('/teachers')
			.then(response => {
				console.log(response.data);
				this.teachers = response.data;
			})
	},
	methods: {
		onSubmit() {
			axios.post('/teachers', this.$data)
				.then(response => {
					this.teachers.push(response.data.object);
					Event.$emit('added', {resource: 'profesor'});
				})
				.catch(error => this.errors.record(error.response.data))
		}
	}
});