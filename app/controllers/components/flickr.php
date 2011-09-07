<?php
// Stolen from: http://pastebin.com/f5eb7ff2f
class FlickrComponent extends Object {

	var $api_key = 'f0f23b5acee8e3575bb2dba792af82aa';


	function startup (&$controller) {
		App::import('Vendor', 'phpflickr/phpflickr');

		$controller->flickr = new phpFlickr($this->api_key);
		$controller->set('flickr', $controller->flickr);

	}

}
