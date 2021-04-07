<?php require_once 'nav.html'; ?>

<?php

require_once 'database.php';

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn){
    // $query = 'SELECT * FROM artists';
    $query = 'SELECT * FROM artists ORDER BY bio DESC';

    $results = mysqli_query($conn, $query);

    $artists = mysqli_fetch_all($results, MYSQLI_ASSOC);

    foreach ($artists as $artist) {
      echo '<br>';
      echo 'Name : ' . $artist['name'] . '<br>';
      echo 'Bio : '  . substr($artist['bio'], 0, 20) . '<br>' . '<br>';

      echo '<hr>';
    }
  

    mysqli_close($conn);

}else {
    echo 'Problem connecting to the DB';
}




?>