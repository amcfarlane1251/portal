<div>
	<label><?php echo "Full Name"; ?></label><br />
	<?php echo elgg_view('input/text',array('name' => 'name')); ?>
</div>

<div>
	<label><?php echo "Forces Email"; ?></label><br />
	<?php echo elgg_view('input/email',array('name' => 'email1')); ?>
</div>

<div>
	<label><?php echo "Forces Email Again"; ?></label><br />
	<?php echo elgg_view('input/email', array('name' => 'email2')); ?>
</div>

<div>
	<label><?php echo elgg_echo('password'); ?></label><br />
	<?php echo elgg_view('input/password', array('name' => 'password1')); ?>
</div>

<div>
	<label><?php echo elgg_echo('passwordagain'); ?></label><br />
	<?php echo elgg_view('input/password', array('name' => 'password_verif')); ?>
</div>

<div>
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('submit'))); ?>
</div>