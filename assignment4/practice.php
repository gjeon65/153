<?php
include "twitteroauth.php";?>
<?php
$consumer = "P13ZkSEY0XjM0HL9B2E4FGH1s";
$consumersecret = "ybAnVr94LAxBEymuK4n1iVi3j4LSkRP6gyg8tG8VQUfkcoEAjQ";
$accesstoken = "491817898-WGuJ437vP9YzUqksczHWbwZcB0DegWPhJurcQFqG";
$accesstokensecret = "uZyFfwJbLMGARVQqVwS4IVDHWCO2jSY4DwdaarDI70TKb";

$twitter = new TwitterOAuth($consumer, $consumersecret, $accesstoken, $accesstokensecret);



?>
<html> 

<head>
<meta charset="UTF-8" />
<title>twitter search</title>
</head> 

<body>
<form action="" method="post">
    <label> Search: <input type="text" name ="keyword"/></label>
</form>

<?php 
  if (isset($_POST['keyword'])){
      $tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q='.$_POST['keyword'].'&src=typd');
      $manage = (array)  json_decode($tweets);
      echo '<pre>';
      print_r($manage);
      
      
  }


?>
</body>

</html>