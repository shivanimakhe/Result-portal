<?php
error_reporting(0);
include('config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Students detail</title>
<!--    <link rel="stylesheet" type="text/css" href="styles.css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <style>
        .alert-info {
            color: #fbfcfd;
            background-color: #232627;
            border-color: #262929;
        }
        body {
           /* Background pattern from Toptal Subtle Patterns */
           height: 400px;
           width: 100%;
           background-image: url("https://www.pixelstalk.net/wp-content/uploads/images4/Mountain-4K-Wallpaper-scaled.jpg");
        }
    </style>
</head>
<body >
   <div class="col-sm-12"> 
    
       <div class="alert alert-info"><h3 style="text-align:center;"><b>Result Portal</b></h3> </div>
    <div class="col-sm-8 col-sm-offset-2">
    <div align="right"> 
        <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-lg">Add Student</button>
        
    </div><br>
                <table class="table table-striped table-bordered" style="background-color:white ! important;">  
                    <thead>
                        <tr >
                           <th>Sr No</th>
                           <th>Roll No</th>  
                           <th>Name</th>
                           <th>Email ID</th>
                           <th>Mobile</th>
                           <th>Department</th>
                           <th>Subject</th>
                           <th>Marks Obtained</th>
                           <th>Result</th>
                           <th>Grade</th>
                           <th>Edit</th>
                           <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="student_table" >
                    </tbody>
                </table>
          
           </div>     
   </div>               
 <div id="userModal" class="modal fade">
            <div class="modal-dialog">
                <form method="post" id="user_form" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="text-align:center;">Add Student</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <label>Enter Roll Number</label>
                                    <input type="number" name="roll_no" id="roll_no" min="0" class="form-control" onblur="showDetail()" required/><br/>
                                </div>
                                <div class="col-sm-12">
                                    <label>Enter Student Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required /><br /> 
                                </div>
                                <div class="col-sm-12">
                                    <label>Enter Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required /><br /> 
                                </div>
                                <div class="col-sm-12">
                                    <label>Enter Mobile</label>
                                    <input type="tel" name="mobile" id="mobile" class="form-control" maxlength="10" required/><br /> 
                                </div>
                                <div class="col-sm-12">
                                    <label>Enter Department</label>
                                    <input type="text" name="dept" id="dept" class="form-control"  required/><br /> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <label>Enter Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control"  required/><br /> 
                                </div>
                                <div class="col-sm-12">
                                    <label>Enter Marks Obtained</label>
                                    <input type="number" name="marks_obtained" min="0" max="100" id="marks_obtained" class="form-control" onblur="myResult()" required/><br /> 
                                </div>
                                <div class="col-sm-12">
                                    <label>Result</label>
                                    <input type="text" name="result" id="result" class="form-control"  readonly/><br /> 
                                </div>
                                <div class="col-sm-12">
                                    <label>Grade</label>
                                    <input type="text" name="grade" id="grade" class="form-control"  readonly/><br /> 
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                             <div class="col-sm-12">
                                <input type="hidden" name="std_id" id="std_id" />
                                <input type="hidden" name="result_id" id="result_id" />
                                <input type="hidden" name="operation" id="operation" />
                                <input type="submit" name="action" id="action" class="btn btn-primary" value="Add" />
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

   <script>
function showDetail() {
    var rollno = $('#roll_no').val();
    $.ajax({
        url:"ajax.php",
        method:"POST",
        data:{rollno:rollno},
        dataType:"json",
        success:function(data)
        {
             $('#name').val(data.name);
             $('#email').val(data.email);
             $('#mobile').val(data.mobile);
             $('#dept').val(data.dept);
        }
    });
    
}
       
function myResult() {
    var marks = $('#marks_obtained').val();
    if (marks > 100)
    {
        alert('Marks should be less than or equal to 100');
        $('#marks_obtained').val("");
    }
    else {
        if (marks > 90)
        {
            $('#result').val("Pass");
            $('#grade').val("S");
        } 
        else if (marks > 80 && marks <= 90)
        {
            $('#result').val("Pass");
            $('#grade').val("A+");
        }
        else if (marks > 70 && marks <= 80)
        {
            $('#result').val("Pass");
            $('#grade').val("A");
        }
        else if (marks > 60 && marks <= 70)
        {
            $('#result').val("Pass");
            $('#grade').val("B");
        }
        else if (marks > 50 && marks <= 60)
        {
            $('#result').val("Pass");
            $('#grade').val("C");
        } else {
            $('#result').val("Fail");
            $('#grade').val("");
        }
    }
}
 </script>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
    $('#add_button').click(function(){
        $('#user_form')[0].reset();
        $('.modal-title').text("Add Student Details");
        $('#action').val("Add");
        $('#operation').val("Add");
    });
    
    $.ajax({
		url: "view_ajax.php",
		type: "POST",
		cache: false,
		success: function(data){
//			alert(data);
			$('#student_table').html(data); 
		}
	});

    $(document).on('submit', '#user_form', function(event){
        event.preventDefault();
        var std_id = $('#std_id').val();
        var result_id = $('#result_id').val();
        var roll_no = $('#roll_no').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var mobile = $('#mobile').val();
        var dept = $('#dept').val();
        var subject = $('#subject').val();
        var marks_obtained = $('#marks_obtained').val();
        var result = $('#result').val();
        var grade = $('#grade').val();
        var form_data = new FormData(this);

        form_data.append("std_id", std_id)
        form_data.append("result_id", result_id)
        form_data.append("roll_no", roll_no)
        form_data.append("name", name)
        form_data.append("email", email)
        form_data.append("mobile", mobile)
        form_data.append("dept", dept)
        form_data.append("subject", subject)
        form_data.append("marks_obtained", marks_obtained)
        form_data.append("result", result)
        form_data.append("grade", grade)
            $.ajax({
                url:"ajax.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                    alert("Success");
                    location.reload();
                }
            });
        
    });
    
    
    $(document).on('click', '.delete', function(){
        var res_id = $(this).attr("id");
        if(confirm("Are you sure you want to delete this user?"))
        {
            $.ajax({
                url:"ajax.php",
                method:"POST",
                data:{res_id:res_id},
                success:function(data)
                {
                    location.reload();
                }
            });
        }
        else
        {
            return false;   
        }
    });
    
    
    $(document).on('click', '.update', function(){
        var result_id = $(this).attr("id");
        $.ajax({
            url:"edit.php",
            method:"POST",
            data:{result_id:result_id},
            dataType:"json",
            success:function(data)
            {
                $('#userModal').modal('show');
                $('#std_id').val(data.std_id);
                $('#roll_no').val(data.roll_no);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#mobile').val(data.mobile);
                $('#dept').val(data.dept);
                $('#subject').val(data.subject);
                $('#marks_obtained').val(data.marks_obtained);
                $('#result').val(data.result);
                $('#grade').val(data.grade);
                $('.modal-title').text("Edit Student Details");
                $('#result_id').val(result_id);
                $('#action').val("Save");
                $('#operation').val("Edit");
            }
        })
    });
    
});
</script>
     </body>
 </html>