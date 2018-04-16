
        <?php
     
      include './dbcon.php';
      echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'></script>";
         $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    

 

    $matrixPointSize = 8;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)8, 1), 10);

    


        
        $dataqr=str_shuffle(substr("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 0,8)); //  Encode Data to QR
        
        $sql="INSERT INTO `qrgenforlogin`( `qrid`, `status`, `createddate`) VALUES ('$dataqr',0,now())";
        $res=$conn->query($sql);
    
        //it's very important!
        if (trim($dataqr) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($dataqr.'|1|'.$matrixPointSize).'.png';
        QRcode::png($dataqr, $filename, 1, $matrixPointSize, 2); // QR Geneartion
        
        

    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  
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
  