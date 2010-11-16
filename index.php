<?php
	include('../../picturepc.inc');
	require_once('simplepie.inc');
	
	// CHANGE THE FEED ADDRESS BELOW - THAT'S IT!
	$feed = new SimplePie('http://henrik.nyh.se/scrapers/cyanide_and_happiness.rss');
	
	$feed->strip_attributes(false);
	
	$feed->set_item_limit(1);
	
	$feed->init();
	
	$feed->handle_content_type();
	$items_per_feed = 1;
 
	// As long as we're not trying to grab more items than the feed has, go through them one by one and add them to the array.
	for ($x = 0; $x < $feed->get_item_quantity($items_per_feed); $x++)
	{
		$first_items[] = $feed->get_item($x);
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Comics</title>
	
	<link rel="stylesheet" type="text/css" href="style.css" />
	<?php load_jquery(); ?>
	
	<script type="text/javascript">
		var sURL = unescape(window.location.pathname);
		function reloadPlayer( sound )
			{
				window.location.href = sURL;
			}
	
			function reloadTimer()
			{
				setInterval( "reloadPlayer()", 1800000 );
			}
	</script>

</head>

<body onLoad="reloadTimer()">
        <?php if ($feed->error): ?>
		  <p><?php echo $feed->error; ?></p>
		<?php endif; ?>
		<?php foreach ($first_items as $item): ?>		
    			<table class="wrap" width="1024" height="768" align="center" valign="middle">
    				<tr>
    					<td class="canvas">
    						<div class="title"><?php echo $item->get_title(); ?></div>
    						<div class="img"><?php echo $item->get_description(); ?></div>
    					</td>
    				</tr>
    			</table>
		<?php flush(); endforeach; ?>
</body>

</html>
	
