<?php
    include 'connection.php';
    $id = $_GET['user'];
    $cat = $_GET['cat'];
    $title = $_GET['tit'];
    $publish = $_GET['pub'];
    $url =$_GET['url'];
?>
<!DOCTYPE HTML>
<head>
    <link rel="stylesheet" href="register.css" />
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="lolkittens" />
	<title>Edit</title>
</head>
<body>
    <form method="post" action="blogtable.php">
        <fieldset>
            <h1>Data Update</h1>
            <div class="input-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?php echo "$title" ?>" required />
            </div>
            <div class="input-group">
            <label for="Content">Content</label>
            <textarea id="content" name="content" value="<?php echo "$cat" ?>" required></textarea>
            </div>
            <div class="input-group">
            <label for="url">URL</label>
            <input type="text" name="url" id="url" required value="<?php echo "$url" ?>" />
            </div>
            <div class="input-group">
            <label for="date">Published At</label>
            <input type="datetime-local" name="pdate" id="pdate" value="<?php echo "$publish" ?>" required />
            </div>
            <div class="prefix">
            <label for="category">Category</label>
            <select id="category" name="category" required="true">
                <option value="category" selected></option>
                <option value="lifestyle">Lifestyle</option>
                <option value="Health">health</option>
                <option value="education">Education</option>
                <option value="music">Music</option>
            </select>
            </div>
            <br />
            <div class="upload">
                <label for="image">Image</label>
                <input type="file" value="Upload Image" name="upload"/>
            </div>
            <input type="submit" style="background-color: blue;"  class="btn" name="submit" value="SUBMIT" />
            
        </fieldset>
    </form>
</body>
</html>