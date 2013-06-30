<?php

//////////////////////////////////////////////////////////////////////
///////////////////////////////// ASSETS /////////////////////////////
//////////////////////////////////////////////////////////////////////

Basset::collection('application', function($collection) {

	$collection->stylesheet('components/normalize-css/normalize.css');
	$collection->stylesheet('components/icomoon/style.css');
	$collection->stylesheet('app/css/styles.css');

})
->rawOnEnvironment('local')
->apply('CssMin')->apply('UriRewriteFilter');

//////////////////////////////////////////////////////////////////////
///////////////////////// PAGE-SPECIFIC ASSETS ///////////////////////
//////////////////////////////////////////////////////////////////////

Basset::collection('home', function($collection) {

	// $collection->javascript('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js');
	// $collection->javascript('components/jquery.tablesorter/js/jquery.tablesorter.min.js');
	$collection->javascript('app/js/scripts.js');

})
->rawOnEnvironment('local')
->apply('JsMin');
