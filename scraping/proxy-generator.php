<?php


$string = '35.189.67.31	80	US	United States	elite proxy	no	yes	17 seconds ago
35.185.162.74	80	US	United States	elite proxy	no	yes	17 seconds ago
35.185.169.149	80	US	United States	elite proxy	no	yes	17 seconds ago
35.189.217.209	80	US	United States	elite proxy	no	yes	17 seconds ago
35.185.190.126	80	US	United States	elite proxy	no	yes	29 seconds ago
35.189.85.132	80	US	United States	elite proxy	no	yes	10 minutes ago
54.158.134.115	80	US	United States	elite proxy	no	no	10 minutes ago
104.224.137.44	80	US	United States	anonymous	no	yes	20 minutes ago
35.189.111.171	80	US	United States	elite proxy	no	yes	20 minutes ago
35.189.76.247	80	US	United States	elite proxy	no	yes	20 minutes ago
35.189.150.182	80	US	United States	anonymous	no	no	21 minutes ago
35.185.174.120	80	US	United States	anonymous	no	yes	40 minutes ago
35.189.193.132	80	US	United States	elite proxy	no	yes	41 minutes ago
67.205.158.219	80	US	United States	transparent	no	no	50 minutes ago
35.189.211.171	80	US	United States	elite proxy	no	no	50 minutes ago
35.189.93.32	80	US	United States	elite proxy	no	no	50 minutes ago
35.187.227.66	80	US	United States	elite proxy	no	no	50 minutes ago
35.189.202.72	80	US	United States	transparent	no	no	53 minutes ago
35.189.192.112	80	US	United States	transparent	no	no	53 minutes ago
35.189.208.215	80	US	United States	transparent	no	no	53 minutes ago
35.189.75.130	80	US	United States	transparent	no	no	56 minutes ago
35.189.149.9	80	US	United States	transparent	no	no	56 minutes ago
168.128.29.75	80	US	United States	anonymous	no	yes	1 hour ago
23.21.40.115	80	US	United States	anonymous	no	yes	1 hour 20 minutes ago
104.155.216.232	80	US	United States	elite proxy	no	yes	1 hour 21 minutes ago
209.159.156.199	80	US	United States	elite proxy	no	no	1 hour 31 minutes ago
209.141.47.120	80	US	United States	transparent	no	no	1 hour 45 minutes ago
35.185.157.0	80	US	United States	transparent	no	no	2 hours 31 minutes ago
35.189.108.190	80	US	United States	transparent	no	no	2 hours 31 minutes ago
34.226.208.165	80	US	United States	transparent	no	no	3 hours 43 minutes ago
74.118.245.70	80	US	United States	elite proxy	no	no	3 hours 52 minutes ago
50.203.117.22	80	US	United States	anonymous	no	yes	5 hours 40 minutes ago
108.179.199.2	80	US	United States	elite proxy	no	no	5 hours 50 minutes ago
52.21.49.216	80	US	United States	transparent	no	no	6 hours 42 minutes ago';

$array = explode(' ago', $string); // for hideproxy
// $array = explode(' seconds', $string);
//$array = explode(' minutes', $string);
foreach($array as $proxy) {
  $stripped = explode('	', $proxy);
  // print_r($stripped);
  $count = 0;
  foreach($stripped as $ip) {
    if($count < 1) {
      echo '"'.ltrim($ip);
      $count++;
    }
  }
  echo '",<br />';
}
?>
