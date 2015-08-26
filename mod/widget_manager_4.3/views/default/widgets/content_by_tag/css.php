<?php
?>

div.roleTagHeading{
	padding:5px 0px 5px 5px;
}
div.roleTagHeading h3{
	display:inline;
	margin-right:10px;
	color:#FFF;
}
div.roleTagHeading a{
	color:#FFF !important;	
	text-decoration:underline;
	font-size:11px;
	float:right;
	margin-right:15px;
	margin-top:2px;
}

div.instructor{
	background-color:#F88C00 !important;	
}
div.learner{
	background-color:#0072C2 !important;
}
div.developer{
	background-color:#333 !important;
}

div.trainingmgr{
	background-color:#540375 !important;
}

div.norole{
	background-color:#999 !important;
}



<?php
$user=elgg_get_logged_in_user_entity();
if($user){
	if($user->isAdmin()){
		?>
		.elgg-module-widget > .elgg-head{
			display:block;
		}
		<?php
	} else {
		?>
		.elgg-module-widget > .elgg-head{
			display:none;
		}
		<?php
	}
}
?>

