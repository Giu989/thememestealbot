



<?php
session_start();
echo "loaded   ";
require_once __DIR__ . '/vendor/autoload.php';
echo "<pre>";

//date_default_timezone_set("Europe/London");
echo "The time is " . date("Y-m-d H:i:s").'   '.   time();

$refreshRate = 600;
echo "</pre>";
header( "refresh:$refreshRate;url= index.php" );
$currentTime = time();




//require_once __DIR__ . '/path/to/facebook-php-sdk-v4/src/Facebook/autoload.php';
//define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/facebook-sdk-v5/');
//require_once __DIR__ . '/facebook-sdk-v5/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '311296439234135',
  'app_secret' => '63445252e1851cdfbb96c9098e5feb81',
  'default_graph_version' => 'v2.7',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email', 'user_likes', 'manage_pages', 'publish_pages', 'publish_actions'];

try {
	if (isset($_SESSION['facebook_access_token'])) {
		$accessToken = $_SESSION['facebook_access_token'];
	} else {
  		$accessToken = $helper->getAccessToken();
	}
} catch(Facebook\Exceptions\FacebookResponseException $e) {
 	// When Graph returns an error
 	echo 'Graph returned an error: ' . $e->getMessage();

  	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
 	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
  	exit;
 }



if (isset($accessToken)) {
	if (isset($_SESSION['facebook_access_token'])) {
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	} else {
		// getting short-lived access token
		$_SESSION['facebook_access_token'] = (string) $accessToken;

	  	// OAuth 2.0 client handler
		$oAuth2Client = $fb->getOAuth2Client();

		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);

		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

		// setting default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}

	// redirect the user back to the same page if it has "code" GET variable
	if (isset($_GET['code'])) {
		//header('Location: ./');
	}

	// getting basic info about user
	try {
		$profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
		$profile = $profile_request->getGraphNode()->asArray();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		//session_destroy();
		// redirecting user back to app login page
		//header("Location: ./");
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
//this is for the photo upload
//•••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••
//  runScript("zucceveryday");

  try {
    //function runScript($pageName){

$arrayOfPages = array("normiememes69","ericscreamymeme", "ChildhoodPolio", "spitsauce","mememangIG", "supremezestymemes", "WindowsMemes69", "reptilianmeme"); // "spicymemepls", "unexpectedMemes", "ayydelalmao3", "Shitposting2006", "cuminassbro2", "684233818337530" , "robustgourmetmemes", "NEEMEMES", "zestysupreme", "TrolleyProblemMemes", "edgyteens5", "WATinTheFuWorld", "883146658474341");
foreach ($arrayOfPages as $keyf => $valuef) {


//££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££
    // message must come from the user-end
    // $data = ['source' => $fb->fileToUpload('http://cdn29.elitedaily.com/content/uploads/2016/06/08153958/Brock-Turner-Facebook-meme-1-665x400.jpg'), 'message' => 'meme bot made this photo !!!'];

    $stealPage1 = $fb->get('/'.$valuef);
    //$stealPage1 = $fb->get('/zucceveryday');
    $stealPage1 = $stealPage1->getGraphNode()->asArray();

    $myPage = $fb->get('/thememestealbot');
    $myPage = $myPage->getGraphNode()->asArray();

    $stolePhotos1 = $fb->get('/' . $stealPage1['id'] . '/feed?limit=3&fields=created_time,source,full_picture', $stealPage1['access_token']);

    // $stolePhotos1 = $fb->get('/photos', $stealPage1['access_token']);

    $stolePhotos1 = $stolePhotos1->getGraphEdge()->asArray();

    // this is for my page - detecting the sched posts
/*
    $scheduledPostsOnMyPage = $fb->get('/' . $myPage['id'] . '/promotable_posts?limit=100&fields=//&fields=source,full_picture,scheduled_publish_time', $myPage['access_token']);
    $scheduledPostsOnMyPage = $scheduledPostsOnMyPage->getGraphEdge()->asArray();
    $arrayOfTimes = array();
    $arrayOfMyURLs = array();

    for ($rowm = 0; $rowm < sizeof($scheduledPostsOnMyPage); $rowm++)
    	{
    	for ($colm = 0; $colm < 1; $colm++)
    		{
    		$currentSched = $scheduledPostsOnMyPage[$rowm]['scheduled_publish_time'];
    		array_push($arrayOfTimes, $currentSched);
    		}
    	}

    $latestSchedPost = (max(array_values($arrayOfTimes)));
    /*
    echo "<pre>";
    echo "shed time";
    print $latestSchedPost;
    echo "</pre>";
    */

    // print_r (array_values($scheduledPostsOnMyPage['1']['full_picture']));
    $numberOfPhotosInArray = sizeof($stolePhotos1);
    $arrayOfURLs = array();

    for ($row = 0; $row < $numberOfPhotosInArray; $row++)
    	{


    		// echo $stolePhotos1[$row]['full_picture'];

    		$currentURL = $stolePhotos1[$row]['full_picture'];
    		$datePosted = $stolePhotos1[$row]['created_time'];

    		// $timePosted = array_shift($datePosted);

    		$timePosted = strtotime($datePosted->format('Y-m-d H:i:s'));
    		array_push($arrayOfURLs, array(
    			$currentURL,
    			$timePosted
    		));

    	}

    $arrayOutputURLs = array();
    //array_splice($arrayOutputURLs,0);

    // here the value of the first array (valueu ) is also an array

    //in $arrayOfURLs, each key has another array as a value, and that other array has 2 elemens. [0] is url, [1] is timestamp
    //$arrayOfURLs has all urls with the limit of 20 or whatever i set it as.

    foreach($arrayOfURLs as $keyu => $valueu)
    	{




    	// collect timestamp in order of most recent to oldest (ie greatest timestamp to shortest)

    	$lastValueAKAtimestamp = $arrayOfURLs[$keyu][1];
    	if ($lastValueAKAtimestamp >= $currentTime - $refreshRate)
    		{

    		// echo "match";
    		// echo "$lastValueAKAtimestamp";
        //its getting the time but not the date hmm
        //IMPORTANT - $arrayOutputURLs is also an array of arrays, which have the url AND the timestamp. It is basically a clone of $arrayOfURLs but only the ones posted recently enough are actually stored in the array
    		array_push($arrayOutputURLs, $valueu);
    		}
        //echo ("<pre>");
        //echo $valueu;
      //echo $lastValueAKAtimestamp .'  '. date('Y-m-d H:i:s', $lastValueAKAtimestamp);
        //echo ("</pre>");
    	}

    //$pages = $fb->get('/me/accounts');
    //$pages = $pages->getGraphEdge()->asArray();



    		// This is for sched posts

    		$timeBetweenEachShed = 60;
    		$minSchedNoShedAtm = time() + 601;
    		$minSchedWithShedAlready = $latestSchedPost + $timeBetweenEachShed;
    		$timeToPost = max($minSchedWithShedAlready, $minSchedNoShedAtm);
    		for ($x = 0; $x <= 0; $x++)
    			{

    			// echo "<br />Day scheduled: $x timestamp:$timeToPost  <br />";

    			$timeToPost = $timeToPost + 60;
    			}
          //echo ("<pre>");

          //print_r ($arrayOfURLs);
          //echo ("</pre>");
          $pages = $fb->get('/me/accounts');
          $pages = $pages->getGraphEdge()->asArray();

          foreach ($pages as $key) {
            if ($key['name'] == 'The Meme Steal Bot')
          {
            $pageID = $key["id"];
          }
        }


          echo ("<pre>");

          //print_r($pages);
          echo "the id is". $pageID;

          echo ("</pre>");

    		foreach($arrayOutputURLs as $keyo => $valueo)
    			{
    			$currentURLtoPost = array_shift($valueo);
          $currentURLtimestamp = end($valueo);
    			$toPost = array(
    				'url' => $currentURLtoPost
    				//'published' => 'true'
    			);

    			$post = $fb->post('/' . $pageID . '/photos', $toPost, $key['access_token']);
    			$post = $post->getGraphNode()->asArray();
          echo ("<pre>");
          print_r($valuef . '  ');
          print_r($currentURLtoPost);


          //print_r ();
          echo ("</pre>");




    		// print_r($timeToPost);


    	}
//}
//££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££

}




	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}


	// printing $profile array on the screen which holds the basic info about user
//	print_r($profile);





  	// Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
}



else {
	// replace your website URL same as added in the developers.facebook.com/apps e.g. if you used http instead of https and you used non-www version or www version of your website then you must add the same here
	$loginUrl = $helper->getLoginUrl('https://facebook-bot-memes.herokuapp.com/index.php', $permissions);
	echo '<a id = "login" href="   ' . $loginUrl . '   ">Log in with Facebook!</a>';
}
?>


<head>
<script>

    //document.getElementById("login").innerHTML = "Should Auto Click";

      var elm=document.getElementById('login');
      document.location.href = elm.href;

</script>
