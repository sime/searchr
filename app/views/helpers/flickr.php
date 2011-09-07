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

		return $image[0]['sizes']['source'];

	}

	function __extractImage($photo, $size = null) {
		if (!in_array($size, $this->sizes)) {
			return false;
		}
		return Set::extract('/sizes[label='. $size .']', $photo);

	}

}
