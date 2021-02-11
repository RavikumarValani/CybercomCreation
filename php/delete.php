<?php
    include 'connection.php';
    
    $user = $_GET['user'];
    
    $sql = mysqli_query($con,"delete from blog where userid='$user'");
    
    if($sql)
    {
        echo "<script>
        alert('Data Deleted.');
        window.location.href='blogdisplay.php';
        </script>";
    }
    else
    {
          echo "<script>
        alert('Failed to delete Record.');
        window.location.href='blogdisplay.php';
        </script>";
    }
?>