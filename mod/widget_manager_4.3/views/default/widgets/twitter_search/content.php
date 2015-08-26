<?php 

	$widget = $vars["entity"];
	
	$query = $widget->query;
	$title = addslashes($widget->tw_title);
	$sub = addslashes($widget->tw_subtitle);
	
	$height = sanitise_int($widget->height, false);
	if(empty($height)){
		$height = 300;
	}
	
	$background = $widget->background;
	if(empty($background)){
		$background = "4690d6";
	}
	
	if(!empty($query)){

		// Load Twitter JS
		if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on"){
			// load normal js
			$twitter_script_src = "http://widgets.twimg.com/j/2/widget.js";
		} else {
			// load secure js
			$twitter_script_src = "https://twitter-widgets.s3.amazonaws.com/j/2/widget.js";
		}
		
		?>
		<div id="twittersearch_<?php echo $widget->getGUID(); ?>"></div>
		<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
    <script>
        new TWTR.Widget({
            version: 2,
             type: 'profile',
			  rpp: 4,
             interval: 10000,
             title: '<?php echo $title; ?>',
              subject: '<?php echo $sub; ?>',
             width: 250,
             height: <?php echo $height; ?>,
              theme: {
               shell: {
               background: '#<?php echo $background; ?>',
				color: '#ffffff'
                },
                tweets: {
                    background: '#333333',
                    color: '#ffffff',
                    links: '#4aed05'
                }
            },
            features: {
                scrollbar: false,
                loop: false,
                live: false, 
		    hashtags: true,
                timestamp: true,
                avatars: true,
                toptweets: true,
                behavior: 'all'
            }
        }).render().setUser('cdnadl').start();
    </script>

<?php 
	} else { 
		echo elgg_echo("widgets:twitter_search:not_configured");
	} 
