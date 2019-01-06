<?php
/**
* Swaps filename from article to event inside of multiple sub-directories.
* Used for Kirby CMS during Wordpress importation.
*
* @param string $dir
*/


// Turn off all error reporting
//error_reporting(0);

// Sort through folder > find JSON files > add to mySQL DB

$dir = "./weedporndaily-static/content/5-calendar/";
$i = 0;

$dirs = array_filter(glob($dir . '*'), 'is_dir');
print_r( $dirs);

foreach($dirs as $folder) {

  // Open a directory, and read its contents
  if (is_dir($folder)){
    if ($dh = opendir($folder)){

      while (($file = readdir($dh)) !== false){
        $full = $folder . $file;
        //echo 'File found <br />';
        if(strlen($file) > 3) {
          if($file != '.DS_Store' && $file != 'calendar.txt') {
            //print($file . '<br />');
            if (is_dir($folder . '/'. $file)){
              if ($bh = opendir($folder . '/'. $file)){

                while (($filename = readdir($bh)) !== false){
                  if(strlen($filename) > 3) {
                    if($filename != '.DS_Store' && $filename == 'article.txt') {
                      $strippedfolder = str_replace('./', '', $folder);
                      $oldfile = $_SERVER['DOCUMENT_ROOT'] . '/' . $strippedfolder . '/'. $file . '/'. $filename;
                      $eventfile = str_replace('article', 'event', $filename);
                      $newfile = $_SERVER['DOCUMENT_ROOT'] . '/' . $strippedfolder . '/'. $file . '/'. $eventfile;
                        rename($oldfile, $newfile);
                        //print($newfile . '<br />');
                    }
                  }
                }
                closedir($bh);
              }
            }
          }
        }


      }
      closedir($dh);
    }
  }

}
