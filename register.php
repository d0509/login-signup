<?php
  session_start();
  error_reporting(0);
include_once 'connection.php';
if (isset($_SESSION['userid'])) {
    header('location:dashboard.php');
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- /bootstrap css -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <title>Register</title>
        <link rel="stylesheet" href="public/style.css">
    </head>

    <body>
        <div class="container">
            <h1 class="mb-5 mt-5">Register</h1>
            <form action="" method="post">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Enter your name" name="name" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Enter your mail" name="mail" required />
                        <span style="color: red;">
                            <?php if (isset($err_msg)) {
                                echo $err_msg;
                            } else {
                                echo "";
                            } ?>
                        </span>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Enter your password" required />
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Register" name="submit" />
                <span style="color: green;">
                <?php if (isset($msg)) {
                    echo $msg;
                } else {
                    echo "";
                } ?>
            </span>
            </form>
            <h4>Already have an account? <a href="login.php">Login Here!</a></h4>
            
        </div>
        <!-- insert record in the database -->
        <?php
        if(isset($_POST)){
            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            extract($_POST);
            $_SESSION['name'] = $name;
            $sql_ins_users = "insert into users(name,mail,password) values ('$name','$mail','$password')";
            // echo $sql_ins_users;
            try {
                $ans_ins_users = mysqli_query($conn, $sql_ins_users);
                if($ans_ins_users){
                   echo  $msg = "User registered Successfully";
                   header('location:login.php');
                }
              
            } catch (Exception $e) {
             echo  $err_msg = $e->getMessage();
            }
        }
        


        ?>

        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <!--  dropdowns, popovers, or tooltips  -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>


    <?php
}
    ?>
    </body>

    </html>