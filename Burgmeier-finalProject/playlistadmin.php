<!DOCTYPE html>
<html>
	<head>
		<title>Playlist Admin Page</title>
	</head>

<body>

<?php
include("connectToDB.inc");

if(isset($_POST['tableName2']) &&  isset($_POST['attributeName2']) && isset($_POST['attributeValue2']) && isset($_POST['attributeName3']) && isset($_POST['attributeValue3']))
	{
		updateRecords();
		showAllData();
	}

else{
	showAllData();
	}

function showAllData()
{
	$dataBase = connectDB();

	$query1 = 'SELECT * FROM songtable ORDER BY song_id';
	$result1 = mysqli_query($dataBase, $query1) or die('Query failed: ' . mysqli_error($dataBase));

	echo "<br>All <i>Songs</i>:<br>";

	echo "<table border='1'>";
	echo "<tr> <td>song_id</td> <td>song name</td> <td>artist name</td> <td>genre name</td> <td>energy level</td> <td>link to song</td></tr>";
	while ($line1 = mysqli_fetch_array($result1, MYSQL_ASSOC))
		{extract($line1);
			echo "<tr> <td>$song_id</td> <td>$song_name</td> <td>$artist_name</td> <td>$genre_name</td> <td>$energy_level</td> <td>$link</td></tr>";
		}
    echo "</table>";

	$query2 = 'SELECT genre_type, COUNT(user_id) AS COUNT
		FROM genretable
		JOIN usergenre
		ON genretable.genre_id = usergenre.genre_id
		GROUP BY genre_type';

   	$result2 = mysqli_query($dataBase, $query2) or die('Query failed: ' . mysqli_error($dataBase));

    echo "<br>All Genre Choice Records:<br>";
    echo "<table border='1'>";
    echo "<tr> <td>count</td><td>genre_type</td></tr>";
	while ($line2 = mysqli_fetch_array($result2, MYSQL_ASSOC))
		{extract($line2);

			echo "<tr> <td>$COUNT</td><td>$genre_type</td></tr>";
		}
    echo "</table>";

    mysqli_close($dataBase);
}
 

function updateRecords(){
	$dataBase = connectDB();

	$q1 = ' UPDATE ';
	$q2 = mysqli_real_escape_string($dataBase, $_POST['tableName2']);
	$q3 = " SET ";
	$q4 = mysqli_real_escape_string($dataBase, $_POST['attributeName2']). "=";
	$q5 = "'" . mysqli_real_escape_string($dataBase, $_POST['attributeValue2']). "'";
	$q6 = ' WHERE ';
	$q7 = mysqli_real_escape_string($dataBase, $_POST['attributeName3']). "=";
	$q8 = "'" . mysqli_real_escape_string($dataBase, $_POST['attributeValue3']). "'";

	$query4 = $q1.$q2.$q3.$q4.$q5.$q6.$q7.$q8;

	echo "You ran this query: ".$query4."<br>";

	$result4 = mysqli_query($dataBase, $query4) or die('Query failed: ' . mysqli_error($dataBase));

	echo "the selected row has been updated . . . <br>";

	mysqli_close($dataBase);
}


echo <<<END
	<h2>Below you can UPDATE records in the tables above</h2>
	<form action="$_SERVER[PHP_SELF]" method="post">
		<p>UPDATE <input type="text" name="tableName2" value=""> </p>
		<p>SET <input type="text" name="attributeName2" value=""> = <input type="text" name="attributeValue2" value=""> </p>
		<p>WHERE <input type="text" name="attributeName3" value=""> = <input type="text" name="attributeValue3" value=""> </p>
		<input type='submit'>
	</form>
END;


?>


</body>
<html>