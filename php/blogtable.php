<?php
    include 'connection.php';
    
    $user = rand();
    $title = $_POST['title'];
    $url = $_POST['url'];
    $cont = $_POST['content'];
    $cat = $_POST['category'];
    $img = $_POST['upload'];
    $publish = $_POST['pdate'];
    $create = $_POST['pdate'];
    $update = $_POST['pdate'];
    
    $duplicate = mysqli_query($con,"select * from blog where url='$url'");
    
    $num = mysqli_num_rows($duplicate);
    

    if($num > 0)
    {
        
        echo "<script>
        alert('Already exit.');
        window.location.href='blog.html';
        </script>";
        
    }
    else
    {
        $sql = "INSERT INTO `blog` (`userid`, `title`, `content`, `category`, `image`, `publish`, `createat`, `updateat`) 
               VALUES ('$user', '$title', '$cont', '$cat', '$img', '$publish', '$create', '$update')";
               
        $q = mysqli_query($con,$sql);
        
        header("Location:blogdisplay.php");
        die();
        
        
    }
?>