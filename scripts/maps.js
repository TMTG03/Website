(function() {

	var $map = $('#map');
	

	if( $map.length ) {

		$map.gMap({
			address: 'Heer Bokelweg 255, 3032 AD Rotterdam',
			zoom: 16,
			markers: [
				{ 'address' : 'Heer Bokelweg 255, 3032 AD Rotterdam'}
			]
		});

	}

})();