	var mapa=null;
	var marcadres_bd=[];
	var marcadores_nuevos=[];
	var form=null;
	function initMap() {
		form=$("#formNuevo");
		var punto=new google.maps.LatLng(43.308615, -1.893189);
		var config={
			zoom:16,
			center:punto,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		mapa = new google.maps.Map($('#mapa')[0],config);
		
		var marcador=new google.maps.Marker({
			position:punto,
			title:"Mi casa",
			map:mapa,
			animation:google.maps.Animation.DROP,
			draggable:false
		});
		marcador.setMap(mapa);
		google.maps.event.addListener(mapa,"click",function(event){
			var coordenadas=event.latLng.toString();
			var titulo=prompt("Titulo")
			coordenadas=coordenadas.replace("(", "");
			coordenadas=coordenadas.replace(")", "");
			var lista=coordenadas.split(",");
			
			form.find("input[name=lat]").val(lista[0]);
			form.find("input[name=long]").val(lista[1]);
			nuevoMarcador(lista[0],lista[1],titulo);
			
		});
	}

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
	function quitarMarcadores(marcadores){
		for(i=0;marcadores.length-1;i++){
			marcadores[i].setMap(null);
		}
		

	}
