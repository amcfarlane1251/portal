<?php 

$summary = elgg_extract('summary', $vars);
$body = elgg_extract('body', $vars);

echo <<<HTML
<div>
$header
$body
</div>
HTML;