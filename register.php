<!-- header content start -->
<?php
require_once "header.php";
?>
<!-- header content end -->

<!-- body content start -->
<div class="main-content">
    <div class="bg-success text-white">
        <h2 class="p-4 text-center"><i>Attendance Management System</i></h2>
    </div>
    <div>
        <h3 class="text-center fw-bold">Faculty Registration</h3>
    </div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6 offset-3">
                <div class="card border-2 p-2">
                    <div class="card-body">
                   <form action="2.php" id="faculty_register" method="post" autocomplete="off">
                        <div class="mb-3 mt-3">
                            <label for="full_name" class="form-label">Full name:</label>
                            <input type="text" class="form-control" id="full_name" placeholder="Enter Full name" name="full_name">
                            <span class="text-danger full_name_err"></span>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="mobile_no" class="form-label">Mobile no:</label>
                            <input type="text" class="form-control" id="mobile_no" maxlength="10" onkeypress="return number_check(event)" placeholder="Enter Mobile no" name="mobile_no">
                            <span class="text-danger mobile_no_err"></span>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="birth_date" class="form-label">Birth Date:</label>
                            <input type="text" class="form-control" id="birth_date" placeholder="Enter Birth Date" name="birth_date">
                            <span class="text-danger birth_date_err"></span>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="qualification" class="form-label">Qualification:</label>
                            <input type="text" class="form-control" id="qualification" placeholder="Enter Qualification" name="qualification">
                            <span class="text-danger qualification_err"></span>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
                            <span class="text-danger username_err"></span>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="user_id" class="form-label">User ID:</label>
                            <input type="text" class="form-control" id="user_id" placeholder="Enter User ID" onkeypress="return number_check(event)" maxlength="6" name="user_id">
                            <span class="text-danger user_id_err"></span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                            <span class="text-danger password_err"></span>
                        </div>
                        <div class="d-grid">
                        <button type="submit" class="d-block btn btn-success">Sign up</button>
                        </div>
                        <h5 class="text-center">Already have an Account ? <a href="index.php" class="text-decoration-none">login Here</a></h5>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- body content end -->

<script>

    //check mobile number is number or not
    function number_check(e)
    {
        if(e.keyCode>=48 && e.keyCode<=57)
        {
            return true;
        }
    return false;
    }

    //faculty add
    $(document).ready(function(){

        $("#birth_date").datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth:true,
            yearRange:'1900:2025',
            changeYear:true
        });
        $("#faculty_register").submit(function(e){
            e.preventDefault();
          
            var full_name=$("#full_name").val().trim();
            var mobile_no=$("#mobile_no").val().trim();
            var birth_date=$("#birth_date").val().trim();
            var qualification=$("#qualification").val().trim();
            var username=$("#username").val().trim();
            var user_id=$("#user_id").val().trim();
            var password=$("#password").val().trim();
            var valid=true;

            //full name validation start
            var namepattern=/^[a-zA-Z][a-zA-Z ]+$/;
            if(full_name.length=="")
            {
                $(".full_name_err").text("Please enter Full name");
                $("#full_name").focus();
                valid=false;
            }
            else if(!namepattern.test(full_name))
            {
                $(".full_name_err").text("Full Name not valid");
                $("#full_name").focus();
                valid=false;
            }
            else
            {
                $(".full_name_err").text("");
            }
            //full name validation end

            //mobile_no validation start
            var mobile_nopattern=/^\d{10}$/;
            if(mobile_no.length=="")
            {
                $(".mobile_no_err").text("Please enter Mobile no");
                $("#mobile_no").focus();
                valid=false;
            }
            else if(!mobile_nopattern.test(mobile_no))
            {
                $(".mobile_no_err").text("Mobile no Not valid");
                $("#mobile_no").focus();
                valid=false;
            }
            else
            {
                $(".mobile_no_err").text("");
            }
            //mobile_no validation end

            //birth_date validation start
            var birth_date_pattern=/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/;
            if(birth_date.length=="")
            {
                $(".birth_date_err").text("Please Choose Birth Date");
                $("#birth_date").focus();
                valid=false;
            }
            else if(!birth_date_pattern.test(birth_date))
            {
                $(".birth_date_err").text("Date Format Not valid");
                $("#birth_date").focus();
                valid=false;
            }
            else
            {
                $(".birth_date_err").text("");
            }
            //birth_date validation end

            //qualification validation start
            var qualification_pattern=/^[a-zA-Z][a-zA-Z ]+$/;
            if(qualification.length=="")
            {
                $(".qualification_err").text("Please enter your Qualification");
                $("#qualification").focus();
                valid=false;
            }
            else if(!qualification_pattern.test(qualification))
            {
                $(".qualification_err").text("Qualification format not valid");
                $("#qualification").focus();
                valid=false;
            }
            else
            {
                $(".qualification_err").text("");
            }
            //qualification validation end

             //username validation start
             var username_pattern=/^[a-zA-Z0-9]+$/;
            if(username.length=="")
            {
                $(".username_err").text("Please enter your Username");
                $("#username").focus();
                valid=false;
            }
            else if(!username_pattern.test(username))
            {
                $(".username_err").text("Username format not valid contains alphabets and numbers only");
                $("#username").focus();
                valid=false;
            }
            else
            {
                $(".username_err").text("");
            }


            //username validation end

            //user_id validation start
            var user_id_nopattern=/^\d{6}$/;
            if(user_id.length=="")
            {
                $(".user_id_err").text("Please enter User ID");
                $("#user_id").focus();
                valid=false;
            }
            else if(!user_id_nopattern.test(user_id))
            {
                $(".user_id_err").text("User ID Not valid");
                $("#user_id").focus();
                valid=false;
            }
            else
            {
                $(".user_id_err").text("");
            }
            //user_id validation end

            //password validation start
            var password_pattern=/^[a-zA-Z0-9@$!%*?&]+$/;
            if(password.length=="")
            {
                $(".password_err").text("Please enter your Password");
                $("#password").focus();
                valid=false;
            }
            else if(!password_pattern.test(password))
            {
                $(".password_err").text("Password format Not valid contains only alphabets,numerics and special character");
                $("#password").focus();
                valid=false;
            }
            else
            {
                $(".password_err").text("");
            }
            //password validation end

            if(valid)
            {
                var formdata=new FormData(this);
                formdata.append('cmd','faculty_register');
                $.ajax({
                    url:"backend.php",
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
require_once "footer.php";
?>
<!-- footer content end -->