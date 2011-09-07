<h1>Search history</h1>
<?php foreach ($this->data as $result): ?>
	<p><em><?php echo $result['Search']['keywords']; ?></em> had <?php echo $result['Search']['results']; ?> results</p>
<?php endforeach; ?>
