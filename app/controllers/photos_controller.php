<?php
class PhotosController extends AppController {

	var $name = 'Photos';

	var $helpers = array('Html', 'Form', 'Flickr');

	var $components = array ('Flickr');

	var $per_page = 5;

	function search() {

		$q = (isset($this->params['url']['q'])) ? $this->params['url']['q'] : false;


		if ($q) {
			$photos = $this->flickr->photos_search(array('text' => $q, 'per_page' => $this->per_page));

			foreach ($photos['photo'] as $result) {
				$info = $this->flickr->photos_getInfo($result['id']);
				$sizes = $this->flickr->photos_getSizes($result['id']);
				$info['sizes'] = $sizes;
				$this->data[] = $info;
			}

			$this->set('total', $photos['total']);

		}

		$this->set('q', $q);

	}

}
