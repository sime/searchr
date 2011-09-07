<?php

class FlickrHelper extends AppHelper {

	var $helpers = array('Html');

	var $sizes = array ('Square', 'Thumbnail', 'Small', 'Medium 640', 'Large', 'Original');

	function links($photos) {
		$output = null;
		foreach ($photos as $photo)  {
			$l = $photo['photo']['urls']['url'][0]['_content'];
			$output .=  $this->Html->tag('li', $this->Html->link($l, $l));
		}

		return $this->Html->tag('ol', $output);
	}

	function url($photo) {
		return $photo['photo']['urls']['url'][0]['_content'];
	}

	function listThumbs($photos) {

		$thumbs = $this->thumbs($photos);

		$output = array();
		foreach ($thumbs as $thumb) {
			$output[] = $this->Html->tag('li', $thumb);
		}

		return $this->Html->tag('ol', implode($output));

	}

	function thumbs($photos) {

		$thumbs = array();
		foreach ($photos as $photo) {
			$thumb = $this->image($photo, 'Thumbnail');
			$imageUrl = $this->imageUrl($photo, 'Large');

			$thumbs[] = $this->Html->link($thumb, $imageUrl,
				array(
					'escape' => false,
					'rel' => 'external',
				)
			);
		}

		return $thumbs;
	}

	function image($photo, $size = null) {

		$image = $this->__extractImage($photo, $size);

		$width = $image[0]['sizes']['width'];
		$height = $image[0]['sizes']['height'];
		$src = $image[0]['sizes']['source'];
		$alt = $photo['photo']['title'];

		return $this->Html->image($src,
			array(
				'width' => $width,
				'height' => $height,
				'alt' => $alt,
			)
		);

	}

	function imageUrl($photo, $size = null) {

		$image = $this->__extractImage($photo, $size);

		return ($image) ? $image[0]['sizes']['source'] : false;
	}

	function __extractImage($photo, $size = null) {
		if (!in_array($size, $this->sizes)) {
			return false;
		}
		$image = Set::extract('/sizes[label='. $size .']', $photo);

		if (!$image && $size == 'Large') { // Hrm so Large doesn't always exist.
			$image = $this->__extractImage($photo, 'Medium 640');
		}

		return $image;

	}

	// Bottleneck on large result sets.
	function pagination($per_page, $total) {
		$pages = ceil($total / $per_page);

		$q = $this->params['url']['q'];
		$page = (isset($this->params['url']['page'])) ? $this->params['url']['page'] : 1;

		for ($i=1; $i<=$pages; $i++) {
			$link = $this->Html->link($i, array(
					'controller' => 'photos',
					'action' => 'search',
					'?' => array(
						'q' => $q,
						'page' => $i,
					),
				)
			);
			if ($i == $page) {
				$link = '[ ' . $link . ' ]';
			}
			echo $link . ', ';
		}
	}

}
