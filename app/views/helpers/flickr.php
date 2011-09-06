<?php

class FlickrHelper extends AppHelper {

	var $helpers = array('Html');

	function photoLinks($links) {
		$output = null;
		foreach ($links as $link)  {
			$output .=  $this->Html->tag('li', $this->Html->link($link, $link));
		}

		return $this->Html->tag('ol', $output);
	}
}
