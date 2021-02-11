<?php
    include 'connection.php';
    
    $prefix = $_GET['select'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $email = $_GET['email'];
    $no = $_GET['mobileno'];
    $pwd = $_GET['pwd'];
    $cpwd = $_GET['cpwd'];
    $infor = $info;
    
    if($pwd != $cpwd)
    {
        echo "<script>
        alert('Password not match');
        </script>";
    }
    
    $duplicate = mysqli_query($con,"select email from user where email='$email'");
    
    $num = mysqli_num_rows($duplicate);
    

    if($num > 0)
    {
        echo "<script>
        alert('Already register.');
        window.location.href='register.html';
        </script>";
    }
    else
    {
        $sql = "INSERT INTO `user` (`prefix`, `fname`, `lname`, `email`, `password`, `mobile`, `info`, `login`, `createat`, `updatrat`) 
               VALUES ('$prefix','$fname','$lname','$email','$pwd','$no','$infor','2/10/1999','2/10/1999','2/10/1999')";
               
        $q = mysqli_query($con,$sql);
        
        header("Location:login.html");
        die();
        
    }
    
?> 
