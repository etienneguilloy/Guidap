var app = new Vue({
	delimiters: ['${', '}'],
	el: '#app',
	data: {
		nombre_mystere : 0,
		retoursapi: [],
		signature : this.signature.value
	},
	methods: {
		// Soustraire 1 au nombre mystere
		moins: function () {
			var new_nombre = this.nombre_mystere-1;
			new_nombre = (new_nombre < 0 ) ? 0 : new_nombre;
			this.nombre_mystere = new_nombre;
		},
		// Ajouter 1 au nombre mystere
		plus: function (event) {
			var new_nombre = this.nombre_mystere+1;
			new_nombre = (new_nombre > 100 ) ? 100 : new_nombre;
			this.nombre_mystere = new_nombre;
		},
		// Lancement du test de la proposition utilisateur
		tester_nombre : function(event){
			
			var resource = this.$resource('/api/testernombre{/nombre}{/signature}');
			
			resource.get({nombre: this.nombre_mystere, signature : this.signature}).then(response => {
				if(response.body.result)
				{
					alert('Felicitation vous avez trouvé le nombre mystère!');
					this.retoursapi = [];
					this.nombre_mystere = 0;
				}
				else if(response.body.result !== null)
				{
					this.retoursapi.push({proposition:response.body.proposition, complement: response.body.complement })
				}
				

			}, response => {
				
			});
		},
		// Generation d un nouveau nombre mystere
		nouveau_nombre : function()
		{
			var resource = this.$resource('/api/nouveaunombre{/signature}');
			resource.get({signature : this.signature}).then(response => {
				if(response.body.done)
				{
					alert('Nouveau nombre généré');
					this.retoursapi = [];
					this.nombre_mystere = 0;
				}
				else
				{
					alert('Erreur');
				}

			}, response => {
				
			});
		}
	}
});