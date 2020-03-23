<?php
session_start();

$title = "Restaurants";
$greeting = "Welcome!";
$select = "Select a restaurant below to see more details";
$buttonPage = "login.php";
$buttonPrompt = "Log In";
$status = "";

date_default_timezone_set('America/Chicago');

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	$loggedIn = true;
	$title = "Logged In";
	$greeting = "Welcome " . $_SESSION["username"] . "!"; 
	$select = $select . " and to see your discount QR code!";
        $buttonPage = "logout.php";
	$buttonPrompt = "Log Out";
	$status = "You are currently at level: " . $_SESSION["status"];
	$qrData->username = $_SESSION["username"];
	$qrData->time = date("Ymdh");
}

?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="restaurants.css">
    <style type="text/css">
        html, head, body{
            background-color: rgb(225, 66, 52);
            padding: 0;
            margin: 0;
        }
      .footer {
          position: sticky;
          margin-top: 10vh;
          bottom: 0;
          width: 100%;
          padding-top: 1rem;
          padding-bottom: 1rem;
          background-color: black;
          text-align: center;
        }
        .footer h4,h6,h3{
            color: white;
            margin: 0;
            padding: 0;
        }
        .headText{
            text-align: center;
            color: white;
        }
        .center{
            margin-left: auto;
            margin-right: auto;
            width: 8em;
            text-align: center;
            color: white;
        }
    </style>
    <head>
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <div style="background-color:black;text-align:center;">
		<h2 class="headText"><?php echo $greeting; ?></h2>
                <h2 class="headText"><?php echo $status; ?></h2>
		<h2 class="headText"><?php echo $select; ?></h2>
                <?php
                    if($loggedIn === true){
			    echo "<a href=\"" . $buttonPage . "\"><button name=\"button\">" . $buttonPrompt . "</button></a>";
		    } else {
                        echo "<div id = \"menu\" onclick=\"toggleMenu();\">";
                        echo "<a id=\"menuItem\" href=\"HomepageLoggedOut.html\">Home</a>";
                        echo "<a id=\"menuItem\" href=\"restaurants.php\">Restaurants</a>";
                        echo "<a id=\"menuItem\" href=\"aboutUs.html\">About</a>";
                        echo "<a id=\"menuItem\" href=\"contactUs.html\">Contact</a>";
                        echo "<a id=\"menuItem\" href=\"" . $buttonPage . "\">" . $buttonPrompt . "</a>";
                        echo "<a id=\"menuItem\" href=\"register.php\">Register</a>";
                        echo "<br>";
                        echo "<br>";
                        echo "</div>";
                        echo "<div class=\"openMenu\" onclick=\"toggleMenu();\">";
                        echo "<img src=\"openmenu.png\">";
			echo "</div>";
		    }
                ?>
        </div>
        <br>
        <br>
        <div class="fill">
       <table class="center">
           <td></td>
           <td>
                <h2 class="headText">Fine Dining</h2>
           </td>
           <tr>
		<td>
                    <h3 class="center">The Island</h3>
		    <a href="restaurants.php">
                        <?php 
                            if($loggedIn === true) {
				$qrData->restaurantId = "The Island";
                                $qrJson = json_encode($qrData);
				echo '<a class="image-link" href="https://chart.googleapis.com/chart?cht=qr&chs=300x225&chl=', urlencode($qrJson),'">';
			    } 
                        ?>
			    <img src="images/r7.jpg" width="300" height="225" alt="R7"/>
                        </a>
                    </a>
                <td>
                    <h3 class="center">The Tulip</h3>
		    <a href="restaurants.php">
			<?php
                            if($loggedIn === true) {
				$qrData->restaurantId = "The Tulip";				   
                                $qrJson = json_encode($qrData);
                                echo '<a class="image-link" href="https://chart.googleapis.com/chart?cht=qr&chs=300x225&chl=', urlencode($qrJson),'">';
                            } 
                        ?>
			    <img src="images/r2.jpg" width="300" height="225" alt="R2"/>
                        </a>
                    </a>
                </td>
                <td>
                    <h3 class="center">The Depot</h3>
		    <a href="restaurants.php?restaurant=the-depot">
			<?php 
			    if($loggedIn === true) {
				$qrData->restaurantId = "The Depot";
                                $qrJson = json_encode($qrData);
				echo '<a class="image-link" href="https://chart.googleapis.com/chart?cht=qr&chs=300x225&chl=', urlencode($qrJson),'">';
			    } 
                        ?>
			    <img src="images/r3.jpg" width="300" height="225" alt="R3"/>
			</a>
                    </a>
                </td>
           </tr>
           <tr><td></td></tr>
            <tr>
                <td>
                    <h3 class="center">Fresh Garden</h3>
		    <a href="restaurants.php">
			<?php 
			    if($loggedIn === true) {
				$qrData->restaurantId = "Fresh Garden";
                                $qrJson = json_encode($qrData);
				echo '<a class="image-link" href="https://chart.googleapis.com/chart?cht=qr&chs=300x225&chl=', urlencode($qrJson),'">';
			    } 
                        ?>
			    <img src="images/r4.jpg" width="300" height="225" alt="R4"/>
                        </a>
                    </a>
		</td>
                <td>
                    <h3 class="center">The Italian Lane</h3>
		    <a href="restaurants.php">
			<?php 
			    if($loggedIn === true) {
				$qrData->restaurantId = "The Italian Lane";
                                $qrJson = json_encode($qrData);
				echo '<a class="image-link" href="https://chart.googleapis.com/chart?cht=qr&chs=300x225&chl=', urlencode($qrJson),'">';
			    } 
                        ?>
                            <img src="images/r5.jpg" width="300" height="225" alt="R5"/>
                        </a>
                    </a>
		</td>
                <td>
                    <h3 class="center">Waterfront Pizza</h3>
		    <a href="restaurants.php">
			<?php 
			    if($loggedIn === true) {
				$qrData->restaurantId = "Waterfront Pizza";
                                $qrJson = json_encode($qrData);
				echo '<a class="image-link" href="https://chart.googleapis.com/chart?cht=qr&chs=300x225&chl=', urlencode($qrJson),'">';
			    } 
                        ?>
                            <img src="images/r6.jpg" width="300" height="225" alt="R6"/>
                        </a>
                    </a>
		</td>
           </tr>
           <tr><td></td></tr>
           <td></td>
            <td>  <h2 class="headText">Casual Dining</h2></td>
           <tr>
		<td>
                    <h3 class="center">The Central Table</h3>
		    <a href="restaurants.php">
			<?php 
			    if($loggedIn === true) {
				$qrData->restaurantId = "The Central Table";
                                $qrJson = json_encode($qrData);
				echo '<a class="image-link" href="https://chart.googleapis.com/chart?cht=qr&chs=300x225&chl=', urlencode($qrJson),'">';
			    } 
                        ?>
			    <img src="images/r1.jpg" width="300" height="225" alt="R1"/>
                        </a>
                    </a>
		</td>
                <td>
                    <h3 class="center">Hummingbird</h3>
		    <a href="restaurants.php">
			<?php 
			    if($loggedIn === true) {
				$qrData->restaurantId = "Hummingbird";
                                $qrJson = json_encode($qrData);
				echo '<a class="image-link" href="https://chart.googleapis.com/chart?cht=qr&chs=300x225&chl=', urlencode($qrJson),'">';
			    } 
                        ?>
			    <img src="images/r8.jpg" width="300" height="225" alt="R8"/>
                        </a>
                    </a>
		</td>
                <td>
		    <h3 class="center">Fire and Ice</h3>
		    <a href="restaurants.php">
			<?php 
			    if($loggedIn === true) {
				$qrData->restaurantId = "Fire and Ice";
                                $qrJson = json_encode($qrData);
				echo '<a class="image-link" href="https://chart.googleapis.com/chart?cht=qr&chs=300x225&chl=', urlencode($qrJson),'">';
			    } 
                        ?>
		            <img src="images/r9.jpg" width="300" height="225" alt="R9"/>
                        </a>
                    </a>
		</td>
           </tr>
        </table>
        </div>
        <div class="footer">
            <h4>XYZ Company</h4>
            <h6>CS302 Class Project 2020</h6>
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
