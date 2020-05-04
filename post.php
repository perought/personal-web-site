<?php
    include("templates/header.html");
    include("templates/navbar.html");

	include("config/db_connection.php");

	if (isset($_GET["id"])){
		$id = mysqli_real_escape_string($conn, $_GET["id"]);

		$sql = "SELECT * FROM blogs WHERE blog_id = $id";
        $result = mysqli_query($conn, $sql);

		$row = mysqli_fetch_assoc($result);
    }
    
    if (isset($_POST["delete"])){
		$id_to_delete = mysqli_real_escape_string($conn, $_POST["id_to_delete"]);

		$sql = "DELETE FROM blogs WHERE blog_id = $id_to_delete";

		if (mysqli_query($conn, $sql)){
			header("Location: index.php");
        } 
        else {
			echo "query error: " . mysqli_error($conn);
		}

	}
?>

<div class="container mt-3"> 
    <div class="row"> 
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php if ($row) { ?>
                <h2 class="post-title"> <?php echo $row["blog_title"] ?> </h2> 
                <h4 class="post-subtitle"> <?php echo $row["blog_body"] ?> </h4> 
                <p class="post-meta"> 
                    Posted by <a href="#"> <?php echo $row["blog_author"] ?> </a> on <?php echo $row["blog_date"] ?> 
                </p>

                <form action="post.php" method="POST">
				    <input type="hidden" name="id_to_delete" value="<?php echo $row['blog_id']; ?>">
				    <input type="submit" name="delete" value="Delete">
                </form>
            
            <?php } else { ?>
                <h2 class="post-title"> Blog post not found. </h2> 
            <?php } ?>
            <hr>
        </div> 
    </div> 
</div>

<?php 
    include("templates/footer.html");
?>