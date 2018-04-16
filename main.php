<?php
include './dbcon.php';
if(isset($_POST["reg"]))
{
     $name=$_POST['name'];

     $email=$_POST['email'];
      $phone=$_POST['phone'];
       $username=$_POST['username'];
       $pass=$_POST['pass'];
       

               
                  $sql="INSERT INTO `users`(`name`, `email`, `username`, `password`,mob) VALUES ('$name','$email','$username','$pass','$phone') ";
                        $res=$conn->query($sql);
                        if($res===TRUE)
                        {
                               echo "<script type='text/javascript'> alert('Succesfully registered')</script>"; 
                               
                             
                        }
 else {
                            echo 'Failed to Insert';
 }
                        
             
}
?>


<html>
    <head>
        <title>Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link href='custom.css' rel='stylesheet' type='text/css'>
    </head>
    <body style="background: #ffcccc">

    <div class="container">

            <div class="row">

                <div class="col-lg-8 col-lg-offset-2">

                    <h1> User Register form <a href="#"></a></h1>
                    <br><br>

                    <p class="lead"></p>


                    <form  method="POST"  >

                        <div class="messages"></div>

                        <div class="controls">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_name">Name *</label>
                                        <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_lastname">Email</label>
                                        <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                           
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_phone">Phone </label>
                                        <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Please enter your phone">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_email">Username </label>
                                        <input id="form_email" type="text" name="username" class="form-control" placeholder="Please enter your username *" required="required" data-error="Valid email is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_phone">Password *</label>
                                        <input id="form_phone" type="password" name="pass" class="form-control" placeholder="Please enter your password" required=="required" >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                            
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-success" value="REGISTER" name="reg" />
                                </div>
                            </div>
                            <a href="index.php">LOGIN WITH QR</a>
                              
                        </div>

                    </form>

                </div><!-- /.8 -->

            </div> <!-- /.row-->

        </div> <!-- /.container-->

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="validator.js"></script>
        <script src="contact.js"></script>
    </body>
</html>
