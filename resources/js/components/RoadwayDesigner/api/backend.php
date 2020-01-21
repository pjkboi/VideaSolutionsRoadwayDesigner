<?php
    include_once 'connection.php';
    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck>0){
        while($row = mysqli_fetch_assoc($result)){
        echo json_encode($row['user_name'] ,"<br />");
        }
    }
?> 
