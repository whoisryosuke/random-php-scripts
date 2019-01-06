<html>
<body>
<?php
function htmlallentities($str){
  $res = '';
  $strlen = strlen($str);
  for($i=0; $i<$strlen; $i++){
    $byte = ord($str[$i]);
    if($byte < 128) // 1-byte char
      $res .= $str[$i];
    elseif($byte < 192); // invalid utf8
    elseif($byte < 224) // 2-byte char
      $res .= '&#'.((63&$byte)*64 + (63&ord($str[++$i]))).';';
    elseif($byte < 240) // 3-byte char
      $res .= '&#'.((15&$byte)*4096 + (63&ord($str[++$i]))*64 + (63&ord($str[++$i]))).';';
    elseif($byte < 248) // 4-byte char
      $res .= '&#'.((15&$byte)*262144 + (63&ord($str[++$i]))*4096 + (63&ord($str[++$i]))*64 + (63&ord($str[++$i]))).';';
  }
  return $res;
}
	
	$url[] = "http://weedporndaily.tumblr.com/tagged/alabama/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/alaska/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/arizona/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/arkansas/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/california/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/colorado/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/connecticut/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/delaware/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/florida/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/georgia/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/hawaii/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/idaho/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/illinois/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/indiana/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/iowa/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/kansas/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/kentucky/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/louisiana/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/maine/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/maryland/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/massachusetts/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/michigan/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/minnesota/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/mississippi/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/missouri/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/montana/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/nebraska/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/nevada/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/new-hampshire/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/new-york/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/new-jersey/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/new-mexico/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/north-carolina/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/north-dakota/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/ohio/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/oklahoma/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/oregon/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/pennsylvania/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/rhode-island/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/south-carolina/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/south-dakota/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/tennessee/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/texas/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/utah/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/virginia/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/washington/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/washington-dc/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/west-virginia/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/wisconsin/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/wyoming/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/canada/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/uk/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/amsterdam/rss";
	$url[] = "http://weedporndaily.tumblr.com/tagged/mexico/rss";
	
	$rssfeed .= "<p>The <a href='http://weedporndaily.tumblr.com/tagged/news'>latest news</a> this month in the world of weed. Stay up to date with your state or country’s local cannabis news by bookmarking it’s tag on our Tumblr, or subscribe via RSS by adding “/rss” to the end of the tag’s URL.</p>";

	foreach($url as $feed) {
		$xml = simplexml_load_file($feed);
		$feed_prep = str_replace("http://weedporndaily.tumblr.com/tagged/", "", $feed);
		$feed_prep2 = str_replace("/rss", "", $feed_prep);
		$feed_prep3 = str_replace("-", " ", $feed_prep2);
		$feed_name = ucwords($feed_prep3);

		$rssfeed .= "<h2><b><a href=\"http://weedporndaily.tumblr.com/tagged/".$feed_prep2."\">" . $feed_name . "</a>:</b></h2>";

		$rssfeed .= "<ul>";
    	$i = 0;
    // check to see if the object was created from the RSS feed
    if (!is_object($xml)) {
        echo "WPD Feed - Error converting xml";
    } else {
        foreach ($xml->channel->item as $item) {
        	if(strtotime($item->pubDate) > strtotime('3 month ago')) {
        		$title_prep = explode("\n", $item->title);
        		$title = htmlallentities($title_prep[0]);
			$rssfeed .= '<li><a href="'. $item->link .'">'. $title .'</a></li>';
			$i++;
			}
		}

		if($i == 0) { $rssfeed .= "<li>No news this week, <a href=\"http://weedporndaily.tumblr.com/tagged/".$feed_prep2."\">check the tag</a> for older news.</li>";  }
		$rssfeed .= "</ul>";
	} 

	}
	
	echo $rssfeed;
	
?>
</body>
</html>