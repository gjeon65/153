<?php
$usr ='root';
$pw='';

//connect to db and check for any error
try{
$db = new PDO("mysql:host=localhost;dbname=info153",$usr,$pw);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    echo $e->getMessage();
}

$consumerKey    = 'P13ZkSEY0XjM0HL9B2E4FGH1s';
$consumerSecret = 'ybAnVr94LAxBEymuK4n1iVi3j4LSkRP6gyg8tG8VQUfkcoEAjQ';
$oAuthToken     = '491817898-WGuJ437vP9YzUqksczHWbwZcB0DegWPhJurcQFqG';
$oAuthSecret    = 'uZyFfwJbLMGARVQqVwS4IVDHWCO2jSY4DwdaarDI70TKb';


/*
# API OAuth
require_once('twitteroauth.php');

$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);

# your code to retrieve data goes here, you can fetch your data from a rss feed or database

echo $tweet->post('direct_messages/new', array('screen_name' => 'geunjeon', 'text' => 'Hell ha wrrrrrrr......'));
echo "Messages";
 * 
 */
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Assignment 4</title>
    </head>
    <body>
        <form>
        Search:
        <input type="text" name="search1" size="30"/>
        <input type="submit" value="Submit"/>
        </form>
        <?php 
        
       
       
        $q = (isset($_POST['search1']) ? $_POST['search1'] : null);
        require_once('twitteroauth.php');
        $tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
        function search($tweet, $q='news'){
	$users = $tweet->get('search/tweets', array('q' => $q, 'lang' => "pl", 'result_type' => 'popular'));
	$a = json_decode($users, true);
	echo "<pre>";
	print_r($a);
	foreach ($a as $key => $user) {
		echo $user['screen_name']." ".$user['id']." Follow user <br>";
		$ret = $tweet->post('friendships/create', array('user_id' => $user['id']));
        }	
        }
        ?>
        
        
        
        <form>
            Your query:<br>
            <input type="text" name="query1" size="60"/>
            <input type="submit" value="Submit"/>
        </form>
        
        <?php 
            $userInputss = (isset($_POST['query1']) ? $_POST['query1'] : null);
        ?>
        
    </body>
</html>