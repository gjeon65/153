<!DOCTYPE html>
<!--
This is lab2 from INFO 153.
This project should gather information from inpho.cogs.indiana.edu/thinker/
then process raw data to display on my page with php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>INFO:153 Lab 2</title>
        <link rel="stylesheet" type="text/css" href ="main.css" />
    </head>
    <body>
        
        

        <?php
        
        //set function that will grab json format
        function searchinPho_json($type, $id) {
            $base = "https://inpho.cogs.indiana.edu";
            $format = "json";
            $url = $base . '/' . $type . '/' . $id . '.' . $format;
            $data = @file_get_contents($url, o, null, null);
            return $data;
        }
        //intro.
        echo '<h1>Philosphers</h1>';
        echo '<h2>INFO 153: Lab 2 exercise</h2>';
        echo '<br><br>';
        //give options to select thinker
        //I used select tag option just for fun
        echo '<form method="get">';
        echo '<p>Select one of my favorite thinker: </p>
        <select name="getID">
            <option value="1">Plato</option>
            <option value="2">Aristotle</option>
            <option value="3">Immanuel Kant</option>
        </select>';
        echo '<button id="go">Go</button>';
        echo '</form>';
        
        
        
 
        //get selected value
        //code below is to not to show error when var is at undefined
        $sID = (isset($_GET['getID'])?$_GET['getID']: null);

        
        //convert selected value to ID number.
        if($sID==1){
            $getThinker = '3724';
            
        }elseif ($sID==2){
            $getThinker = '2553';
            
        }elseif($sID==3){
            $getThinker = '3345';
            
        }else{
            exit();
        }
        
        
        
        $data = searchinPho_json('thinker', $getThinker); // thinkerID
        $json = json_decode($data);
        $url = $json->url;
        $label = $json->label;
        echo '<p>One of my favorite thinker is '.$label.'. <br>';
        echo 'Click the link below for more information: </p>';
        echo '<h4>You have chose: </h4><a href= http://inpho.cogs.indiana.edu'
        .$url.'><h3>'.$label.'</h3></a><hr>';
        
        
        
        
        //Show what user has picked and link to the inpho.cogs web
        //also display name and birth&death year
        echo '<div id="second">';
        echo '<table border="1">';
        echo '<tr><th>Name</th><th>Value</th></tr>';
        echo '<tr><td>'.'wiki'.'</td><td>'.$json->wiki.'</td></tr>';
        echo '<tr><td>'.'Birth year'.'</td><td>'.$json->birth->year.'</td></tr>';
        echo '<tr><td>'.'Death year'.'</td><td>'.$json->death->year.'</td></tr>';
        echo '</table>';
        echo '<hr>';
        echo '</div>';
        
        echo '<p>Following informations are related to '.$json->wiki
                .'. You may click on "Name" to view more information.</p>';
        
        //Influenced
        //Get raw data and convert it with json
        echo '<div id="third">';
        echo '<center><h3>Influenced</h3></center>';
        $influenced = $json->influenced;
        //if there is no influenced data
        if ($influenced == null){
            echo "<h4>No influenced data</h4>";
        }else{
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Name</th><th>Birth</th><th>Death</th></tr>';
        foreach ($influenced as $pid) {
            $record = searchinPho_json('thinker', $pid);
            echo '<tr><td>'.$pid .'</td><td>' 
                    .'<a href= http://inpho.cogs.indiana.edu/thinker/'.$pid.'><h3>'
                    .json_decode($record)->label.'</h3></a><hr>'
                     .'<th>'.json_decode($record)->birth->year.'</th>'
                    .'<th>'.json_decode($record)->death->year.'</td></tr>';
        }
        echo '</div></table>';
        }
        
        
        //Influenced By
        //section that will get raw data and convert with json
        echo '<div id="fourth">';
        echo '<center><h3>Influenced By</h3></center>';
        
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Name</th><th>Death</th><th>Birth</th></tr>';
        
        $influencedBy = $json->influenced_by;
        if ($influencedBy == null){
            echo "<h4>Influenced by no one or no data</h4>";
        }else{
        foreach ($influencedBy as $ipid) {
            $irecord=  searchinPho_json('thinker', $ipid);
            echo '<tr><td>'.$ipid.'</td><td>' 
                    .'<a href= http://inpho.cogs.indiana.edu/thinker/'
                    .$ipid.'><h3>'
                    .json_decode($irecord)->label.'</h3></a><hr>'
                    .'<th>'.json_decode($irecord)->birth->year.'</th>'
                    .'<th>'.json_decode($irecord)->death->year.'</td></tr>';
            
            
        }
        echo'</div>';
        echo '</table>';
        }
        
        
        

        //Creating object to array function
        //this will convert object and save 
        //into the array
        //given by prof. week3 slide
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


        //given by prof. slide week3
        $array =  objectToArray($json);


        // expand embedded arrays
        // $array is an associative array; $indent is to format the display
        function expand($array, $indent) {
            foreach($array as $name => $value) {
                if (is_array($value)) {
                    echo $name . '<br>';
                    // call the function itself on an embedded array
                    expand($value, $indent . '~~~');
                } else {
                    echo $indent . $name . '==>' . $value . '<br>';
                }
            }
        }



        //related_idea
        //display related idea
        echo '<div id="relatedIdea">';
        echo '<center><h3>Related Idea</h3></center>';
        
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Idea Content(s)</th></tr>';
        
        $RelatedIdea = $json->related_ideas;
        if ($RelatedIdea == null){
            echo "<h4>There is no related idea.</h4>";
        }else{
           
        foreach ($RelatedIdea as $nid) {
            $nrecord=  searchinPho_json('idea', $nid);
            echo '<tr><td>'.$nid.'</td><td>' .'<a href= http://inpho.cogs.indiana.edu/idea/'.$nid.'><h3>'
                    .json_decode($nrecord)->label.'</h3></a><hr>'.'</td></tr>';
            
        }
   
        echo'</div>';
        echo '</table>';
      
        }
       
        //Related thinkers
        //display related thinker
        echo '<div id="relatedThinkers">';
        echo '<center><h3>Related Thinkers</h3></center>';
        

        
        $RelatedThinkers = $json->related_thinkers;
        if ($RelatedThinkers == null){
            echo "<h4>There is no related thinkers.</h4>";
        }else{
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Name</th><th>Birth</th><th>Death</th></tr>';
        foreach ($RelatedThinkers as $tid) {
            $trecord=  searchinPho_json('thinker', $tid);
            echo '<tr><td>'.$tid.'</td><td>' .'<a href= http://inpho.cogs.indiana.edu/thinker/'.$tid.'><h3>'
                    .json_decode($trecord)->label.'</h3></a><hr>'
                    .'<th>'.json_decode($trecord)->birth->year.'</th>'
                    .'<th>'.json_decode($trecord)->death->year.'</td></tr>';
            
        }
        echo'</div>';
        echo '</table>';

        }
        /*
         * Debuggin stuff commented out b/c proj is done!
        echo '<br><br><br>';
        echo '<h3>Raw Data below for debuggin: </h3>';
        expand($array, '');
         * 
         */
        ?>
        

    </body>
</html>
