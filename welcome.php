<?php
   include './dbcon.php';
    session_start();
        $sessionphp = $_SESSION['tag'];
     
     $sql="SELECT users.`name` names,users.`email` emailid,users.`mob` mob FROM `users` join qrgenforlogin on qrgenforlogin.userid=users.id WHERE qrgenforlogin.qrid='$sessionphp'";

       $res=$conn->query($sql);
         if($res->num_rows>0)
   {
             
       while ($row=$res->fetch_assoc())
       {
          $Names=$row['names'] ;
         $Email=$row['emailid'] ;
           $mob=$row['mob'] ;
       }
   }
        
        
        ?>


<html>
    <head>
        <title>Welcome</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link href='custom.css' rel='stylesheet' type='text/css'>
    </head>
    <body style="background: #00aabb">

    <div class="container">

            <div class="row">

                <div class="col-lg-8 col-lg-offset-2">

                    <h1> Welcome <?php echo $Names; ?> <a href="#"></a></h1>
                    <br><br>

                    <p class="lead"></p>


                    <form  method="POST"  >

                        <div class="messages"></div>

                        <div class="controls">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_name">Name *</label>
                                        <?php
                                                echo "<input id='form_name' type='text' name='name' class='form-control' value='$Names' readonly ";

                                        ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_lastname">Email</label>
   <?php
                                                echo "<input id='form_name' type='text' name='name' class='form-control' value='$Email' readonly";

                                        ?>                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                          
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_phone">Phone </label>
                                         <?php
                                                echo "<input id='form_name' type='text' name='name' class='form-control' value='$mob' readonly ";

                                        ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                 
                            
                             

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
