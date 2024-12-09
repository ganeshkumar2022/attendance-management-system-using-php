<!-- header content start -->
<?php
include_once "session_check.php";
require_once "../header.php";
?>
<!-- header content end -->
<?php
include_once "../db.php";
$fid=$_SESSION['fid'];
$sql="select username from faculty where fid=:fid";
$result=$con->prepare($sql);
$result->bindParam(":fid",$fid);
$result->execute();
$row=$result->fetch();
?>
<!-- body content start -->
<div class="main-content">
    <div class="bg-success text-white">
        <h2 class="p-4 text-center"><i>Attendance Management System</i></h2>
    </div>
    <div class="container">
        <h3 class="text-center fw-bold">
            Welcome <span class="text-primary"><?=$row['username']?></span>
        <a href="logout.php" class="btn btn-primary float-end"><i class="fa-solid fa-user"></i> Logout</a>
        </h3>
    </div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
               <hr>
               <form id="student_register" method="post" action="2.php" autocomplete="off">
               <h4 class="text-center">Add New Student
                <a href="check_record.php" class="btn btn-success float-end">Check record <i class="fa-regular fa-file-lines"></i></a>
               </h4>
               <div class="row mt-4">
                    <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Student Name" id="name" name="name">
                    <span class="text-danger name_err"></span>
                    </div>
                    <div class="col-md-4">
                    <input type="text" class="form-control" onkeypress="return number_check(event)" maxlength="6" placeholder="Student Roll no" name="rollno" id="rollno">
                    <span class="text-danger rollno_err"></span>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4">
                    <select class="form-select" name="course" id="course">
                       <option value="">Choose Course</option>
                       <option value="Diploma">Diploma</option>
                       <option value="B.E">B.E</option>
                       <option value="M.Tech">M.Tech</option>
                       <option value="BCA">BCA</option>
                       <option value="MCA">MCA</option>
                       <option value="BCOM">BCOM</option>
                    </select>
                    <span class="text-danger course_err"></span>
                    </div>
                    <div class="col-md-4">
                    <select class="form-select" name="semester" id="semester">
                       <option value="">Choose Semester</option>
                       <option>I</option>
                       <option>II</option>
                       <option>III</option>
                       <option>IV</option>
                       <option>V</option>
                       <option>VI</option>
                       <option>VII</option>
                       <option>VIII</option>
                    </select>
                    <span class="text-danger semester_err"></span>
                    </div>
                    <div class="col-md-4">
                    <select class="form-select" name="branch" id="branch">
                       <option value="">Choose Branch</option>
                       <option>Mechanical</option>
                       <option>Electrical</option>
                       <option>Civil</option>
                       <option>CSE</option>
                       <option>Arts</option>
                       <option>Science</option>
                    </select>
                    <span class="text-danger branch_err"></span>
                    </div>
                    <div class="col-md-4 offset-4 mt-3">
                        <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-block">Add Student</button>
                        </div>
                    </div>
                </div>
               </form>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <h3 class="text-center">Mark Attendance <?=date('d-m-Y')?></h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Roll No</th>
                                <th>Course</th>
                                <th>Semester</th>
                                <th>Branch</th>
                                <th>Attendance</th>
                            </tr>
                            </thead>
                            <tbody>
<?php
$d=date('d-m-Y');
$sql="select * from student order by name asc";
$result=$con->query($sql);
$result->execute();
$i=1;
while($row=$result->fetch())
{
    ?>
    <tr>
        <td><?=$i?></td>
        <td><?=$row['name']?></td>
        <td><?=$row['rollno']?></td>
        <td><?=$row['course']?></td>
        <td><?=$row['semester']?></td>
        <td><?=$row['branch']?></td>
        <td>
            <?php
            $sid=$row['sid'];
            $sql3="select * from attendance where adate=:adate and student_id=:sid";
            $result3=$con->prepare($sql3);
            $result3->bindParam(":adate",$d);
            $result3->bindParam(":sid",$sid);
            $result3->execute();
            $row3=$result3->fetch();
            if($row3!=""  && $row3['status']!="" && $row3['adate']==$d)
            {
                ?>
                <span class="btn <?=$row3['status']=='present'?'btn-success':'btn-danger'?> rounded-5"><?=$row3['status']?></span>
                <?php
            }
            else
            {
                ?>
                <button type="button" onclick="present_or_absent('<?=$row['sid']?>','present')" class="btn btn-success">P</button>
                <button type="button" onclick="present_or_absent('<?=$row['sid']?>','absent')" class="btn btn-danger">A</button>
                <?php
            }
            ?>
        </td>
    </tr>
    <?php
    $i++;
}
if($i==1)
{
    ?>
    <tr>
        <td colspan="7" align="center">No records found</td>
    </tr>
    <?php
}
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- body content end -->


<script>

    //check rollnumber is number or not
    function number_check(e)
    {
        if(e.keyCode>=48 && e.keyCode<=57)
        {
            return true;
        }
    return false;
    }

    //present or absent add start
    function present_or_absent(sid,status)
    {
        var con=confirm("Are you sure you want to Confirm");
        if(con)
        {
            $.post("../backend.php",{
                sid:sid,
                status:status,
                cmd:"add_attendance"
            },function(response){
                alert(response);
                window.location.replace(window.location.href);
            });
        }
        else
        {
            alert('cancelled sucessfully');
        }
    }

    //present or absent add end

    //student add
    $(document).ready(function(){
$("#student_register").submit(function(e){
    e.preventDefault();
  
    var name=$("#name").val().trim();
    var rollno=$("#rollno").val().trim();
    var course=$("#course").val().trim();
    var branch=$("#branch").val().trim();
    var semester=$("#semester").val().trim();
    var valid=true;

    //name validation start
    var namepattern=/^[a-zA-Z][a-zA-Z ]+$/;
    if(name.length=="")
    {
        $(".name_err").text("Please enter name");
        $("#name").focus();
        valid=false;
    }
    else if(!namepattern.test(name))
    {
        $(".name_err").text("Name not valid");
        $("#name").focus();
        valid=false;
    }
    else
    {
        $(".name_err").text("");
    }
    //name validation end

    //rollno validation start
    var rollno_nopattern=/^\d{6}$/;
    if(rollno.length=="")
    {
        $(".rollno_err").text("Please enter Roll No");
        $("#rollno").focus();
        valid=false;
    }
    else if(!rollno_nopattern.test(rollno))
    {
        $(".rollno_err").text("roll no Not valid");
        $("#rollno").focus();
        valid=false;
    }
    else
    {
        $(".rollno_err").text("");
    }
    //rollno validation end

   

    //course validation start
    var course_pattern=/^[a-zA-Z][a-zA-Z\.\s]+$/;
    if(course.length=="")
    {
        $(".course_err").text("Please Choose your Course");
        $("#course").focus();
        valid=false;
    }
    else if(!course_pattern.test(course))
    {
        $(".course_err").text("Course format not valid");
        $("#course").focus();
        valid=false;
    }
    else
    {
        $(".course_err").text("");
    }
    //course validation end

    //semester validation start
     var semester_pattern=/^[IV]+$/;
    if(semester.length=="")
    {
        $(".semester_err").text("Please choose your Semester");
        $("#semester").focus();
        valid=false;
    }
    else if(!semester_pattern.test(semester))
    {
        $(".semester_err").text("Semester format not valid");
        $("#semester").focus();
        valid=false;
    }
    else
    {
        $(".semester_err").text("");
    }
    //semester validation end

    //branch validation start
    var branch_pattern=/^[a-zA-Z][a-zA-Z\.\s]+$/;
    if(branch.length=="")
    {
        $(".branch_err").text("Please Choose your Branch");
        $("#branch").focus();
        valid=false;
    }
    else if(!branch_pattern.test(branch))
    {
        $(".branch_err").text("branch format not valid");
        $("#branch").focus();
        valid=false;
    }
    else
    {
        $(".branch_err").text("");
    }
    //branch validation end



    if(valid)
    {
        var formdata=new FormData(this);
        formdata.append('cmd','add_student');
        $.ajax({
            url:"../backend.php",
            type:"POST",
            data:formdata,
            processData:false,
            contentType:false,
            success:function(response){
                alert(response);
                window.location.replace(window.location.href);
            },
            error:function(xhr,status,error)
            {
                alert(error);
                window.location.replace(window.location.href);
            }
        });
    }
    


});
});
</script>

<!-- footer content start -->
<?php
require_once "../footer.php";
?>
<!-- footer content end -->