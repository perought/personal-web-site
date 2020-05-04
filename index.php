<?php
    include("templates/header.html");
    include("templates/navbar.html");

    include("config/db_connection.php");
    
    $sql = "SELECT * FROM blogs";
    $result = mysqli_query($conn, $sql);
?>

<div class="container mt-3"> 
    <div class="row"> 
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="post-preview">
                    <a href="post.php?id=<?php echo $row['blog_id'] ?>"> 
                        <h2 class="post-title"> <?php echo $row["blog_title"] ?> </h2> 
                    </a> 
                    <h4 class="post-subtitle"> <?php echo $row["blog_body"] ?> </h4> 
                    <p class="post-meta"> 
                        Posted by <a href="#"> <?php echo $row["blog_author"] ?> </a> on <?php echo $row["blog_date"] ?> 
                    </p>
                </div>
                <hr>
            <?php } ?>
        </div> 
    </div> 
</div>

<div class="container ml-1"> 
    <nav aria-label="pagination">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled"><a class="page-link" href="#" aria-disabled="true">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
</div>

<?php 
    include("templates/footer.html");
?>
