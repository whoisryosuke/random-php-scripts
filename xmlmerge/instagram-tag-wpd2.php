<style>
div { float:left; }
</style>
<?php
$api = "https://api.instagram.com/v1/tags/weedporndaily/media/recent?client_id=e81a256b901c4a3eba405e86acbf7a60";  

function get_curl($url) {  
    if(function_exists('curl_init')) {  
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL,$url);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($ch, CURLOPT_HEADER, 0);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);   
        $output = curl_exec($ch);  
        echo curl_error($ch);  
        curl_close($ch);  
        return $output;  
    } else{  
        return file_get_contents($url);  
    }  
}

while ($api !== NULL) {
    $response = get_curl($api);
    foreach(json_decode($response)->data as $item){   
        $src = $item->images->standard_resolution->url;  
        $thumb = $item->images->thumbnail->url;  
        $user = $item->user->username;
        $url = $item->link;  

        $images[] = array(  
        "src" => htmlspecialchars($src),  
        "thumb" => htmlspecialchars($thumb),  
        "url" => htmlspecialchars($url)  
        );  
    echo "<div><img src='".$src."'  width='150' height='150' border='0'><p><a href='".$url."'>@". $user."</a></p></div>";
    } 
    $api = json_decode($response)->pagination->next_url;
}
?>