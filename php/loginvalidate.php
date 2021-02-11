<?php
    include 'connection.php';
    
    $enter_email = $_POST['email'];
    $enter_pass = $_POST['pwd'];
    
    $dup1 = mysqli_query($con,"select * from user where email='$enter_email'");
    
    $num1 = mysqli_num_rows($dup1);
    
    $dup2 = mysqli_query($con,"select * from user where password='$enter_pass'");
    
    $num2 = mysqli_num_rows($dup2);
    
    echo $num2;
    
    if($num1 == 1 && $num2 > 0)
    {
    
         header("Location:blogdisplay.php");
         die();
    }
    else
    {
        echo "<script>
        alert('Invalid details');
        window.location.href='login.html';
        </script>";
    }
?>