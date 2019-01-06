<?php
header('Content-Type: application/rss+xml; charset=utf8');

	
	$url[] = "http://blog.weedporndaily.com/tagged/gif/rss";
	$url[] = "http://blog.weedporndaily.com/tagged/weedporndaily/rss";
	$url[] = "http://blog.weedporndaily.com/tagged/wpd/rss";
	$url[] = "http://blog.weedporndaily.com/tagged/wpdtv/rss";
	$url[] = "http://blog.weedporndaily.com/tagged/wpd-news/rss";
	$url[] = "http://blog.weedporndaily.com/tagged/wpd-gif/rss";
	$url[] = "http://blog.weedporndaily.com/tagged/wpd-livestream/rss";
	$url[] = "http://blog.weedporndaily.com/tagged/wpd-instagram/rss";
	$url[] = "http://blog.weedporndaily.com/tagged/lol/rss";
	
	$rssfeed = '<rss xmlns:dc="http://purl.org/dc/elements/1.1/" version="2.0">';
	$rssfeed .= '<channel>';
	$rssfeed .= '<atom:link xmlns:atom="http://www.w3.org/2005/Atom" rel="hub" href="http://tumblr.superfeedr.com/"/>';
	$rssfeed .= '<description>Your daily dose of beautiful bud. Weed porn, Weed pics, Marijuana pictures, medical marijuana, dispensary.</description>';
	$rssfeed .= '<title>WeedPornDaily</title>';
	$rssfeed .= '<generator>Tumblr (3.0; @weedporndaily)</generator>';
	$rssfeed .= '<link>http://blog.weedporndaily.com/</link>';
	
	
	foreach($url as $feed) {
		$xml = simplexml_load_file($feed);
	
    // check to see if the object was created from the RSS feed
    if (!is_object($xml)) {
        echo "WPD Feed - Error converting xml";
    } else {
        foreach ($xml->channel->item as $item) {
			$description = str_replace('<br/><br/>', '', $item->description);
			$description2 = str_replace('<br/> <br/>', '<br/>', $description);
			$rssfeed .= '<item>';
			$rssfeed .= '<title>'. $item->title .'</title>';
			$rssfeed .= '<link>'. $item->link .'</link>';
			$rssfeed .= '<description>'. $description2 .'<p class="reblog"><a href="'. $item->link .'" title="Reblog this post on Tumblr!">Reblog on Tumblr</a></p></description>';
			$rssfeed .= '<pubDate>'. $item->pubDate .'</pubDate>';
			foreach($item->category as $cat) {
				$rssfeed .= '<category>'. $cat .'</category>';
				$rssfeed .= '<tag>'. $cat .'</tag>';
			}
			$rssfeed .= '</item>';
		}
	}
	}

	$rssfeed .= '</channel>';
	$rssfeed .= '</rss>';
	
	echo $rssfeed;
	
?>