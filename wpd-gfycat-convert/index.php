<?php

$myfile = file_get_contents("highprofits.txt") or die("Unable to open file!");

//$pattern = '/data-ng-src=(["\'])(.+)(?=\1)/i';
$pattern = '/src\s*=\s*"(.+?)"/i';

preg_match_all($pattern, $myfile, $results);

//print_r($myfile);
//print_r($results);
/*foreach($results[0] as $image) {
    
    echo "<img $image />";
}*/

$result_count = count($results[0]);

for($i=0;$i < $result_count; $i++) {
    if($i % 2 == 1) {
        echo "<img {$results[0][$i]} />";
    }
}

/*
if( strpos(file_get_contents("./highprofits.txt"),$search) !== false) {
echo 'true';
}
*/

//echo fread($myfile,filesize("highprofits.txt"));
//fclose($myfile);