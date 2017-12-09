var app = new Vue({
	delimiters: ['${', '}'],
	el: '#app',
	data: {
		nombre_mystere : 0,
		retoursapi: [],
		signature : this.signature.value,
		alert_msg : '',
		type_alert : ''
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
		
		// Generation d un nouveau nombre mystere
		nouveau_nombre : function()
		{
			var resource = this.$resource('/api/nouveaunombre{/signature}');
			resource.get({signature : this.signature}).then(response => {
				if(response.body.done)
				{
					this.retoursapi = [];
					this.nombre_mystere = 0;
					
					this.alert_msg = response.body.msg;
					this.type_alert = response.body.type;
					
					$("#alert").show();
					setTimeout(function(){ $("#alert").hide(); }, 3000);
					
				}
				else
				{
					alert('Erreur');
				}

			}, response => {
				
			});
		},
		
		// Lancement du test de la proposition utilisateur
		tester_nombre : function(event){
			
			var resource = this.$resource('/api/testernombre{/nombre}{/signature}');
			
			resource.get({nombre: this.nombre_mystere, signature : this.signature}).then(response => {
				if(response.body.result)
				{
					this.retoursapi = [];
					this.nombre_mystere = 0;
					
					this.alert_msg = response.body.complement;
					this.type_alert = response.body.type;
					
					$("#alert").show();
					setTimeout(function(){ $("#alert").hide(); app.nouveau_nombre(); }, 2000);
					
				}
				else if(response.body.result !== null)
				{
					this.retoursapi.push({proposition:response.body.proposition, complement: response.body.complement })
				}
				else
				{
					this.alert_msg = response.body.msg;
					this.type_alert = response.body.type;
					
					$("#alert").show();
					setTimeout(function(){ $("#alert").hide(); }, 3000);
				}
				

			}, response => {
				
			});
		}
	}
});