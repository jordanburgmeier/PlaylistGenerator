<!DOCTYPE html>

<!-- Playlist Generator -->
<!-- By: Ele and Jordan -->
<html>
   <head>
      <meta charset="utf-8">
      <title>Playlist Generator</title>

      <link href="https://fonts.googleapis.com/css?family=Chilanka&display=swap" rel="stylesheet">
      
      <style> 
      <?php include "css/playlist.css";?>
      </style>
      <script src="homescreen.js"></script>
   </head>
   <body>

    <div id="pageTitle">
        <h1>YOUR PERSONALIZED PLAYLIST</h1> 
    </div> 

    <div id="theButtons">
        <a href="http://elegeoly.infinityfreeapp.com/PlaylistGeneratorV1/" id="genButton">NEW PLAYLIST</a>
        <a href="http://elegeoly.infinityfreeapp.com/PlaylistGeneratorV1/playlistadmin.php" id="genButton">ADMIN PAGE</a>
    </div>
    
    <?php


    $query="SELECT * FROM `songtable` WHERE `energy_id` = '".$usertable_energy_id."' && `genre_id` = '".$usertable_genre_id."'";
    $result=mysql_query($query);

    ?>

 <div id="tableID">
    <?php

    function insertDataToDB() {

	   include("connectToDB.inc");
	   $dataBase = connectDB();

       $range_slider_value = $_POST["energy"];
	  
       $genre_choice = $_POST['genre'];

        //insert record in table
	   $st1 = "INSERT INTO `usertable` (`user_id`,`energy_level`, `genre_name`)";
	   $st2 = "VALUES('";
       $st3 = mysqli_real_escape_string($dataBase, $_POST[NULL])."','";
	   $st4 = mysqli_real_escape_string($dataBase, $_POST['energy'])."','";
	   $st5 = mysqli_real_escape_string($dataBase, $_POST['genre'])."','";
	   $st99 = "');";
	    //form the query
  	    $query1 = $st1.$st2.$st3.$st4.$st99;
 // 	execute the query in the databse
	   $result1 = mysqli_query($dataBase, $query1) or die('Query failed: ' . mysqli_error($dataBase));

        //$sql = "SELECT * FROM `songtable` WHERE (`energy_level` = $range_slider_value AND `genre_name` = $genre_choice) OR (`energy_level`= ($range_slider_value - 3) AND `genre_name` = $genre_choice) OR (`energy_level`= ($range_slider_value + 3) AND `genre_name` = $genre_choice)";
        
        $qt1 = "INSERT INTO `usergenre` (`user_id`,`genre_id`, `genre_name`)";
	   $qt2 = "VALUES('";
       $qt3 = mysqli_real_escape_string($dataBase, $_POST[NULL])."','";
	   $qt4 = mysqli_real_escape_string($dataBase, $_POST['genre'])."','";
	   $qt5 = mysqli_real_escape_string($dataBase, $_POST['energy'])."','";
	   $st99 = "');";
	    //form the query
  	    $query2 = $qt1.$qt2.$qt3.$qt4.$st99;
 // 	execute the query in the databse
	   $result2 = mysqli_query($dataBase, $query2) or die('Query failed: ' . mysqli_error($dataBase));
        
        $sql = "SELECT * FROM `songtable` WHERE (`energy_level` BETWEEN $range_slider_value - 3 AND $range_slider_value +3) AND `genre_name` = $genre_choice";
        //$sql = "SELECT * FROM `songtable` WHERE `genre_name` = $genre_choice";
 
       // $sql = "SELECT song_name, artist_name, link FROM songtable";
        $result = mysqli_query($dataBase, $sql) or die("Bad Query: $sql".mysqli_error($dataBase));

        echo"<table id='styleTable' border='1'>";

        echo"<tr><td id='songCol'>song</td><td id='artistCol'>artist</td><td id='linkCol'>listen</td></tr>";
        
        while ($row = mysqli_fetch_assoc($result)){
            echo"<tr><td id='songCol2'>{$row['song_name']}</td><td id='artistCol2'>{$row['artist_name']}</td><td id='linkCol2'><a class='play-btn' target = '_blank' href={$row['link']}></a></td></tr>";

            

        }
        echo"</table>";

  mysql_close($dataBase);
}

  insertDataToDB();

?>
</div> 


</body>
</html>
