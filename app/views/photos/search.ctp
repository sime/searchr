<?php

echo $form->create('Photo', array('type' => 'get'));
echo $form->input('q', array ('label' => 'Flickr search', 'value' => $q));
echo $form->submit();
echo $form->end();

if ($q) {
	$summary = 'Total results for query <strong>' . $q . '</strong>: ' . $total;
	echo $this->Html->tag('p', $summary);

	echo $this->Flickr->photoLinks($links);
}

