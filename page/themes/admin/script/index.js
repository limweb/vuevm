	var vm = new Vue({
	mixins:[],
	data(){
		return {
		}	
	},
	el:'#app',
	methods:{},
	computed:{ },
	watch: {},
	components:{},
	beforeCreate  () { },
	created       () { },
	beforeMount   () { },
	mounted       () { 
	this.$nty = new Notyf();
	},
	beforeUpdate (){},
	updated      (){},
	beforeDestroy(){},
	destroyed    (){},
	})	
	console.log('-----start---------vue js vm',vm)
