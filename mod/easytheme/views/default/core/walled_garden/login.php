<?php
/**
 * Walled garden login
 */
?>
<?php
$title = elgg_get_site_entity()->name;
$welcome = elgg_echo('walled_garden:welcome');
$welcome .= ': <br/>' . $title;

$menu = elgg_view_menu('walled_garden', array(
	'sort_by' => 'priority',
	'class' => 'elgg-menu-general elgg-menu-hz',
));

$login_box = elgg_view('core/account/login_box', array('module' => 'walledgarden-login'));
$req =  elgg_view('input/submit', array('value' => elgg_echo('Request an ONGARDE Account')));

?>
<div class="elgg-col elgg-col-1of2">
	<div class="elgg-inner">
		<h1 class="elgg-heading-walledgarden">
			<?=$welcome?>
		</h1>
		<?=$menu?>
	</div>
	<div class="request-button">
		<a href="mailto:CDA-ADLLab@forces.gc.ca?Subject=Requesting%20ONGARDE%20Account%20/%20Demander%20un%20compte%20ERDAGD">Request an ONGARDE account / Demander un compte ERDAGD</a>
		<br>
		</div>
</div>

<div class="elgg-col elgg-col-1of2">
	<div class="elgg-inner">
		<?=$login_box?>
	</div>
</div>

