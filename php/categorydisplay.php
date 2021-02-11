
<!DOCTYPE HTML>
<head>
    <link rel="stylesheet" href="category.css" />
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="lolkittens" />
	<title>Category</title>
    <style>
    a{
        color: black;
        text-decoration: underline;
        margin: 2px;
    }
    </style>
</head>
<body>
    <div class="section">
        <div class="sc1">
             <a class="sc1" href="managecat.html">Manage category</a>
        </div>
        <div class="sc1">
             <a class="sc2" href="#">My profile</a>
        </div>
        <div class="sc1">
             <a class="sc3" href="login.html">Log Out</a>
        </div>      
    </div>
    <h1>Blog Post</h1>
    <a class="sc4" href="blog.html">Add Blog Post</a>
    <table>
        <tr>
            <th>Post Id</th>
            <th>Category Name</th>
            <th>Title</th>
            <th>Published Date</th>
            <th>Action</th>
        </tr>
        <?php
        error_reporting(0);
    include 'connection.php';
    $qr = "select * from blog";
    $data = mysqli_query($con,$qr);
    $total = mysqli_num_rows($data);
    
    if($total != 0)
    {
        while($result = mysqli_fetch_assoc($data))
        {
            echo "
            <tr>
                <td>".$result['userid']."</td>
                <td>".$result['category']."</td>
                <td>".$result['title']."</td>
                <td>".$result['publish']."</td>
                <td>
                    <a href = 'edit.php?user=$result[userid]&cat=$result[category]&tit=$result[title]&pub=$result[publish]&
                                url=$result[url]'>Edit 
                    <a href = 'delete.php?user=$result[userid]'>Delete
                </td>
                
            </tr>
            ";
        }
    }
?>
    </table>
</body>
</html>

