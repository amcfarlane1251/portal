<?php 

?>
<h2><?php echo elgg_echo('activate:heading');?></h2>
<p><?php echo elgg_echo('activate:subHeading');?></p>
<div>
	<label class="normal"><?php echo elgg_echo('activate:email');?></label>
	<input type="text" name="email" value="<?php echo get_input('email');?>" class="text-input"/>
</div>
<input type="hidden" name="guid" value="<?php echo get_input('guid');?>" class="hidden"/>
<input type="submit" name="submit" class="elgg-button elgg-button-submit" value="Activate"/>