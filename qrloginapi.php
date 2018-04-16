<?php

include './dbcon.php';



if(isset($_POST['username']))
{
    $username=$_POST['username'];
$password=$_POST['password'];
$tagid=$_POST["qrtag"];
    
    $sql="SELECT  TIMESTAMPDIFF(MINUTE,`createddate`,now()) as min FROM `qrgenforlogin` WHERE qrid='$tagid' and status=0";
   $res=$conn->query($sql);
   if($res->num_rows>0)
   {
       while ($row=$res->fetch_assoc())
       {
          $min=$row['min'] ;
       }
       
       
       if($min<3)
       {
           
           $sql="SELECT  id,`name`, `email`, `mob` FROM `users` WHERE `username`='$username' and `password`='$password'";
              $res=$conn->query($sql);
   if($res->num_rows>0)
   {
       
      
          
       while ($row=$res->fetch_assoc())
       {
           $Id=$row['id'] ;
        $name=$row['name'] ;
         
           
            $sql="UPDATE `qrgenforlogin` SET userid=$Id,`status`=1,`checkeddate`=now() WHERE `qrid`='$tagid'";
          $result=$conn->query($sql);
          if($result===TRUE)
          {
              $response['status']="Login Success";
             // echo "Updated Succesfully";  
          }
 else {
              echo $conn->error;
 }
             
       }
   }
 else {
        $response['status']="Invalid Credentials";
   }
           
           
       }
 else {
            $response['status']="QR Timeout";
       }
       
   }
   
 else {
      $response['status']="QR Expired";
   }
    
   
   echo json_encode($response);
    
}

?>