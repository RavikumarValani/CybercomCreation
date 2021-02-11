<?php
    include 'connection.php';
    
    $user = rand();
    $title = $_POST['title'];
    $url = $_POST['url'];
    $cont = $_POST['content'];
    $mtitle = $_POST['mtitle'];
    $img = $_POST['upload'];
    $publish = $_POST['pdate'];
    $create = $_POST['pdate'];
    $update = $_POST['pdate'];
    
    $duplicate = mysqli_query($con,"select * from category where url='$url'");
    
    $num = mysqli_num_rows($duplicate);
    

    if($num > 0)
    {
        
        echo "<script>
        alert('Already exit.');
        window.location.href='managecat.html';
        </script>";
        
    }
    else
    {
        $sql = "INSERT INTO `category` (`userid`, `title`, `content`, `mtitle`, `image`, `publish`, `createat`, `updateat`) 
               VALUES ('$user', '$title', '$cont', '$mtitle', '$img', '$publish', '$create', '$update')";
               
        $q = mysqli_query($con,$sql);
        
        header("Location:categorydisplay.php");
        die();
        
        
    }
?>
