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
        <h3 class="text-center fw-bold">
        <img src="<?=$main_url?>assets/images/logo.png" class="me-4 home-logo">
            Raja's College of Institute and Technology</h3>
    </div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-8">
                <img src="<?=$main_url?>assets/images/college.jpg" class="w-100 home-bg-img img-fluid">
            </div>
            <div class="col-md-4">
                <div class="card border-2 p-2 border-success mycard-border-add">
                    <div class="card-body">
                        <img src="<?=$main_url?>assets/images/avatar.png" class="home-avatar rounded-circle mx-auto d-block">
                    <form action="backend.php" id="faculty_login" method="post" autocomplete="off">
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
                        <input type="hidden" name="cmd" value="fac_login">
                        <div class="d-grid">
                        <button type="submit" class="d-block btn btn-success">Login</button>
                        <p class="text-center">Forget Password ? <a href="forgot_password.php" class="text-decoration-none">Click Here</a></p>
                        </div>
                        <h5 class="text-center">New Registration ? <a href="register.php" class="text-decoration-none">Click Here</a></h5>
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
        $("#faculty_login").submit(function(e){
            e.preventDefault();
          
            var user_id=$("#user_id").val().trim();
            var password=$("#password").val().trim();
            var valid=true;

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
               $(this).unbind("submit");
               $(this).submit();
            }
            


        });
    });
</script>

<!-- footer content start -->
<?php
require_once "footer.php";
?>
<!-- footer content end -->