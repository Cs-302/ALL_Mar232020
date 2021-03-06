
<!DOCTYPE html>
<html>
    <head>
        <title>XYZ Restaurants Reward Page</title>
        <link rel="stylesheet" type="text/css" href="Styling.css">

    </head>
    <body>
    <div class="mainTitle">
        <div class="navbar">
            <img src="XYZCompanyLogo.png">
        </div> 
    </div>
        <div id = "menu">  
            <a href="HomepageLoggedOut.html">Home</a>
            <a href="restaurants.php">Restaurants</a>
            <a href="aboutUs.html">About</a>
            <a href="contactUs.html">Contact</a>
	    <a href="login.php">Login</a>
	    <a href="register.php">Register</a>
        <br>
        <br>
    </div>
    <div class="openMenu" onclick="toggleMenu();">
    <img src="openmenu.png">    
    </div>

  <script>
    function toggleMenu() {
          var x = document.getElementById("menu");
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
        }
    </script>
    </body>
</html>

<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$first_name = $last_name =  $email = $username = $password = $confirm_password = "";
$first_name_err = $last_name_err = $email_err = $username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate first name
    if (empty(trim($_POST["first_name"]))) {
        $first_name_err = "Please enter your first name";
    } else {
        $first_name = trim($_POST["first_name"]);
    }

    // Validate last name
    if (empty(trim($_POST["last_name"]))) {
        $last_name_err = "Please enter your last name";
    } else {
        $last_name = trim($_POST["last_name"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email";
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format";
    }else {
        $email = trim($_POST["email"]);
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, first_name, last_name, email) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_first_name, $param_last_name, $param_email);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: login.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
<link rel ="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
   
 <link rel"stylesheet" href="form.css"> 
<style>
.wrapper{
border-style: solid;
border-color: red;
border-width: 5px;
text-align: center;
margin-left: auto;
margin-right: auto;
padding: 20px;
width: 350px;
}
#special{
padding:5px;
margin: 5px;
-webkit-text-fill-color:white;
-webkit-text-stroke-width:1px;
-webkit-text-stroke-color:black;
color:black;
border: 2px solid lightgrey;
border-radius: 5px;
</style>    
    
</head>
<body>
<div class="wrapper"  >

 <h2>Sign Up</h2>
    <p >Please fill this form to create an account.</p>
     
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"  >
        <div class="form-group"> <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
            <span class="help-block"><?php echo $first_name_err; ?></span>
        </div>
        <div class="form-group"> <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
            <span class="help-block"><?php echo $last_name_err; ?></span>
        </div>
        <div class="form-group"> <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group"> <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group"> <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group"> <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control"
                   value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
            <button  type="submit" class="btn btn-danger" value="Submit">Submit</button>
            <button  type="reset" class="btn btn-danger" value="Reset">Reset</button>
        </div>
        <p id="special" style=" color:black" >Already have an account? <a href="login.php" style:text:black;>Login here</a>.</p>
    </form>
    
   
</div>
</body>
</html>


