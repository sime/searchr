<?php

foreach ($links as $link)  {
	echo $this->Html->link($link, $link) . '<br />' . PHP_EOL;
}
