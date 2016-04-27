<?

$client = "d3e7199bacf44b86b3b0c689d44a3d07";
$query = 'foodshouldbe';
$clnum = mt_rand(1,3);
$count = 2;

$api = "https://api.instagram.com/v1/tags/".$query."/media/recent?client_id=".$client."&count=".$count;


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

$response = get_curl($api);
$images = array();

echo '<ul>';

if($response){
	foreach(json_decode($response)->data as $item){
        $src = $item->images->standard_resolution->url;
        $thumb = $item->images->thumbnail->url;
    		$url = $item->link;
    		$user = $item->caption->from->username;

        ?>


    <li>
      <a href="<? echo htmlspecialchars($url); ?>">
        <img src="<? echo htmlspecialchars($src); ?>" />
        <h3>- @<? echo htmlspecialchars($user); ?></h3>
      </a>

    </li>



<?

    }
}
echo '</ul>';

die();
?>
