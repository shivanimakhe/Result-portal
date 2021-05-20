<?php
error_reporting(0);

include('config.php');

$std_query .= "SELECT student.*, result.subject ,result.marks_obtained,result.result, result.grade,result.id as result_id FROM student JOIN result on student.roll_no=result.rollno ";
$statement = mysqli_query($conn,$std_query);
$sr_no=1;
while($row = mysqli_fetch_assoc($statement))
{
    if($row['result']==1)
    {
        $res="Pass";
    }else{
        $res="Fail";
    }
    ?>
    <tr>
			<td><?=$sr_no++;?></td>
			<td><?=$row['roll_no'];?></td>
			<td><?=ucwords($row['name']);?></td>
			<td><?=$row['email'];?></td>
			<td><?=$row['mobile'];?></td>
			<td><?=$row['dept'];?></td>
			<td><?=ucwords($row['subject']);?></td>
			<td><?=$row['marks_obtained'];?></td>
			<td><?=$res;?></td>
			<td><?=ucwords($row['grade']);?></td>
			<td>
                <button type="button" name="update" id="<?=$row['result_id'];?>" class="btn btn-info btn-sm update"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</button>
            </td>
			<td><button type="button" name="delete" id="<?=$row['result_id'];?>" class="btn btn-danger btn-sm delete">Delete</button></td>
		</tr>
    <?php
}
?>