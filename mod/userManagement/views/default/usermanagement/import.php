<?php
$__elgg_ts = time();
$__elgg_token = generate_action_token($__elgg_ts);
?>
<form method="post" action="<?php echo $CONFIG->wwwroot.'action/users/import' ?>" enctype="multipart/form-data">
	<input type="file" name="users" />

	<input type="hidden" name="__elgg_ts" value="<?php echo $__elgg_ts ?>">
	<input type="hidden" name="__elgg_token" value="<?php echo $__elgg_token ?>">
	<input type="submit" class="elgg-button elgg-button-submit" value="Submit">
</form>