<?php

class Photo extends AppModel {
	var $name = 'Photo';
	var $useTable = false;

	var $hasMany = array('Search');
}
