<?php
    include("templates/header.html");
    include("templates/navbar.html");

	include("config/db_connection.php");

	$name = $email = $title = $post = "";
	$errors = array("name" => "", "email" => "", "title" => "", "post" => "");

	if (isset($_POST["submit"])) {
        if (empty($_POST["name"])) {
			$errors["name"] = "Name is required";
        } 
        else {
			$name = $_POST["name"];
			if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
				$errors["name"] = "Name must be letters and spaces only";
			}
        }
        
		if (empty($_POST["email"])) {
			$errors["email"] = "An email is required";
        } 
        else {
			$email = $_POST["email"];
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors["email"] = "Email must be a valid email address";
			}
		}

		if (empty($_POST["title"])) {
			$errors["title"] = "A title is required";
        } 
        else {
			$title = $_POST["title"];
			if (!preg_match("/^[a-zA-Z0-9\s+-]+$/", $title)) {
				$errors["title"] = "Title must be letters, spaces and numbers only";
			}
		}

		if (empty($_POST["post"])) {
			$errors["post"] = "Post is required";
        } 
        else {
			$post = $_POST["post"];
			if (!preg_match("/^[a-zA-Z0-9\s\p{P}-]+$/", $post)) {
				$errors["post"] = "post must be letters, spaces and numbers only";
			}
		}

		if (!array_filter($errors)) {
            $name = mysqli_real_escape_string($conn, $_POST["name"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $title = mysqli_real_escape_string($conn, $_POST["title"]);
            $post = mysqli_real_escape_string($conn, $_POST["post"]);
            
            // echo $name . ", " . $email . ", " . $title . ", " . $post;
    
            $sql = "INSERT INTO blogs
            (blog_id, blog_author, blog_author_email, blog_title, blog_body, blog_date) 
            VALUES (
            NULL, 
            '$name', 
            '$email', 
            '$title', 
            '$post', 
            CURRENT_TIMESTAMP
            );";
    
            if (mysqli_query($conn, $sql)) {
                header("Location: index.php");
            } 
            else {
                echo "query error: ". mysqli_error($conn);
            }
        } 
	} 
?>

<div class="container">
    <form class="form-horizontal" action="add_post.php" method="POST">
        <div class="form-group">
            <label class="control-label col-sm-2" for="text">Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name) ?>">
                <span id="error"> <?php echo $errors["name"];?></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email) ?>">
                <span id="error"> <?php echo $errors["email"];?></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="text">Title:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($title) ?>">
                <span id="error"><?php echo $errors["title"];?></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="psta">Post:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="psta" rows="10" name="post"><?php echo htmlspecialchars($post) ?></textarea>
                <span id="error"> <?php echo $errors["post"];?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" name="submit" value="Submit">
            </div>
        </div>
    </form>
</div>

<?php 
    include("templates/footer.html");
?>