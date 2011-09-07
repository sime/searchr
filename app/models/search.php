<?php

class Search extends AppModel {
	var $name = 'Search';

	function lastSearches($limit = 10) {
		return $this->find('all', array (
				'fields' => array (
					'keywords', 'results'
				),
				'order' => array (
					'id DESC'
				),
				'limit' => $limit,
			)
		);
	}
}

