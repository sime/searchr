<?php
class FavouritesController extends AppController {

	var $name = 'Favourites';

	var $helpers = array('Html');

	function index() {
		App::import('Vendor', 'phpflickr/phpflickr');
		$flickr = new phpFlickr('f0f23b5acee8e3575bb2dba792af82aa');

		//$search = $flickr->photos_search(array('text' => 'sime', 'per_page' => 1));
		$search = $flickr->favorites_getPublicList('46535275@N00', null, null, null, null, 1);

		$links = array();
		foreach ($search['photos']['photo'] as $result) {
			$info = $flickr->photos_getInfo($result['id']);
			$links[] = $info['photo']['urls']['url'][0]['_content'];
		}

		$this->set('links', $links);
	}

}
