	var mapa=null;
	var marcadores_bd=[];
	var marcadores_nuevos=[];
	var form=null;

	function nuevoMarcador(lat,lon,titulo){
		quitarMarcadores(marcadores_nuevos);
		var punto=new google.maps.LatLng(lat,lon);
		var marcador=new google.maps.Marker({
			position:punto,
			title:titulo,
			map:mapa,
			animation:google.maps.Animation.DROP,
			draggable:false
		});
		marcador.setMap(mapa);
		marcadores_nuevos.push(marcador);

	}
	//
	function nuevoMarcadorBD(lat,lon,titulo,timeout){
		//quitarMarcadoresBD(marcadores_nuevos);
		window.setTimeout(function() {
			var punto=new google.maps.LatLng(lat,lon);
			var marcador=new google.maps.Marker({
				position:punto,
				title:titulo,
				map:mapa,
				animation:google.maps.Animation.DROP,
				draggable:false
			});
			marcador.setMap(mapa);
			marcadores_bd.push(marcador);
		}, timeout);

	}
	//Borrar marcadores nuevos o bd
	function quitarMarcadores(marcadores){
		for(i in marcadores){
			marcadores[i].setMap(null);
		}
		marcadores=[];
	}
	
	//funcion para insertar posicion en BD
	function addPosicion(){
		var datos=$("#formNuevo").serialize();
		var datosArray=$("#formNuevo").serializeArray();
		var label_estado=$('#lblEstado');
			console.log(datos);			
			if(form.hasClass("busy")){
				return false;
			}
			form.addClass("busy");		
			$.ajax({
				type:"POST",
				url:"http://localhost/workspace/Servidor/PHP/trackingapp/addPos",
				//url:"http://192.168.1.7:8080/trackingapp/addPos",
				dataType:"JSON",
				data:datos,
				success:function(data){
					console.log(data);
					if(data.estado=="ok"){
						//Poner que se ha completado						
						label_estado.removeClass("label-warning")
						.addClass("label-success")
						.text(data.mensaje)
						.delay(2000)						
						.slideUp("slow","swing");
						quitarMarcadores(marcadores_nuevos);
						nuevoMarcadorBD(datosArray[1].value,datosArray[2].value,datosArray[0].value,0)
						
					}else{
						label_estado.removeClass()
						.addClass("label label-error")
						.text(data.mensaje)
						.delay(2000)
						.slideUp("slow","swing");

					}
				},
				beforeSend:function(data){
					//poner el label a Guardando...
					label_estado.removeClass("label-success")
					.addClass("label-warning")
					.text("Guardando...")
					.slideDown("slow","swing")
					.delay(2000);
					
				},
				complete:function(){
					form.removeClass("busy");
				},
				error: function(jqXHR, textStatus, errorThrown){
					//Poner que ha habido error
					
		           /*console.log(jqXHR);
		           console.log(textStatus);
		           console.log(errorThrown);
		           alert('Error al añadir: ' + textStatus+","+errorThrown+","+jqXHR);*/
        		}
			});

	}

	//Funcion para traer los puntos insertados en bd
	function getPosiciones(){
		$.ajax({
			type:"GET",
			url:"http://localhost/workspace/Servidor/PHP/trackingapp/getAllPos",
			//url:"http://192.168.1.7:80/trackingapp/getAllPos",
			dataType:"JSON",
			data:"",
			success:function(data){
				console.log(data);
				if(data.estado=="ok"){
					$.each(data.mensaje,function(i,item){
						nuevoMarcadorBD(item.latitud,item.longitud,item.titulo,i*150);
					})
				}
			},
			beforeSend:function(){

			},
			complete:function(){

			},
			error:function(){

			}
		});
	}	

	function initMap() {
		form=$("#formNuevo");

		var punto=new google.maps.LatLng(43.308615, -1.893189);
		var config={
			zoom:16,
			center:punto,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		mapa = new google.maps.Map($('#mapa')[0],config);
		var infoWindow = new google.maps.InfoWindow({map: mapa});
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
      			};
				infoWindow.setPosition(pos);
				infoWindow.setContent('Location found.');
				map.setCenter(pos);
			}, 
			function() {
      			handleLocationError(true, infoWindow, map.getCenter());
    		});
		} else {
		    // Browser doesn't support Geolocation
		    handleLocationError(false, infoWindow, map.getCenter());
		}
		
		getPosiciones();

		google.maps.event.addListener(mapa,"click",function(event){
			var coordenadas=event.latLng.toString();
			var titulo=prompt("Titulo:")
			coordenadas=coordenadas.replace("(", "");
			coordenadas=coordenadas.replace(")", "");
			var lista=coordenadas.split(",");
			
			form.find("input[name=titulo]").val(titulo);
			form.find("input[name=lat]").val(lista[0]);
			form.find("input[name=long]").val(lista[1]);
			nuevoMarcador(lista[0],lista[1],titulo);
			
		});

		//Al hacer click en el boton Guardar enviar y guardar en BBDD
		$("#btnGuardar").click(function(){
			addPosicion();			
		});
	}

	
