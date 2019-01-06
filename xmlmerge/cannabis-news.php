<?php
header('Content-Type: application/rss+xml; charset=utf8');

	$rssfeed = "";
	$url[] = "http://weedporndaily.tumblr.com/tagged/news/rss";
	
	
	foreach($url as $feed) {
		$xml = simplexml_load_file($feed);
		$feed_prep = str_replace("http://weedporndaily.tumblr.com/tagged/", "", $feed);
		$feed_prep2 = str_replace("/rss", "", $feed_prep);
		$feed_prep3 = str_replace("-", " ", $feed_prep2);
		$feed_name = ucfirst($feed_prep3);
		

        	
        	$count = 0;

    // check to see if the object was created from the RSS feed
    if (!is_object($xml)) {
        echo "WPD Feed - Error converting xml";
    } else {

    	// email header

    	?>

    	<table style="background-repeat:repeat-both; background-position: top center; background-repeat:repeat-both; background-position: top center; background-color: #D8D8D8; margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; padding: 0; width: 100%;" cellspacing="0" cellpadding="0" border="0" bgcolor="#D8D8D8" width="100%" background="http://weedporndaily.com/matter/uploads/myMail/templates/weedporndaily_v2/img/bg.jpg">
    <tbody><tr><td align="center" valign="top">
            <table class="p100" style="background-color: #FFFFFF; margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; padding: 0; width: 800px;" width="800" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF"><tbody><tr><td style="width: 30px;" width="30" valign="top" align="left">&nbsp;</td>
                <td align="center" valign="top">
                  <table class="p100" style="margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; padding: 0; width: 600px;" width="600" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td align="center" valign="top">
                        <table class="p100" style="margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; padding: 0; width: 600px;" width="600" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td valign="top" align="left">
                              <table class="p100" style="margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; padding: 0; width: 600px;" width="600" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td style="font-size: 1px; height: 30px; line-height: 30px; mso-line-height-rule: exactly;" valign="top" align="left">&nbsp;</td>
                                </tr><tr><td class="hide" style="font-size: 1px; height: 25px; line-height: 25px; mso-line-height-rule: exactly;" valign="top" align="left">&nbsp;</td>
                                </tr><tr><td style="color: #5b5b5b; font-size: 12px; font-weight: 400; letter-spacing: 0.1em; text-align: center; text-transform: uppercase;" valign="top" align="left">
                                    <div><multi label="s12-blog header2"><!--===================================================--><!--|                    SUBTITLE                    |--><!--===================================================--><font face="'Open Sans', sans-serif">WEEK OF <?php echo strtoupper(date("M j", strtotime('last monday', strtotime('next week', time())))); ?></font>
                                    </multi></div></td>
                                </tr><tr><td style="font-size: 1px; height: 10px; line-height: 10px; mso-line-height-rule: exactly;" valign="top" align="left">&nbsp;</td>
                                </tr><tr><td style="color: #333333; font-size: 35px; font-weight: 700; letter-spacing: 0; text-align: center;" valign="top" align="left">
                                    <div><multi label="s12-blog header 1"><!--===================================================--><!--|                      TITLE                      |--><!--===================================================--><font face="'Open Sans', sans-serif">Latest Cannabis News</font>
                                    </multi></div></td>
                                </tr><tr><td style="font-size: 1px; height: 22px; line-height: 22px; mso-line-height-rule: exactly;" valign="top" align="left">&nbsp;</td>
                                </tr><tr><td class="hide" style="font-size: 1px; height: 5px; line-height: 5px; mso-line-height-rule: exactly;" valign="top" align="left">&nbsp;</td>
                                </tr><tr><td style="border-bottom: 1px solid #DFDFDF; font-size: 1px; height: 1px; line-height: 1px; mso-line-height-rule: exactly;" valign="top" align="left">&nbsp;</td>
                                </tr></tbody></table></td>
                          </tr><tr><td style="font-size: 1px; height: 40px; line-height: 40px; mso-line-height-rule: exactly;" valign="top" align="left">&nbsp;</td>
                          </tr>


    	<?php


        foreach ($xml->channel->item as $item) {

        	if(strtotime($item->pubDate) > strtotime('3 month ago')) {
        		// if even or the first, do beginning of table
	        		$xpath = new DOMXPath(@DOMDocument::loadHTML($item->description));
					$src = $xpath->evaluate("string(//img/@src)");
					if($count <= 5) {
        		if($count % 2 == 0 || $count == 0) {

        			?>

        			                <tr><td style="width: 600px;" width="600" align="left" valign="top">
                              <!--[if gte mso 9]>
                              <table align="left" border="0" cellpadding="0" cellspacing="0" width="600">
                              <tr>
                              <td align="left" valign="top" width="285">
                              <![endif]-->
                              <table class="p100" style="margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; padding: 0; width: 285px;" width="285" cellspacing="0" cellpadding="0" border="0" align="left"><tbody><tr><td align="center" valign="top">
                                    <table class="p100" style="margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; padding: 0; width: 285px;" width="285" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td class="p100" style="width: 285px;" width="285" align="left" valign="top">
                                          <!--===================================================-->
                                          <!--|                      IMAGE                      |-->
                                          <!--===================================================-->
                                          <a href="<?php echo $item->link; ?>" class="p100" style="border: none; color: inherit; display: block; font-family: 'Open Sans', sans-serif; font-size: inherit; outline: none; text-decoration: none;">
                                            <img src="<?php echo $src; ?>" alt="img" class="p100" style="-ms-interpolation-mode: bicubic; border: 0; display: block; outline: 0; text-decoration: none; width: 285px;" width="285" border="0" label="s12-blog img 1" editable=""></a>
                                        </td>
                                      </tr><tr><td style="font-size: 1px; height: 25px; line-height: 25px; mso-line-height-rule: exactly;" valign="top" align="left">&nbsp;</td>
                                      </tr><tr><td style="color: #343434; font-size: 19px; font-weight: 700; line-height: 23px; mso-line-height-rule: exactly;" align="left" valign="top">
                                          <div><multi label="s12-blog header3"><!--===================================================--><!--|                      TITLE                      |--><!--===================================================--><font face="'Open Sans', sans-serif"><?php echo $item->title; ?></font>
                                          </multi></div></td>
                                      </tr><tr><td style="font-size: 1px; height: 20px; line-height: 20px; mso-line-height-rule: exactly;" valign="top" align="left">&nbsp;</td>
                                      </tr></tbody></table></td>
                                </tr><tr><td style="font-size: 1px; height: 40px; line-height: 40px; mso-line-height-rule: exactly;" valign="top" align="left">&nbsp;</td>
                                </tr></tbody></table><!--[if gte mso 9]>
                              </td>
                              <td align="left" valign="top" width="30">
                              <![endif]--><table style="margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; padding: 0;" cellspacing="0" cellpadding="0" border="0" align="left"><tbody><tr><td style="font-size: 1px; height: 1px; line-height: 1px; width: 30px; mso-line-height-rule: exactly;" width="30" valign="top" align="left">&nbsp;</td>
                                </tr></tbody></table><!--[if gte mso 9]>
                              </td>
                              <td align="left" valign="top" width="285">
                              <![endif]-->

                              <?php
					$count++;
				} else {
				// if odd do secondary part of table
					?>

					<table class="p100" style="margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; padding: 0; width: 285px;" width="285" cellspacing="0" cellpadding="0" border="0" align="left"><tbody><tr><td align="center" valign="top">
                                    <table class="p100" style="margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; padding: 0; width: 285px;" width="285" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td class="p100" style="width: 285px;" width="285" align="left" valign="top">
                                          <!--===================================================-->
                                          <!--|                      IMAGE                      |-->
                                          <!--===================================================-->
                                          <a href="<?php echo $item->link; ?>" class="p100" style="border: none; color: inherit; display: block; font-family: 'Open Sans', sans-serif; font-size: inherit; outline: none; text-decoration: none;">
                                            <img src="<?php echo $src; ?>" alt="img" class="p100" style="-ms-interpolation-mode: bicubic; border: 0; display: block; outline: 0; text-decoration: none; width: 285px;" width="285" border="0" label="s12-blog img 2" editable=""></a>
                                        </td>
                                      </tr><tr><td style="font-size: 1px; height: 25px; line-height: 25px; mso-line-height-rule: exactly;" valign="top" align="left">&nbsp;</td>
                                      </tr><tr><td style="color: #343434; font-size: 19px; font-weight: 700; line-height: 23px; mso-line-height-rule: exactly;" align="left" valign="top">
                                          <div><multi label="s12-blog header3"><!--===================================================--><!--|                      TITLE                      |--><!--===================================================--><font face="'Open Sans', sans-serif"><?php echo $item->title; ?></font>
                                          </multi></div></td>
                                      </tr><tr><td style="font-size: 1px; height: 20px; line-height: 20px; mso-line-height-rule: exactly;" valign="top" align="left">&nbsp;</td>
                                      </tr>
                                      </tbody></table></td>
                                </tr><tr><td style="font-size: 1px; height: 60px; line-height: 60px; mso-line-height-rule: exactly;" valign="top" align="left">&nbsp;</td>
                                </tr></tbody></table><!--[if gte mso 9]>
                              </td>
                              </tr>
                              </table>
                              <![endif]--></td>
                          </tr>


					<?php
					$count++;
				} // end odd / even check
			} // end check for 6 elements
			}
		}
	}
	}
	
	
?>
 </tbody></table></td>
                    </tr></tbody></table></td>
                <td style="width: 30px;" width="30" valign="top" align="left">&nbsp;</td>
              </tr></tbody></table></td>
        </tr>
  </tbody></table>