<?php 
	if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 2) {
		include("views/admin.php");
	}
	else if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1) {
		include("views/user.php");
	}
?>