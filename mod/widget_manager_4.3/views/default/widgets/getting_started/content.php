<?php ?>
<script>

$(document).ready(function(){
    $('a').click(function () {
        var divname= this.name;
        $("#"+divname).fadeIn(1500).show(0).siblings().hide(0);
        //$(this).css("font-size", "1.2em").siblings().css("font-size", "1em");
    });
});

</script>
<style>
div#buttons {
	
	font-size:12px;
	width:100%;
}
/*
Hack for IE7 and Above and firefox;
*/
html>body #buttons a {
display: inline-block;
	font-weight: bold;
	cursor: pointer;
	padding-left: 15px;
	height: 16px;
	padding-right: 20px;
	background: url(<?php echo elgg_get_site_url(); ?>mod/widget_manager/graphics/elgg_sprites.png) no-repeat scroll left center transparent;

}
html>body #buttons a[name=div1] {
	background-position: 0px -1008px;
}
html>body #buttons a[name=div2] {
	background-position: 0px -720px;
}
html>body #buttons a[name=div3] {
	background-position: 0px -180px;
}
html>body #buttons a[name=div4] {
	background-position: 0px -1134px;
}

/*
Hack for chrome
*/
body:nth-of-type(1) #buttons > a {
	display: inline-block;
	font-weight: bold;
	cursor: pointer;
	padding-left: 18px;
	height: 16px;
	padding-right: 20px;
	background: url(<?php echo elgg_get_site_url(); ?>mod/widget_manager/graphics/elgg_sprites.png) no-repeat scroll left center transparent;
}
div#buttons > a[name=div1] {
	background-position: 0px -1008px;
}
div#buttons > a[name=div2] {
	background-position: 0px -720px;
}
div#buttons > a[name=div3] {
	background-position: 0px -180px;
}
div#buttons > a[name=div4] {
	background-position: 0px -1134px;
}
div#buttons > a[name=div5] {
	background: url(<?php echo elgg_get_site_url(); ?>mod/widget_manager/graphics/question.png) no-repeat scroll left center transparent;
	background-position: 0px;
}
div#buttons > a[name=group] {
	background: url(<?php echo elgg_get_site_url(); ?>mod/easytheme/graphics/group.png) no-repeat scroll left center transparent;
	background-position: 0px;
}

div#nav {
	margin-bottom: 10px;

}
h2.gs {
	width: 100%;
	margin: 15px 0px;
	text-align: center;
	font-family: 'Average Sans', sans-serif;
}
div#composer {
	padding: 0px 18px 0px 3px;

}
div#composer > div > h4 {
	text-align: center;
	border-top: 1px solid grey;
	margin-bottom: 5px;
}

</style>
<div id="nav">
<div id="buttons">
    <a name="div1"><?php echo elgg_echo('widget_manager:widgets:getting_started:discussion');?></a>
    <a name="div2"><?php echo elgg_echo('widget_manager:widgets:getting_started:bookmark');?></a>
    <a name="div3"><?php echo elgg_echo('widget_manager:widgets:getting_started:files');?></a>
    <a name="div4"><?php echo elgg_echo('widget_manager:widgets:getting_started:blog');?></a>
    <a name="div5"><?php echo elgg_echo('widget_manager:widgets:getting_started:question');?></a>
    <!--<a name="group" href="groups/all"><?php echo elgg_echo('widget_manager:widgets:getting_started:browse');?></a>-->
</div>
</div>
<?php
echo '<div id="composer">

<div id="div1" style="">
<h4></h4>';

//echo elgg_view('page/elements/riverwire', array('content' => $content));

$title = "Start a Discussion";
$content .= elgg_view_form('thewire/add', array('name' => 'elgg-wire'));
echo elgg_view_module('thewire', $title, $content);


echo '</div>

<div id="div2" style="display:none">
<h4>';
echo elgg_echo('widget_manager:widgets:getting_started:submitabookmark');
echo '</h4>';

elgg_load_library('elgg:bookmarks');
echo elgg_view_form('bookmarks/save', array(), $vars);

echo '</div>

<div id="div3" style="display:none">
<h4>Upload a File/Video</h4>';

//--------------------------------

elgg_load_library('elgg:file');
$form_vars = array(
	'enctype' => 'multipart/form-data', 
);


echo elgg_view_form('file/upload', $form_vars, $vars);

echo '</div>

<div id="div4" style="display:none">
<h4>Create a Blog</h4>';

elgg_load_library('elgg:blog');
$body_vars = blog_prepare_form_vars();

//hack! Elgg engine should take care of this, or blog/save form should be coded better


echo elgg_view_form('blog/save', array(), array_merge($body_vars, $vars));

echo '</div>

<div id="div5" style="display:none">
<h4>Ask a Question</h4>';
echo elgg_view("answers/forms/question", array());
echo '</div>



</div>';

