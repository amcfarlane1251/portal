<?php 

$userGUID = elgg_get_logged_in_user_guid();
$username = get_user($userGUID)->username;
$site = elgg_get_site_url();
//get links for action buttons
$addGroup = $site."groups/add/".$userGUID;
$addBlog = $site."blog/add/".$userGUID;
$addEvent = $site."events/event/new";
$addPage = $site."pages/add/".$userGUID;
$addBookmark = $site."bookmarks/add/".$userGUID;
$addTask = $site."tasks/add/".$userGUID;
$addFile = $site."file/add/".$userGUID;
$addQuestion = $site."answers/ask/".$username;
$addProject = $site."projects/add/".$userGUID;
$addStatus = $site."thewire/all/";
$addVideo = $site."videos/add/".$userGUID;
?>
<script>

$(document).ready(function(){
    $('a').click(function () {
        var divname= this.name;
        $("#"+divname).fadeIn(1500).show(0).siblings().hide(0);
        //$(this).css("font-size", "1.2em").siblings().css("font-size", "1em");
    });
});

</script>
<div id='widget-welcome'>
	<a href='' class='tooltip-icon tooltip bottom tip-active' data-tool='<?php echo elgg_echo('widget_manager:widgets:getting_started:tooltip');?>'><img src="<?php echo elgg_get_site_url().'mod/wettoolkit/graphics/information.png';?>" alt="Tooltip"/></a>
	<h2><?php echo elgg_echo('widget_manager:widgets:getting_started:ineed');?></h2>
	<ul>
		<li class="selected"><a href="find" id="create"><?php echo elgg_echo('widget_manager:widgets:getting_started:find');?></a></li>
		<li><a href="create" id="create"><?php echo elgg_echo('widget_manager:widgets:getting_started:create');?></a></li> 
		<li><a href="share" id="share"><?php echo elgg_echo('widget_manager:widgets:getting_started:share');?></a></li>
	</ul>

	<div class="widget-welcome-content">
		<div class="active" id="find-content">
			<form class="index-search" action="<?php echo elgg_get_site_url(); ?>welcomesearch" method="get">
				<fieldset>
			            <?php
			                echo elgg_view('input/text', array(
			                    'value' => elgg_echo('widget_manager:widgets:getting_started:find'),
			                    'class' => '',
			                    'name' => 'index-query',
			                    ));

			                echo elgg_view('input/submit', array('class' => 'index-search-submit', 'value' => elgg_echo('widget_manager:widgets:getting_started:search')));
			            ?>
			            <div id="search-options">
			            		<div class="col-3">
			            			<label for="searchFiles"><input type="checkbox" name="check[]" value="file" id="searchFiles" checked /><?php echo elgg_echo('file');?></label>
			            		</div>
			            		<div class="col-3">
			            			<label for="searchMembers"><input type="checkbox" name="check[]" value="user" id="searchMembers" checked /><?php echo elgg_echo('widget_manager:widgets:getting_started:members');?></label>
			            		</div>
			            	    <div class="col-3">
			            			<label for="searchGroups"><input type="checkbox" name="check[]" value="group" id="searchGroups" checked /><?php echo elgg_echo('groups');?></label>
			            		</div>
			            		<div class="col-3">
			            			<label for="searchBlogs"><input type="checkbox" name="check[]" value="blog" id="searchBlogs" checked /><?php echo elgg_echo('blog:blogs');?></label>
			            		</div>
			            		<div class="col-3">
			            			<label for="searchForums"><input type="checkbox" name="check[]" value="hjforum" id="searchForums" checked /><?php echo elgg_echo('forums');?></label>
			            		</div>
			            		<div class="col-3">
			            			<label for="searchVideos"><input type="checkbox" name="check[]" value="videos" id="searchVideos" checked /><?php echo elgg_echo('file:type:video');?></label>
			            		</div>
			            </div>
				</fieldset>
			</form>
		</div><!--END find-content DIV -->
		<div id="create-content" class="clearfix">
			<?php echo 
			"<a href='#blog' class='widget-button'>Blog</a>
			<a href='#event' class='widget-button'>".elgg_echo('widget_manager:widgets:getting_started:event')."</a>
			<a href='#group' class='widget-button'>".elgg_echo('widget_manager:widgets:getting_started:group')."</a>
			<a href='#page' class='widget-button'>".elgg_echo('widget_manager:widgets:getting_started:page')."</a>";?>
		</div><!--END create-content DIV -->
		<div id="share-content" class="clearfix">
			<?php echo 
			"<a href='#bookmark' class='widget-button'>".elgg_echo('widget_manager:widgets:getting_started:bookmarkBtn')."</a>
			<a href='#file' class='widget-button'>".elgg_echo('widget_manager:widgets:getting_started:file')."</a>
			<a href='#status' class='widget-button'>".elgg_echo('widget_manager:widgets:getting_started:status')."</a>
			<a href='#video' class='widget-button'>".elgg_echo('widget_manager:widgets:getting_started:video')."</a>
			";?>
		</div><!--END share-content DIV -->

		<div id="ajax-form">
			<form>
			</form>
		</div><!--END ajax-form DIV -->
	</div>
</div>

