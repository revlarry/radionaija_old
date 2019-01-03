//You can see related documentation and compose own request here: https://developers.google.com/youtube/v3/docs/search/list
//You must enable Youtube Data API v3 and get API key on Google Developer Console(https://console.developers.google.com)

$channelId = 'UCVHFbqXqoYvEWM1Ddxl0QDg';
$maxResults = 8;
$API_key = '{YOUR_API_KEY}';


$video_list = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelId.'&maxResults='.$maxResults.'&key='.$API_key.''));