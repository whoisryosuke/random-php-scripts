<?php
header('Content-Type: application/rss+xml; charset=utf8');

	$rssfeed = "";
	$url[] = "http://weedporndaily.tumblr.com/tagged/legalize-it/rss";
	
	
	foreach($url as $feed) {
		$xml = simplexml_load_file($feed);
		$feed_prep = str_replace("http://weedporndaily.tumblr.com/tagged/", "", $feed);
		$feed_prep2 = str_replace("/rss", "", $feed_prep);
		$feed_prep3 = str_replace("-", " ", $feed_prep2);
		$feed_name = ucfirst($feed_prep3);
		
		$rssfeed .= "<h2><strong><a href=\"http://weedporndaily.tumblr.com/tagged/".$feed_prep2."\">" . $feed_name . "</a>:</strong></h2>";

    // check to see if the object was created from the RSS feed
    if (!is_object($xml)) {
        echo "WPD Feed - Error converting xml";
    } else {
        foreach ($xml->channel->item as $item) {
        	if(strtotime($item->pubDate) > strtotime('3 month ago')) {
			$rssfeed .= '<li><a href="'. $item->link .'">'. $item->title .'</a></li>';
			}
		}
	}
	}
	
	echo $rssfeed;
	
?>