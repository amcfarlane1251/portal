<?php

/* ***********************************************************************
 * Custom System Notification Plugin
 *
 * Parameters Settings
 *
 * ***********************************************************************/

// get values from plugin settings
$delay_time = $vars['entity']->delay_time;
$delay_opacity = $vars['entity']->delay_opacity;
$success_background = $vars['entity']->success_background;
$success_text = $vars['entity']->success_text;
$error_background = $vars['entity']->error_background;
$error_text = $vars['entity']->error_text;
$notice_background = $vars['entity']->notice_background;
$notice_text = $vars['entity']->notice_text;

// if delay_time is empty or set to nothing or set to less than zero, then set to default value of 6
if(empty($delay_time) || strcmp("",$delay_time)==0 || floatval($delay_time)<=0){ 
	$delay_time = "6"; 
}

// if delay_opacity is empty or set to nothing, then set to default value of 0.9
if(empty($delay_opacity) || strcmp("",$delay_opacity)==0){
	$delay_opacity = "0.9"; 
}

// if success_background is empty or set to nothing, then set to default value of #E6EFC2
if(empty($success_background) || strcmp("",$success_background)==0){ 
	$success_background = "#E6EFC2"; 
}

// if success_text is empty or set to nothing, then set to default value of #264409
if(empty($success_text) || strcmp("",$success_text)==0){ 
	$success_text = "#264409"; 
}

// if error_background is empty or set to nothing, then set to default value of #FBE3E4
if(empty($error_background) || strcmp("",$error_background)==0){ 
	$error_background = "#FBE3E4"; 
}

// if error_text is empty or set to nothing, then set to default value of #8A1F11
if(empty($error_text) || strcmp("",$error_text)==0){ 
	$error_text = "#8A1F11"; 
}

// if notice_background is empty or set to nothing, then set to default value of #BDE5F8
if(empty($notice_background) || strcmp("",$notice_background)==0){ 
	$notice_background = "#BDE5F8"; 
}

// if notice_text is empty or set to nothing, then set to default value of #000000
if(empty($notice_text) || strcmp("",$notice_text)==0){ 
	$notice_text = "#000000"; 
}

?>

<br/>

<table border="0">

	<!-- DELAY TIME INPUTS -->
	<tr>
	    <td height=30 width=60%> 
			<br><h2><? echo elgg_echo('custom_notification:general_title'); ?></h2><br>    
	     </td>
	</tr>
	<tr>
		<td height=30 width=60%>
		 	<b><?php echo elgg_echo('custom_notification:delaytime'); ?></b>
	 	
		</td>
	    <td height=30 width=20%>
	    	<?php echo elgg_view('input/text', array(
			                      'name' => 'params[delay_time]',
				                  'value' => $delay_time));
	        ?>
	    </td>
	</tr>
	<!-- FADE OPACITY INPUTS -->
	<tr>
		<td height=30 width=60%>
		 	<b><?php echo elgg_echo('custom_notification:delayopacity'); ?></b>
	 	
		</td>
	    <td height=30 width=20%>
	    	<?php echo elgg_view('input/text', array(
			                      'name' => 'params[delay_opacity]',
				                  'value' => $delay_opacity));
	        ?>
	    </td>
	</tr>
	
	
	<!-- SUCCESS NOTIFICATION INPUTS -->
	<tr>
	    <td height=30 width=60%> 
			<br><h2><? echo elgg_echo('custom_notification:success_title'); ?></h2><br>    
	     </td>
	</tr>
	<tr>
		<td height=30 width=60%>
		 	<b><?php echo elgg_echo('custom_notification:success_background'); ?></b>
	 	
		</td>
	    <td height=30 width=20%>
	    	<?php echo elgg_view('input/text', array(
			                      'name' => 'params[success_background]',
				                  'value' => $success_background));
	        ?>
	    </td>
	</tr>
	<tr>
		<td height=30 width=60%>
		 	<b><?php echo elgg_echo('custom_notification:success_text'); ?></b>
	 	
		</td>
	    <td height=30 width=20%>
	    	<?php echo elgg_view('input/text', array(
			                      'name' => 'params[success_text]',
				                  'value' => $success_text));
	        ?>
	    </td>
	</tr>
	
	<!-- ERROR NOTIFICATION INPUTS -->
	<tr>
	    <td height=30 width=60%> 
			<br><h2><? echo elgg_echo('custom_notification:error_title'); ?></h2><br>    
	     </td>
	</tr>
	<tr>
		<td height=30 width=60%>
		 	<b><?php echo elgg_echo('custom_notification:error_background'); ?></b>
	 	
		</td>
	    <td height=30 width=20%>
	    	<?php echo elgg_view('input/text', array(
			                      'name' => 'params[error_background]',
				                  'value' => $error_background));
	        ?>
	    </td>
	</tr>
	<tr>
		<td height=30 width=60%>
		 	<b><?php echo elgg_echo('custom_notification:error_text'); ?></b>
	 	
		</td>
	    <td height=30 width=20%>
	    	<?php echo elgg_view('input/text', array(
			                      'name' => 'params[error_text]',
				                  'value' => $error_text));
	        ?>
	    </td>
	</tr>
	
	
	<!-- NOTICE NOTIFICATION INPUTS -->
	<tr>
	    <td height=30 width=60%> 
			<br><h2><? echo elgg_echo('custom_notification:notice_title'); ?></h2><br>    
	     </td>
	</tr>
	<tr>
		<td height=30 width=60%>
		 	<b><?php echo elgg_echo('custom_notification:notice_background'); ?></b>
	 	
		</td>
	    <td height=30 width=20%>
	    	<?php echo elgg_view('input/text', array(
			                      'name' => 'params[notice_background]',
				                  'value' => $notice_background));
	        ?>
	    </td>
	</tr>
	<tr>
		<td height=30 width=60%>
		 	<b><?php echo elgg_echo('custom_notification:notice_text'); ?></b>
	 	
		</td>
	    <td height=30 width=20%>
	    	<?php echo elgg_view('input/text', array(
			                      'name' => 'params[notice_text]',
				                  'value' => $notice_text));
	        ?>
	    </td>
	</tr>
	
</table>
<br>



