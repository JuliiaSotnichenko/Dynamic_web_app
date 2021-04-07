 

<?php

require_once 'database.php';

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn){
    // $query = 'SELECT * FROM artists';
    $query = 'SELECT * FROM songs';

    $results = mysqli_query($conn, $query);

    $songs = mysqli_fetch_all($results, MYSQLI_ASSOC);

    foreach ($songs as $song) {
      echo '<br>';
      echo 'Name : ' . $song['title'] . '<br>';
      echo 'Release Date : '  . $song['release_date'] . '<br>' . '<br>';

      echo '<hr>';
    }
  

    mysqli_close($conn);

}else {
    echo 'Problem connecting to the DB';
}




?>