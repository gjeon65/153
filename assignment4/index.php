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
        
       
       
        if($q = isset($_POST['keyword'])){
        
        
        require_once('twitteroauth.php');
        $tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
        function search($tweet, $q){
	$users = $tweet->get('https://api.twitter.com/1.1/search/tweets.json?q=', array('q' => $q, 'lang' => "en", 'result_type' => 'recent','count' => '4'));
        
            
	$a = json_decode($users, true);
	echo "<pre>";
	print_r($a);
	
        }
        search($tweet, $q);
        };
        ?>
        
        
        
    </body>
</html>