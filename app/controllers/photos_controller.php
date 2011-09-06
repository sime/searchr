<?php
class PhotosController extends AppController {

	var $name = 'Photos';

	var $helpers = array('Html', 'Form', 'Flickr');

	function search() {

		$q = (isset($this->params['url']['q'])) ? $this->params['url']['q'] : false;

		if ($q) {
			App::import('Vendor', 'phpflickr/phpflickr');
			$flickr = new phpFlickr('f0f23b5acee8e3575bb2dba792af82aa');

			$search = $flickr->photos_search(array('text' => $q, 'per_page' => 5));

			foreach ($search['photo'] as $result) {
				$info = $flickr->photos_getInfo($result['id']);
				$links[] = $info['photo']['urls']['url'][0]['_content'];
			}

			$this->set('total', $search['total']);
			$this->set('links', $links);

		}

		$this->set('q', $q);

	}

}
