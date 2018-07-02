<?php
require_once('twitteroauth.php');

define('CONSUMER_KEY', 'P13ZkSEY0XjM0HL9B2E4FGH1s');
define('CONSUMER_SECRET', 'ybAnVr94LAxBEymuK4n1iVi3j4LSkRP6gyg8tG8VQUfkcoEAjQ');
define('ACCESS_TOKEN', '491817898-WGuJ437vP9YzUqksczHWbwZcB0DegWPhJurcQFqG');
define('ACCESS_TOKEN_SECRET', 'uZyFfwJbLMGARVQqVwS4IVDHWCO2jSY4DwdaarDI70TKb');

$consumerKey    = 'P13ZkSEY0XjM0HL9B2E4FGH1s';
$consumerSecret = 'ybAnVr94LAxBEymuK4n1iVi3j4LSkRP6gyg8tG8VQUfkcoEAjQ';
$oAuthToken     = '491817898-WGuJ437vP9YzUqksczHWbwZcB0DegWPhJurcQFqG';
$oAuthSecret    = 'uZyFfwJbLMGARVQqVwS4IVDHWCO2jSY4DwdaarDI70TKb';

//$q = (isset($_POST['search1']) ? $_POST['search1'] : null);

$toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
 
$query = array(
  "q" => "#WorldSeries"
);
 
$results = $toa->get('search/tweets', $query);
 

foreach ($results->statuses as $result) {
  echo $result->user->screen_name . ": " . $result->text . "\n";
}
        
        
        
?>