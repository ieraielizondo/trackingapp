	var map=null;
	var marcadres_bd=[];
	var marcadores_nuevos=[];
	function initMap() {
		var punto=new google.maps.LatLng(43.308615, -1.893189);
		var config={
			zoom:16,
			center:punto,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		map = new google.maps.Map($('#mapa')[0],config);
		
		var marcador=new google.maps.Marker({
			position:punto,
			title:"Mi casa",
			map:map,
			animation:google.maps.Animation.DROP,
			draggable:false
		});
		marcador.setMap(map);
		google.maps.event.addListener(map,"click",function(event){
			var coordenadas=event.latLng.toString();

			coordenadas=coordenadas.replace("(", "");
			coordenadas=coordenadas.replace(")", "");
			var lista=coordenadas.split(",");
			var form=$("#formNuevo");
			form.find("input[name=lat]").val(lista[0]);
			form.find("input[name=long]").val(lista[1]);

			
		});
	}

	function nuevoMarcador(lat,lon,titulo){
		quitarMarcadores(marcadores_nuevos);
		var punto=new google.maps.LatLng(lat,lon);
		var marcardor=new google.maps.Marker({
			position:punto;
			title=titulo,
			

		});

	}
	function quitarMarcadores(marcadores){
		for(i=0,marcadores.length;i++){
			marcadores[i].setMap=null;
		}
		

	}
