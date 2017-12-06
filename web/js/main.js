var app = new Vue({
	delimiters: ['${', '}'],
	el: '#app',
	data: {
		nombre_mystere : 0,
		retoursapi: []
	},
	methods: {
		moins: function () {
			var new_nombre = this.nombre_mystere-1;
			new_nombre = (new_nombre < 0 ) ? 0 : new_nombre;
			this.nombre_mystere = new_nombre;
		},
		plus: function (event) {
			var new_nombre = this.nombre_mystere+1;
			new_nombre = (new_nombre > 100 ) ? 100 : new_nombre;
			this.nombre_mystere = new_nombre;
		},
		
		tester_nombre : function(event){
			var resource = this.$resource('/api/testernombre{/nombre}');
			
			resource.get({nombre: this.nombre_mystere}).then(response => {
				if(response.body.result)
				{
					alert('Felicitation !');
				}
				
				this.retoursapi.push({ text: response.body.message })

			}, response => {
				
			});
		}
	}
});