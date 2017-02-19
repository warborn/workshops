<div id="message">
	<transition name="fade">
		<message v-if="showMessage" v-cloak>@{{notification}}</message>
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
		notification: ''
	},
	created() {
		Event.$on('notify', (data) => {
			this.showMessage = true;
			setTimeout(() => this.showMessage = false, 2000);
			this.notification = data.notification;
		});
	}
})
</script>
@endpush