<?php
	session_start();
	$nav = "<header>";

	if ($_SESSION['loggedIn']){
		$nav = $nav . '<h3>Welcome ' . $_SESSION['fname'] . '! </h3>';


	}
	$nav = $nav ." <ul id = \"navbar\">
			<li><a href=\"index.php\">Home</a></li>
			<li><a href=\"products.php\">Products</a></li>";
	


		if ($_SESSION['loggedIn']) {
			
			$nav =  $nav . "<li><a href=\"cart.php\">Cart</a></li>";
			$nav =  $nav . "<li><a href=\"account.php\">Account</a></li>";
			$nav =  $nav . "<li><a href=\"logout.php\">Log Out</a></li>";

			if ($_SESSION['account_type'] == 'admin'){
				$nav =  $nav . "<li><a href=\"productForm.php\">Add Product</a></li>";
			}

                } else {
			//user is not logged in, so here they have the option to log in
			$nav =  $nav . "<li><a href=\"login.php\">Login</a></li>";
			$nav =  $nav . "<li><a href=\"register.php\">Register</a></li>";
		}
	$nav = $nav . "
				</ul>
			</header>";
	$reg = "/$page/";
	$swap = "$page.php\" id=\"active\"";
	
	$nav = preg_replace($reg, $swap, $nav);
	echo $nav;


?>
