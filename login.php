<?php
session_start();

include_once 'connection.php';
// print_r($_SESSION);
if (isset($_SESSION['userid'])) {
    header('location:dashboard.php');
} else {


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="public/style.css">
    </head>

    <body>

        <div class="container">
            <h1 class="mt-5 mb-5">Login</h1>
            <form action="" method="post">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Enter your mail" name="mail" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Enter your password" required />
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Register" name="submit" />
            </form>
            <h3> Don't have an Account? <a href="register.php">Register Here!</a></h3>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            echo "<pre>";
            // print_r($_POST);
            echo "</pre>";
            extract($_POST);
            $_SESSION['mail'] = $mail;
            $get_id = "select id from users where mail='$mail' and password='$password' and  is_deleted = 0";
            // echo $get_id;
            echo "<br>";
            $ans_id = mysqli_query($conn, $get_id);
            if ($ans_id->num_rows > 0) {
                while ($row = $ans_id->fetch_assoc()) {
                    $user_id = $row['id'];
                    echo "<br>";
                    $ins_login_id = "insert into login_histories (user_id) values ($user_id)";
                    // echo $ins_login_id;
                    $inserted_id = mysqli_query($conn, $ins_login_id);
                    echo "<br>";
                    // echo "Entred into login_histories";
                    echo "<br>";
                    $_SESSION['userid'] = $row['id'];
                    header('location:dashboard.php');
                }
            }
            // print_r($_SESSION);

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