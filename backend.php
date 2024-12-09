<?php
session_start();
include_once "db.php";

//faculty register start
if($_SERVER['REQUEST_METHOD']=="GET")
{
    header("Content-type:application/json");
    $sql="select * from student order by rollno";
    $result=$con->query($sql);
    $a=$result->fetchAll();
    echo json_encode($a);
}
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $cmd=$_POST["cmd"];
    if($cmd=="add_attendance")
    {
        $sid=strip_tags(trim($_POST['sid']));
        $status=strip_tags(trim($_POST['status']));
        $date=date('d-m-Y');

        $sql="insert into attendance (student_id,status,adate) values (:sid,:status,:adate)";
        $result=$con->prepare($sql);
        $result->bindParam(":sid",$sid);
        $result->bindParam(":status",$status);
        $result->bindParam(":adate",$date);
        
        try
        {
            $result->execute();
            echo "Attendance added successfully";
        }
        catch(Exception $e)
        {
            echo "Error to add Attendance";
        }
    }
    if($cmd=="faculty_register")
    {
        $full_name=strip_tags(trim($_POST['full_name']));
        $mobile_no=strip_tags(trim($_POST['mobile_no']));
        $birth_date=strip_tags(trim($_POST['birth_date']));
        $qualification=strip_tags(trim($_POST['qualification']));
        $username=strip_tags(trim($_POST['username']));
        $user_id=strip_tags(trim($_POST['user_id']));
        $password=strip_tags(trim($_POST['password']));
        $password=password_hash($password,PASSWORD_DEFAULT);

        $sql2="select * from faculty where mobile_no=:mobile_no";
        $result2=$con->prepare($sql2);
        $result2->bindParam(":mobile_no",$mobile_no);
        $result2->execute();
        $row=$result2->fetch();
        if($row)
        {
            echo "Mobile number already exists";
            exit;
        }

        $sql2="select * from faculty where user_id=:user_id";
        $result2=$con->prepare($sql2);
        $result2->bindParam(":user_id",$user_id);
        $result2->execute();
        $row=$result2->fetch();
        if($row)
        {
            echo "User Id already exists";
            exit;
        }

        $sql="insert into faculty (full_name,birth_date,qualification,username,user_id,password,mobile_no) values 
        (:full_name,:birth_date,:qualification,:username,:user_id,:password,:mobile_no)";
        $result=$con->prepare($sql);
        $result->bindParam(":full_name",$full_name);
        $result->bindParam(":mobile_no",$mobile_no);
        $result->bindParam(":birth_date",$birth_date);
        $result->bindParam(":qualification",$qualification);
        $result->bindParam(":username",$username);
        $result->bindParam(":user_id",$user_id);
        $result->bindParam(":password",$password);

        try
        {
            $result->execute();
            echo "Registered successfully";
        }
        catch(Exception $e)
        {
            echo "Error to register";
        }
        
    }

    //faculty registration end
    
    elseif($cmd=="fac_login")
    {
        $user_id=strip_tags(trim($_POST['user_id']));
        $password=strip_tags(trim($_POST['password']));

        $sql2="select * from faculty where user_id=:user_id";
        $result2=$con->prepare($sql2);
        $result2->bindParam(":user_id",$user_id);
        $result2->execute();
        $row=$result2->fetch();
        if($row)
        {
            if(password_verify($password,$row['password']))
            {
                $_SESSION['fid']=$row['fid'];
                ?>
                <script>
                    alert('Login successfully');
                    window.location.replace('faculty/add_student.php');
                </script>
                <?php
            }
            else
            {
                ?>
                <script>
                    alert('userid or password incorrect');
                    window.location.replace('index.php');
                </script>
                <?php
            }
        }
        else
        {
            ?>
            <script>
                alert('userid or password incorrect');
                window.location.replace('index.php');
            </script>
            <?php
        }

       
    }
    elseif($cmd=="add_student")
    {
        $name=strip_tags(trim($_POST['name']));
        $rollno=strip_tags(trim($_POST['rollno']));
        $course=strip_tags(trim($_POST['course']));
        $branch=strip_tags(trim($_POST['branch']));
        $semester=strip_tags(trim($_POST['semester']));

        $sql2="select * from student where rollno=:rollno";
        $result2=$con->prepare($sql2);
        $result2->bindParam(":rollno",$rollno);
        $result2->execute();
        $row=$result2->fetch();
        if($row)
        {
            echo "Roll No already exists";
            exit;
        }


        $sql="insert into student (name,rollno,course,branch,semester) values 
        (:name,:rollno,:course,:branch,:semester)";
        $result=$con->prepare($sql);
        $result->bindParam(":name",$name);
        $result->bindParam(":rollno",$rollno);
        $result->bindParam(":course",$course);
        $result->bindParam(":branch",$branch);
        $result->bindParam(":semester",$semester);

        try
        {
            $result->execute();
            echo "Student Add successfully";
        }
        catch(Exception $e)
        {
            echo "Error to Add Student";
        }
    }
    elseif($cmd=="update_password")
    {

        $birth_date=strip_tags(trim($_POST['birth_date']));
        $user_id=strip_tags(trim($_POST['user_id']));
        $password=strip_tags(trim($_POST['password']));
        $password=password_hash($password,PASSWORD_DEFAULT);



        $sql2="select * from faculty where user_id=:user_id and birth_date=:birth_date";
        $result2=$con->prepare($sql2);
        $result2->bindParam(":user_id",$user_id);
        $result2->bindParam(":birth_date",$birth_date);
        $result2->execute();
        $row=$result2->fetch();
        if($row)
        {
            $sql="update faculty set password=:password where birth_date=:birth_date and user_id=:user_id";
            $result=$con->prepare($sql);
            $result->bindParam(":birth_date",$birth_date);
            $result->bindParam(":user_id",$user_id);
            $result->bindParam(":password",$password);
    
            try
            {
                $result->execute();
                echo "Password updated successfully";
            }
            catch(Exception $e)
            {
                echo "Error to update password";
            }
        }
        else
        {
            echo "User Id or Birth date not match";
        }

     
        
       }
}
//student register end

$con=null;
?>