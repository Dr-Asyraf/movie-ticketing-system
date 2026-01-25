<?php
$servername = 'localhost';
$username = 'root';
$password = 'Asyraffauzi14';
$dbname = 'movie-ticketing-system';

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM movie;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //output data for each row
    while ($row = $result->fetch_assoc()) {
        echo "Title: " . strtoupper($row['title']);echo "</br>";
        echo "-Genre: " . implode(", " , array_column(json_decode($row["genre"], true),"name"));echo "</br>";
        echo "-Duration: " . $row["duration"]. " mins";echo "</br>";
        echo "-Rating: " . $row["rating"]. "/10";echo "</br>";
        echo "-Release Date: " . $row["release_date"];echo "</br>";
        echo "</br>";


        // $valJ = json_decode($row["genre"], true);
        // var_dump(implode(", " , array_column($valJ,"name")));
        // var_dump(array_column($valJ,"name"));
    }
}
