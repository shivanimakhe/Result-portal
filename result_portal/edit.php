<?php
include('config.php');

$output = array();

$row = mysqli_fetch_assoc(mysqli_query($conn,"Select * from result where id='".$_POST["result_id"]."' "));
$sel_result = mysqli_fetch_assoc(mysqli_query($conn,"Select * from student where roll_no='".$row["rollno"]."' "));
if($row['result']==1)
    {
        $res="Pass";
    }else{
        $res="Fail";
    }

$output["std_id"] = $sel_result["id"];
$output["roll_no"] = $sel_result["roll_no"];
$output["name"] = $sel_result["name"];
$output["email"] = $sel_result["email"];
$output["mobile"] = $sel_result["mobile"];
$output["dept"] = $sel_result["dept"];
$output["subject"] = $row["subject"];
$output["marks_obtained"] = $row["marks_obtained"];
$output["result"] = ucwords($res);
$output["grade"] = $row["grade"];
echo json_encode($output);
?>