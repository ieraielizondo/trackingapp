
	function initMap() {
		var punto=new google.maps.LatLng(43.308615, -1.893189);
		var config={
			zoom:16,
			center:punto,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		var map = new google.maps.Map($('#mapa')[0],config);

		
	}
