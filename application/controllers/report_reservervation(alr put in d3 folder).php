<?php
    $username = "root"; 
    $password = "root";   
    $host = "localhost";
    $database="rms";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);

    $myquery = "SELECT DATE_FORMAT(R.start_date, '%d-%b-%y') AS date, COUNT(reservation_id) AS close
FROM reservation R
GROUP BY DATE(R.start_date)";

    $query = mysql_query($myquery);
    
    if ( ! $query ) {
        echo mysql_error();
        die;
    }
    
    $data = array();
    
    for ($x = 0; $x < mysql_num_rows($query); $x++) {
        $data[] = mysql_fetch_assoc($query);
    }
    
    echo json_encode($data);     
     
    mysql_close($server);
?>