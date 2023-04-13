<?php

    $data = file_get_contents("php://input","r");
    $mydata = array();
    $mydata = json_decode($data,true);

    if(isset($mydata["year"]) && isset($mydata["month"])){
        if($mydata["year"] != "" && $mydata["month"] != "" ){
            require_once("dbtool.php");

            $link = create_connect();
        
            $year = $mydata["year"];
            $month = $mydata["month"];
        
            $sql = "SELECT * FROM history WHERE YEAR(HIS_DATE) = '$year' AND MONTH(HIS_DATE) = '$month'";
        
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
        }else{
            echo '{"state": false, "message":"欄位不得為空白!"}';
        }

    }else{
        echo '{"state": false, "message":"缺少規定欄位!"}';
    }



?>