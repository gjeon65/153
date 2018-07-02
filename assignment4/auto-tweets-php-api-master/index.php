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
        <form action="" method="post">
            <label> Search: <input type="text" name ="keyword"/></label>
        </form>
        <?php 
        
        function objectToArray($d){
            //when its an object
            if(is_object($d)){
                $d=  get_object_vars($d);
            }
            //when its an array
            if(is_array($d)){
                return array_map('objectToArray', $d);
            }
            else{
                return $d;
            }
        }
        
        
        
        
       
       
        if($q = isset($_POST['keyword'])){
        
        
        require_once('twitteroauth.php');
        $tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
        function search($tweet, $q){
            $users = $tweet->get('https://api.twitter.com/1.1/search/tweets.json?q=', array('q' => $q, 'lang' => "en", 'result_type' => 'popular'));
            
            $a=objectToArray($users);
            echo gettype($a);
            
            $a = json_decode($users, true);
            echo "<pre>";
            print_r($a);
            
            
            
            
            
        
	
        }
        search($tweet, $q);
        };
        ?>
        
        
        
    </body>
</html>