<!DOCTYPE html>
<!--
INFO 153
Assignment 3
Geun Jeon
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Assignment 3</title>
        <link rel="stylesheet" type="text/css" href ="main.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body bgcolor=#33ccff>
        <h1>INFO-153</h1>
        <h1>Assignment 3</h1>
        
        <hr>
        <?php
            
            $usr ='root';
            $pw='';
            
            //connect to db and check for any error
            try{
            $db = new PDO("mysql:host=localhost;dbname=info153",$usr,$pw);
            echo "<h4>Connection Status: ";
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "You are connected to National University database from data.gov</h4>";
            }catch(PDOException $e){
                echo "connection failed: </h4>".$e->getMessage();
            }
  
            
        ?>
        <hr>
        <h4> IMPORTANT </h4>
        <p>In this assignment, I have chose univeristy scoring data from
            data.gov under education. I used 2015 merged data for this assignment.
        The size of the data was too large. Therefore, for 
        this assignment purposes, I manipulated data where it's big enough do the
        assignment</p>
        <hr>
        <p>
            For extra point, I used data that is other than given for this assignment.
            The data can be downloaded at following link:</p>
        <a href = 'https://catalog.data.gov/dataset/college-scorecard'>Click Here</a>
            
        </p>
        <hr>
        <center><h3>Univeristies that has more than 30% Asisan, White students </h3></center>
        <br>
        <?php
        //show asisan student compsition that is over 30%
        $sql_azn = $db->query("select INSTNM, UGDS_ASIAN,UGDS_WHITE from national_university_data "
                . "where UGDS_ASIAN > 0.30 "
                . "and UGDS_WHITE > 0.30");
        echo"<table border='2'>";
        echo"<tr>";
        echo"<th>Institution Name</th>";
        echo"<th>Percentage of Asian students</th>";
        echo"<th>Percentage of White students</th>";
        while ($row=$sql_azn->fetch()){
            echo"<tr>";
            echo"<td>".$row['INSTNM']."</td>";
            echo"<td>".$row['UGDS_ASIAN']."</td>";
            echo"<td>".$row['UGDS_WHITE']."</td>";
            echo"</tr>";
        }
        echo"</table>";
        ?>
        <hr>
        <center><h3>Universities that has 4+ years degree AND located at Pennsylvania
                that scored more than 14+ Carneige Score</h3></center>
        <br>
        <?php
        //show universities that has 4+ yrs and located at PA 
        $sql_h_l = $db->query("select INSTNM, HIGHDEG, STABBR, CCUGPROF from national_university_data where HIGHDEG >= 4 "
                . "and STABBR='PA' "
                . "and CCUGPROF>= 14");
        echo"<table border='2'>";
        echo"<tr>";
        echo"<th>Institution Name</th>";
        echo"<th>Highest Degree offer</th>";
        echo"<th>State</th>";
        echo"<th>Carneige Score</th>";
        while ($row=$sql_h_l->fetch()){
            echo"<tr>";
            echo"<td>".$row['INSTNM']."</td>";
            echo"<td>".$row['HIGHDEG']."</td>";
            echo"<td>".$row['STABBR']."</td>";
            echo"<td>".$row['CCUGPROF']."</td>";
            echo"</tr>";
        }
        echo"</table>";
        ?>        
        <hr>
        <center><h3>Top 100 undergraduate Carnegie scored Universities</h3></center>
        <br>
        <?php
        //Show top 100 universities topped udergraduate
        $sql_CS = $db->query("select UNITID, INSTNM, CCUGPROF, CITY, STABBR,ZIP from national_university_data "
                . "order by CCUGPROF desc"
                . " limit 100");
        echo"<table border='2'>";
        echo"<tr>";
        echo"<th>ID</th>";
        echo"<th>Institution Name</th>";
        echo"<th>Undergraduate Carnegie Score</th>";
        echo"<th>City</th>";
        echo"<th>State</th>";
        echo"<th>ZIP</th>";
        while ($row=$sql_CS->fetch()){
            echo"<tr>";
            echo"<td>".$row['UNITID']."</td>";
            echo"<td>".$row['INSTNM']."</td>";
            echo"<td>".$row['CCUGPROF']."</td>";
            echo"<td>".$row['CITY']."</td>";
            echo"<td>".$row['STABBR']."</td>";
            echo"<td>".$row['ZIP']."</td>";
            echo"</tr>";
        }
        echo"</table>";
        ?>        
        <!--
        
        Following code will output all the data in db.As I mentioned,
        it has tons of data. DO NOT use unless intend
        to observe all data.
        <hr>
        
        
        <?php
        //show all data
        $sql_all = $db->query("select * from national_university_data");
        echo"<table border='2'>";
        echo"<tr>";
        echo"<th>University ID</th>";
        echo"<th>OPEID</th>";
        echo"<th>OPEID 6</th>";
        echo"<th>Instution Name</th>";
        echo"<th>City</th>";
        echo"<th>State</th>";
        echo"<th>Zip Code</th>";
        echo"<th>Accrediting Agency</th>";
        echo"<th>Institution URL</th>";
        echo"<th>Net Price Information</th>";
        echo"<th>Number of Branch</th>";
        echo"<th>Years of Highest Degree Offer</th>";
        echo"<th>Carnegie Classifications</th>";
        echo"<th>Size of Carnegie and settings</th>";
        echo"<th>Number of Undergraduate Students</th>";
        echo"<th>Percentage of White Students</th>";
        echo"<th>Percentage of Black Students</th>";
        echo"<th>Percentage of Hispanic Students</th>";
        echo"<th>Percentage of Asian Students</th>";
        echo"<th>Percentage of Native Islander Students</th>";

        while ($row =$sql_all->fetch()){
            echo "<tr>";
            echo "<td>".$row['UNITID']."</td>";
            echo "<td>".$row['OPEID']."</td>";
            echo "<td>".$row['OPEID6']."</td>";
            echo "<td>".$row['INSTNM']."</td>";
            echo "<td>".$row['CITY']."</td>";
            echo "<td>".$row['STABBR']."</td>";
            echo "<td>".$row['ZIP']."</td>";
            echo "<td>".$row['ACCREDAGENCY']."</td>";
            echo "<td>".$row['INSTURL']."</td>";
            echo "<td>".$row['NPCURL']."</td>";
            echo "<td>".$row['NUMBRANCH']."</td>";
            echo "<td>".$row['HIGHDEG']."</td>";
            echo "<td>".$row['CCUGPROF']."</td>";
            echo "<td>".$row['CCSIZSET']."</td>";
            echo "<td>".$row['UGDS']."</td>";
            echo "<td>".$row['UGDS_WHITE']."</td>";
            echo "<td>".$row['UGDS_BLACK']."</td>";
            echo "<td>".$row['UGDS_HISP']."</td>";
            echo "<td>".$row['UGDS_ASIAN']."</td>";
            echo "<td>".$row['UGDS_AIAN']."</td>";
            echo"</tr>";

        }
        
        echo"</table>";
        
        ?>
-->
        <hr>
        <p>
            End of page
        </p>
    </body>
</html>
