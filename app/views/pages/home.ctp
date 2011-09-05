<?php

App::import('Vendor', 'phpflickr/phpflickr');

$flickr = new phpFlickr('f0f23b5acee8e3575bb2dba792af82aa');

//$search = $flickr->photos_search(array('text' => 'sime', 'per_page' => 1));
$search = $flickr->favorites_getPublicList('46535275@N00', null, null, null, null, 5);

foreach ($search['photos']['photo'] as $result) {
	$info = $flickr->photos_getInfo($result['id']);
	debug($info['photo']['urls']['url'][0]['_content']);
}
