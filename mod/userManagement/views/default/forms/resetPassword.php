<?php 
	$guid = get_input('guid');
?>

<h2><?php echo elgg_echo('resetPassword:heading');?></h2>
<p><?php echo elgg_echo('resetPassword:subHeading');?></p>
<div>
	<label for="password"><?php echo elgg_echo('password');?></label>
	<input type="password" name="password" value="" class="text-input"/>
	<span class="form_hint"><?php echo elgg_echo('register:pswdRules'); ?></span>
</div>

<div>
	<label for="password-again"><?php echo elgg_echo('passwordagain');?></label>
	<input type="password" name="password-again" value="" class="text-input"/>
	<span class="form_hint"><?php echo elgg_echo('resetPassword:hint'); ?></span>
</div>
<input type="hidden" name="guid" value="<?php echo $guid;?>" class="hidden"/>
<input type="submit" name="submit" class="elgg-button elgg-button-submit" value="<?php echo elgg_echo('resetPassword:submit')?>"/>