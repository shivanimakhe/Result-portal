<?php
include('config.php');

if(isset($_POST["operation"]))
{
    if($_POST['result']=="Pass")
    {
        $result=1;
    }else{
        $result=0;
    }
    
    if($_POST["operation"] == "Add")
	{
    
        $sel_num = mysqli_num_rows(mysqli_query($conn,"Select * from student where roll_no='".$_POST['roll_no']."' "));

        if($sel_num==0)
        {
            $insert =  "INSERT INTO `student`(`roll_no`, `name`, `email`, `mobile`, `dept`) VALUES ('".$_POST['roll_no']."','".$_POST['name']."','".$_POST['email']."','".$_POST['mobile']."','".$_POST['dept']."') ";

            $qry = mysqli_query($conn,$insert);

            if($qry==true)
            {
                $insert12 =  "INSERT INTO `result`(`rollno`, `subject`, `total_marks`, `marks_obtained`, `result`, `grade`) VALUES  ('".$_POST['roll_no']."','".$_POST['subject']."',100,'".$_POST['marks_obtained']."','".$result."','".$_POST['grade']."') ";

                $qry12 = mysqli_query($conn,$insert12);
                if($qry12 == true)
                {
                    echo 1;
                }else{
                    echo 0;
                }
            }
            else{
                echo 0;
            }
        }else{
            $insert12 =  "INSERT INTO `result`(`rollno`, `subject`, `total_marks`, `marks_obtained`, `result`, `grade`) VALUES  ('".$_POST['roll_no']."','".$_POST['subject']."',100,'".$_POST['marks_obtained']."','".$result."','".$_POST['grade']."') ";

                $qry12 = mysqli_query($conn,$insert12);
                if($qry12 == true)
                {
                    echo 1;
                }else{
                    echo 0;
                }
        }


    }
    if($_POST["operation"] == "Edit")
	{
        $sel_student = mysqli_fetch_assoc(mysqli_query($conn,"Select * from student where id='".$_POST['std_id']."' "));
        $rollno=$sel_student['roll_no'];
        
        $update ="UPDATE `student` SET `roll_no`='".$_POST['roll_no']."',`name`='".$_POST['name']."' ,`email`='".$_POST['email']."',`mobile`='".$_POST['mobile']."',`dept`='".$_POST['dept']."' WHERE id='".$_POST['std_id']."' ";
        $qry_updt = mysqli_query($conn,$update);
        
		if($qry_updt==true)
        {
            $sel_query = mysqli_query($conn,"Select * from result where rollno='".$rollno."' ");
            while($up_rest=mysqli_fetch_assoc($sel_query))
            {
                $result_upd ="UPDATE `result` SET `rollno`='".$_POST['roll_no']."' WHERE id='".$up_rest['id']."' ";
                $qry_rest = mysqli_query($conn,$result_upd);
            }
            
            $res_update ="UPDATE `result` SET `rollno`='".$_POST['roll_no']."', `subject`='".$_POST['subject']."' ,`marks_obtained`='".$_POST['marks_obtained']."', `result`='".$result."',`grade`='".$_POST['grade']."' WHERE id='".$_POST['result_id']."' ";
            $qry_result = mysqli_query($conn,$res_update);
            if($qry_result==true)
            {
               echo 1;
            }else{
                echo 0;
            }
        }
	}
}

elseif($_POST["rollno"]!='')
{
    $output = array();
    $num_stud = mysqli_num_rows(mysqli_query($conn,"Select * from student where roll_no='".$_POST["rollno"]."' "));
    if($num_stud>0)
    {
        $sel_student = mysqli_fetch_assoc(mysqli_query($conn,"Select * from student where roll_no='".$_POST["rollno"]."' "));

        $output["name"] = ucwords($sel_student["name"]);
        $output["email"] = $sel_student["email"];
        $output["mobile"] = $sel_student["mobile"];
        $output["dept"] = ucwords($sel_student["dept"]);
        echo json_encode($output);
    }else{
        echo "";
    }
}

elseif($_POST["res_id"]!='')
{
    $sel_res = mysqli_fetch_assoc(mysqli_query($conn,"Select * from result where id='".$_POST["res_id"]."' "));
    $num_res = mysqli_num_rows(mysqli_query($conn,"Select * from result where rollno='".$sel_res["rollno"]."' "));
    if($num_res==1)
    {
        $delete12="Delete from student where roll_no='".$sel_res["rollno"]."' ";
        $delete_query12=mysqli_query($conn,$delete12);
    }
    $delete="Delete from result where id='".$_POST["res_id"]."' ";
    $delete_query=mysqli_query($conn,$delete);
    if($delete_query==true)
    {
        echo 1;
    }
    else{
        echo 0;
    }
}



?>