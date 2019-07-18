
<?php

if (isset($_POST['count'])) {
	
$count = $_POST['count'];

}

/**
 * Sample PHP code for youtube.search.list
 * See instructions for running these code samples locally:
 * https://developers.google.com/explorer-help/guides/code_samples#php
 */
$dev_key= 'Your Code Api youtube V3';

if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
  throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
}
require_once __DIR__ . '/vendor/autoload.php';

$client = new Google_Client();
$client->setDeveloperKey($dev_key);

// Define service object for making API requests.
$yt = new Google_Service_YouTube($client);
if (!$yt) {
echo "error found !!!";

}
$queryParams = [
    'id' => 'Ks-_Mh1QhMc'
];

$response = $yt->videos->listVideos('snippet', array(
    'chart' => 'mostPopular',
    'maxResults' => 20,
    'regionCode' => $count,
   ));

$yt_arr = $response;
?>



<?php

foreach ($yt_arr['items'] as $var) {

                 ?>

          <a href="<?php echo 'https://youtube.com/watch?v='. $var['id']?>" class="list-group-item">
                <div class="media col-md-3">
                    <figure class="pull-left">
                        <img class="media-object img-rounded img-responsive" src="<?php echo $var['snippet']['thumbnails']['standard']['url']?>"  >
                    </figure>
                </div>
                <div class="col-md-6">
                    <h4 class="list-group-item-heading"> <?php echo $var['snippet']['title']?> </h4>
                    <p class="list-group-item-text">
                    <?php  echo substr($var['snippet']['description'],0,45);  ?>                        
                    </p>
                </div>
                <?php 
$queryParams2 = [
    'id' => $var['id']
];

$response2 = $yt->videos->listVideos('snippet,contentDetails,statistics', $queryParams2);

foreach ($response2 as $key ) { ?>
                <div class="col-md-3 text-center">
                    <h2> <?php echo $key['statistics']['viewCount'];?><small> View </small></h2>
                    <button type="button" class="btn btn-primary btn-lg btn-block">  watch Now!</button>
                    <div class="stars">
                       <?php echo  $key['statistics']['commentCount'];  ?> Comments
                    </div>
                    <p>  <?php echo  $key['statistics']['likeCount'];   ?> Likes <small> / </small>  <?php  echo  $key['statistics']['dislikeCount'];    ?> DisLikes  </p>
                   
                </div> <?php  }  ?>
          </a>
      <?php } ?>
