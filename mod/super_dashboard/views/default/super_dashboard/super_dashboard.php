<!doctype html>
<html lang="en">
<head> 
	
	
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo elgg_get_site_url(); ?>mod/super_dashboard/css/metro.css" />

	<script src="<?php echo elgg_get_site_url(); ?>mod/super_dashboard/js/jquery.plugins.min.js"></script>
	<script src="<?php echo elgg_get_site_url(); ?>mod/super_dashboard/js/metro.js"></script>
	<!--[if lt IE 9]>
		<script src="<?php echo elgg_get_site_url(); ?>mod/super_dashboard/js/respond.min.js"></script>
	<![endif]-->
</head> 
<body>
	<div class="metro-layout vertical">
		<div class="header">
		
		</div>
                </br>
		<div class="content clearfix">
			<div class="items">


<?php

//Messages Plugin Metro Dashboard Menu

if(is_plugin_enabled(messages))
{

?>
<a class="box" href="<?php echo elgg_get_site_url(); ?>messages/inbox/<?php echo $_SESSION['user']->username; ?>">

<span>Mail</span>
<img class="icon" src="<?php echo elgg_get_site_url(); ?>mod/super_dashboard/images/mail.png" alt="" />
</a>


<?php

}

//End of Messages Plugin Metro Dashboard Menu
?>



<a class="box" href="<?php echo elgg_get_site_url(); ?>settings/user/<?php echo $_SESSION['user']->username; ?>" style="background: #6b6b6b;">
<span>My Settings</span>
<img class="icon" src="<?php echo elgg_get_site_url(); ?>mod/super_dashboard/images/settings.png" alt="" />
</a>


<a class="box" href="<?php echo elgg_get_site_url(); ?>profile/<?php echo $_SESSION['user']->username; ?>/edit" style="background: #43b51f;">
<span>Edit Profile</span>
<img class="icon" src="<?php echo elgg_get_site_url(); ?>mod/super_dashboard/images/phone.png" alt="" />
</a>

<?php

//Files Plugin Metro Dashboard Menu

if(is_plugin_enabled(file))
{

?>

<a class="box width2 height2" href="<?php echo elgg_get_site_url(); ?>file/owner/<?php echo $_SESSION['user']->username; ?>">

<span>My Files</span>
<img class="cover" src="<?php echo elgg_get_site_url(); ?>mod/super_dashboard/images/gallery.jpg" alt="" />

</a>

<?php

}

//End of Files Plugin Metro Dashboard Menu
?>


<?php

//The Wire Plugin Metro Dashboard Menu

if(is_plugin_enabled(thewire))
{

?>

<a class="box" href="<?php echo elgg_get_site_url(); ?>thewire/all/" style="background: #00aeef;">

<span>The Wire</span>
<img class="icon" src="<?php echo elgg_get_site_url(); ?>mod/super_dashboard/images/music.png" alt="" />
</a>


<?php

}

//End of The Wire Plugin Metro Dashboard Menu
?>



<?php

//Blogs Plugin Metro Dashboard Menu

if(is_plugin_enabled(blog))
{

?>

<a class="box" href="<?php echo elgg_get_site_url(); ?>blog/all" style="background: #f58d00;">

<span>Blogs</span>
<img class="icon" src="<?php echo elgg_get_site_url(); ?>mod/super_dashboard/images/firefox.png" alt="" />
</a>

<?php

}

//End of Blogs Plugin Metro Dashboard Menu
?>

			

<?php

//Groups Plugin Metro Dashboard Menu

if(is_plugin_enabled(groups))
{

?>

<a class="box height2" href="<?php echo elgg_get_site_url(); ?>groups/all" style="background: #d32c2c;">

<span>Groups</span>
<img class="icon big" src="<?php echo elgg_get_site_url(); ?>mod/super_dashboard/images/gmail.png" alt="" />
</a>

<?php

}

//End of Groups Plugin Metro Dashboard Menu
?>


<a class="box" href="<?php echo elgg_get_site_url(); ?>activity" style="background: #ffc808;">

<span>Site Activity</span>
<img class="icon" src="<?php echo elgg_get_site_url(); ?>mod/super_dashboard/images/winamp.png" alt="" />
</a>


<?php

//Bookmarks Plugin Metro Dashboard Menu

if(is_plugin_enabled(bookmarks))
{

?>

<a class="box" href="<?php echo elgg_get_site_url(); ?>bookmarks/all" style="background: #00a9ec;">
<span>Bookmarks</span>
<img class="icon" src="<?php echo elgg_get_site_url(); ?>mod/super_dashboard/images/tasks.png" alt="" />
</a>

<?php

}

//End of Bookmarks Plugin Metro Dashboard Menu
?>


<?php

//Event Calendar Plugin Metro Dashboard Menu

if(is_plugin_enabled(event_calendar))
{

?>
<a class="box height2" href="<?php echo elgg_get_site_url(); ?>event_calendar/list/" style="background: #4c5e51;">

<span>Event Calendar</span>
<img class="icon big" src="<?php echo elgg_get_site_url(); ?>mod/super_dashboard/images/deviantart.png" alt="" />
</a>

<?php

}

//End of Event Calendar Plugin Metro Dashboard Menu
?>


<a class="box" href="<?php echo elgg_get_site_url(); ?>avatar/edit/<?php echo $_SESSION['user']->username; ?>" style="background: #f874a4;">

<span>Edit Avatar</span>
<img class="icon" src="<?php echo elgg_get_site_url(); ?>mod/super_dashboard/images/dribbble.png" alt="" />
</a>


			</div>
		</div>
	</div>
</body>
</html>

