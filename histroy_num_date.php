<?php

    $data = file_get_contents("php://input","r");
    $mydata = array();
    $mydata = json_decode($data,true);

    require_once("dbtool.php");

    $link = create_connect();

    $day = $mydata["day"];

    $sql = "SELECT * FROM history WHERE HIS_DATE = '$day'";

    $result = execute_sql($link,"id19936085_movie_db",$sql);

    if(mysqli_num_rows($result) > 0){

        $row = array();

        while($assoc = mysqli_fetch_assoc($result)){
            $row[] = $assoc;
    
        }
        
        echo '{"state":true, "message":"查詢成功", "data":'.json_encode($row).'}';

    }else{
        echo '{"state":false, "message":"查詢失敗"}';
    }

?>