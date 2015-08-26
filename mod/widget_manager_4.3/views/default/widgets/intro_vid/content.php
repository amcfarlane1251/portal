<style>

	.gstr {

	text-align: center;
	padding-top: 1px;
	margin-bottom: 4px;
	
}
	.gstr {

}

ul.introvid, ul.titles {

	padding-left: 1px;
	width: 470px;
	margin: 0 auto;
	list-style-type: none;
}

ul.introvid > li {
	display: inline-block;
	*display: inline;
	margin: 0 5px;
	width: 100px;
	height: 75px;

}
ul.titles > li {
	display: inline-block;
	*display: inline;
	padding-left: 5px;

}
ul.titles > li.in {
	margin-right: 35px;
	margin-left: 10px;

}
ul.titles > li.na {
	margin-right: 43px;

}
ul.titles > li.co {

	margin-right: 58px;

}
li.intro a {
	width: 100px;
	padding-right: 95px;
	padding-bottom: 75px;
}
li.nav a {
	width: 100px;
	padding-right: 95px;
	padding-bottom: 75px;
}
li.cont a {
	width: 100px;
	padding-right: 95px;
	padding-bottom: 75px;
}
li.soc a {
	width: 100px;
	padding-right: 95px;
	padding-bottom: 75px;
}
li.intro {

	background-image:url(<?php echo elgg_get_site_url(); ?>mod/widget_manager/graphics/intro.png);

}
li.nav {

	background-image:url(<?php echo elgg_get_site_url(); ?>mod/widget_manager/graphics/nav.png);

}
li.cont {

	background-image:url(<?php echo elgg_get_site_url(); ?>mod/widget_manager/graphics/cont.png);

}
li.soc {

	background-image:url(<?php echo elgg_get_site_url(); ?>mod/widget_manager/graphics/social.png);

}
/*-----------------------------Hover states-----------------------*/
li.intro:hover {

	background-image:url(<?php echo elgg_get_site_url(); ?>mod/widget_manager/graphics/intro_hov.png);

}
li.nav:hover {

	background-image:url(<?php echo elgg_get_site_url(); ?>mod/widget_manager/graphics/nav_hov.png);

}
li.cont:hover {

	background-image:url(<?php echo elgg_get_site_url(); ?>mod/widget_manager/graphics/cont_hov.png);

}
li.soc:hover {

	background-image:url(<?php echo elgg_get_site_url(); ?>mod/widget_manager/graphics/social_hov.png);

}
</style>



<?php ?>


<!--<h2 class="gstr"> Getting Started Videos </h2>-->
<ul class="introvid">
<li class="intro"><a href="<?php echo elgg_get_site_url(); ?>file/view/3132/ongarde"></a></li>
<li class="nav"><a href="<?php echo elgg_get_site_url(); ?>file/view/1734/ongarde-ii-of-iv-navigation"></a></li>
<li class="cont"><a href="<?php echo elgg_get_site_url(); ?>file/view/1740/ongarde-iii-of-iv-content-sharing"></a></li>
<li class="soc"><a href="<?php echo elgg_get_site_url(); ?>file/view/1745/ongarde-iv-of-iv-social"></a></li>
</ul>
<ul class="titles">
	<li class="in"><h4> Introduction </h4></li>
	<li class="na"><h4> Navigation </h4></li>
	<li class="co"><h4> Content </h4></li>
	<li class="so"><h4> Social </h4></li>

</ul>




















