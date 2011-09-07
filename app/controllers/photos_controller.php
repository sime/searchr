<?php
class PhotosController extends AppController {

	var $name = 'Photos';

	var $helpers = array('Html', 'Form', 'Flickr');

	var $components = array ('Flickr');

	function search() {

		$q = (isset($this->params['url']['q'])) ? $this->params['url']['q'] : false;


		if ($q) {
			$photos = $this->flickr->photos_search(array('text' => $q, 'per_page' => 1));

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
