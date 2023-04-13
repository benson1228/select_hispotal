<?php
$link = mysqli_connect("localhost", 'root','',  "test");
$link -> set_charset("UTF8");

$year = $_POST["year"];
$month =  $_POST["month"];
$date =  $_POST["date"];
$Date = $year .'/'.$month .'/'.$date;
$result = $link ->query("
    SELECT COUNT(if(P.PAT_SEX = 0,true,null)) AS female , COUNT(if(P.PAT_SEX = 1,true,null)) AS male , COUNT(P.PAT_ID) AS total , H.HIS_DATE
    FROM patient AS P INNER JOIN history AS H ON P.PAT_ID = H.HIS_PAT_ID
    WHERE  H.HIS_DATE = '".$Date."'
    GROUP BY H.HIS_DATE"

);
while ($row = $result->fetch_assoc())
{
    $COUNT_PH[] = $row;
}
$link -> close();
?>
<style type="text/css">
    td{
        border: 1px solid;
        padding: 5px;
    }
</style>
<table>
    <tr>
        <td>日期</td>
        <td>男性就醫人次</td>
        <td>女性就醫人次</td>
        <td>累計</td>
    </tr>
    <?php if(!empty($COUNT_PH)){ ?>
        <?php foreach ($COUNT_PH as $k => $v): ?>
            <tr>
                <td><?php echo $v['HIS_DATE']?></td>
                <td><?php echo $v['male']?></td>
                <td><?php echo $v['female']?></td>
                <td><?php echo $v['total']?></td>
            </tr>
        <?php endforeach ?>
    <?php }else {?> 
        無資料
    <?php }?>
</table>