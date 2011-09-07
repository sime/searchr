<?php

class FlickrHelper extends AppHelper {

	var $helpers = array('Html');

	function photoLinks($links) {
		$output = null;
		foreach ($links as $link)  {
			$l = $link['photo']['urls']['url'][0]['_content'];
			$output .=  $this->Html->tag('li', $this->Html->link($l, $l));
		}

		return $this->Html->tag('ol', $output);
	}
}
