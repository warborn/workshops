<div id="message">
	<transition name="fade">
		<message v-if="showMessage" v-cloak>Se ha agregado el @{{resource}} correctamente.</message>
	</transition>
</div>

@push('vue')
<script>
Vue.component('message', {
	template: `
		<article class="message is-primary">
		  <div class="message-body">
		  	<slot></slot>
		  </div>
		</article>
	`,
});

new Vue({
	el: '#message',
	data: {
		showMessage: false,
		resource: ''
	},
	created() {
		Event.$on('added', (data) => {
			this.showMessage = true;
			setTimeout(() => this.showMessage = false, 2500);
			this.resource = data.resource;
		});
	}
})
</script>
@endpush