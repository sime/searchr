<?php

$this->Html->script('jquery.min', array ('inline' => false, 'defer' => true)); // Bit hacky, but no layout exists as yet.
$this->Html->script('external', array ('inline' => false, 'defer' => true));

echo $form->create('Photo', array('type' => 'get'));
echo $form->input('q', array ('label' => 'Flickr search', 'value' => $q));
echo $form->submit();
echo $form->end();

if ($q) {
	$summary = 'Total results for query <strong>' . $q . '</strong>: ' . $total;
	echo $this->Html->tag('p', $summary);

	echo $this->Flickr->listThumbs($this->data);

	echo $this->Flickr->pagination($per_page, $total);
}

