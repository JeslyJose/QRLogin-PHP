<?php
   include './dbcon.php';
$value = $_POST['val'];


if (isset($value)){
    
    
    
    $sql="SELECT `userid` FROM `qrgenforlogin` WHERE `qrid`='$value' and `status`=1";
     
       $res=$conn->query($sql);
         if($res->num_rows>0)
   {
       while ($row=$res->fetch_assoc())
       {
          $uid=$row['userid'] ;
          echo json_encode(array("userid"=>$uid));
       }
   }
 else {
   echo json_encode(array("userid"=>'failed'));
   }
    
    
 // some action goes here under php
 
}


?>
