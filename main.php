<?php
include './dbcon.php';
if (isset($_POST["reg"])) {
    $name = $_POST['name'];

    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $pass = $_POST['pass'];



    $sql = "INSERT INTO `users`(`name`, `email`, `username`, `password`,mob) VALUES ('$name','$email','$username','$pass','$phone') ";
    $res = $conn->query($sql);
    if ($res === TRUE) {
        echo "<script type='text/javascript'> alert('Succesfully registered')</script>";
    } else {
        echo 'Failed to Insert';
    }
}
?>
<!DOCTYPE html>
<html lang="en" >

    <head>
        <meta charset="UTF-8">
        <title>Sign-Up/Login Form</title>
        <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


        <link rel="stylesheet" href="css/style.css">


    </head>

    <body>
        <div class="form">

            <ul class="tab-group">
                <li class="tab active"><a href="#signup">Sign Up</a></li>
                <li class="tab"><a href="#login">Login using QR</a></li>

            </ul>

            <div class="tab-content">
                <div id="signup">   
                    

                    <form  method="POST"  >

                        <div class="messages"></div>

                        <div class="controls">

                            <div class="row">
                                <div class="field-wrap">
                                    <div>
                                        <label for="form_name">Name *</label>
                                        <input id="form_name" type="text" name="name" class="form-control"  required="required" data-error="Firstname is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="field-wrap">
                                    <div>
                                        <label for="form_lastname">Email *</label>
                                        <input id="form_email" type="email" name="email" class="form-control"  required="required" data-error="Valid email is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="field-wrap">
                                    <div>
                                        <label for="form_phone">Phone *</label>
                                        <input id="form_phone" type="tel" name="phone" class="form-control" >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="field-wrap">
                                    <div>
                                        <label for="form_email">Username *</label>
                                        <input id="form_email" type="text" name="username" class="form-control"  required="required" data-error="Valid email is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="field-wrap">
                                    <div>
                                        <label for="form_phone">Password *</label>
                                        <input id="form_phone" type="password" name="pass" class="form-control"  required=="required" >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div>
                                    <input type="submit" class="btn btn-success" value="REGISTER" name="reg" />
                                </div>
                            </div>


                        </div>

                    </form>

                </div>

                <div id="login">   
                    <center>
                        <?php
                        include './dbcon.php';
                        echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'></script>";
                        $PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;

                        //html PNG location prefix
                        $PNG_WEB_DIR = 'temp/';

                        include "qrlib.php";

                        //ofcourse we need rights to create temp dir
                        if (!file_exists($PNG_TEMP_DIR))
                            mkdir($PNG_TEMP_DIR);


                        $filename = $PNG_TEMP_DIR . 'test.png';




                        $matrixPointSize = 8;
                        if (isset($_REQUEST['size']))
                            $matrixPointSize = min(max((int) 8, 1), 10);





                        $dataqr = str_shuffle(substr("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 0, 8)); //  Encode Data to QR

                        $sql = "INSERT INTO `qrgenforlogin`( `qrid`, `status`, `createddate`) VALUES ('$dataqr',0,now())";
                        $res = $conn->query($sql);

                        //it's very important!
                        if (trim($dataqr) == '')
                            die('data cannot be empty! <a href="?">back</a>');

                        // user data
                        $filename = $PNG_TEMP_DIR . 'test' . md5($dataqr . '|1|' . $matrixPointSize) . '.png';
                        QRcode::png($dataqr, $filename, 1, $matrixPointSize, 2); // QR Geneartion



                        echo '<img src="' . $PNG_WEB_DIR . basename($filename) . '" /><hr/>';

                        echo " <script>
var seconds = 60;
function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = '0' + remainingSeconds;  
    }
    document.getElementById('countdown').innerHTML = remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = 'Buzz Buzz';
    } else {
        seconds--;
    }
}
 
var countdownTimer = setInterval('secondPassed()', 1000);
</script>";
//    echo 'Fetching the response within ';
//    echo '     <span id="countdown" class="timer"></span>';
//    echo ' seconds...';
                        ////////



                        echo "<script type='text/javascript'> function fn60sec() {
       var qrvalue =$dataqr;
    
        console.log(qrvalue);
        $.ajax({
            url:'check.php', //the page containing php script
            type: 'POST', //request type,
            dataType: 'json',
           data: {val: qrvalue},
            success:function(result){

             var final=result.userid;
             if(final!='failed')
             {
                   console.log('Succesfully redirecting');

                  window.location.href='session_page.php?tagid=$dataqr'
             }
           }
         });
    // runs every 60 sec and runs on init.
}
fn60sec();
setInterval(fn60sec, 5*1000); </script> ";
                        ?>

                    </center>
                </div>

            </div>



        </div><!-- tab-content -->

    </div> <!-- /form -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>



    <script  src="js/index.js"></script>




</body>

</html>
