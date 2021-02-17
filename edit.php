<?php
require_once './connection.php';
session_start();

if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {
	header('Location: /employee/');
	exit();
}

//    Load profile
$username = $_SESSION['username'];
$SQL_GET_PROFILE = "SELECT * FROM time_engine.employee WHERE username = '$username'";
$result = $connection->query($SQL_GET_PROFILE);


if($result->num_rows > 0) {
	$profile = $result->fetch_assoc();
} else {
	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
	extract($_POST, EXTR_PREFIX_ALL, 'post');

	$post_first_name = ucwords(addslashes(htmlentities($post_first_name)));
	$post_middle_name = ucwords(addslashes(htmlentities($post_middle_name)));
	$post_last_name = ucwords(addslashes(htmlentities($post_last_name)));
	$post_address = addslashes(htmlentities($post_address));
	$post_barangay = addslashes(htmlentities($post_barangay));
	$post_city = addslashes(htmlentities($post_city));
	$post_province = addslashes(htmlentities($post_province));
	$post_zip = addslashes(htmlentities($post_zip));
	$post_gender = addslashes(htmlentities($post_gender));
	$post_phone = addslashes(htmlentities($post_phone));

	$post_birth_day = addslashes(htmlentities(($post_element_4_1)));
	$post_birth_month = addslashes(htmlentities(($post_element_4_2)));
	$post_birth_year = addslashes(htmlentities(($post_element_4_3)));

	$post_old_password = addslashes(htmlentities(($post_old_password)));
	$post_new_password = addslashes(htmlentities(($post_new_password)));
	$post_confirm_password = addslashes(htmlentities(($post_confirm_password)));


	$username = $_SESSION['username'];
	$SQL_UPDATE = "UPDATE time_engine.employee SET first_name = '$post_first_name', middle_name = '$post_middle_name', last_name = '$post_last_name', address = '$post_address', barangay = '$post_barangay', city = '$post_city', province = '$post_province', zip = '$post_zip', gender = '$post_gender', phone = '$post_phone', birth_day = '$post_birth_day', birth_month = '$post_birth_month', birth_year = '$post_birth_year' WHERE username = '$username'";




//        update password
	if ($post_old_password != "") {
		$error = "";
		$message_password = "";

		if ($post_new_password != $post_confirm_password) {
			$error = "Passwords do not match.";
		}

		if($post_old_password != $profile['password']) {

			$error = "Incorrect old password.";
		}

		if(($post_old_password == $profile['password']) && ($post_new_password == $post_confirm_password)) {
			$username = $profile['username'];
			$SQL_UPDATE_PASSWORD = "UPDATE time_engine.employee SET password = '$post_new_password' WHERE username = '$username'";
			$password_result = $connection->query($SQL_UPDATE_PASSWORD);

			if ($password_result) {
				$message_password = 'Password updated.';
			} else {
				echo $connection->error;
			}
		}
	}

	$result = $connection->query($SQL_UPDATE);

	if($result) {
		$message = "Profile updated.";
	} else {
		echo $connection->error;
	}

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Time Engine | Employee Registration</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./form/view.css" media="all">
	<script type="text/javascript" src="./form/view.js"></script>
	<script type="text/javascript" src="./form/calendar.js"></script>
</head>
<body id="main_body" >

<img id="top" src="/employee/form/top.png" alt="">
<div id="form_container">

	<h1><a>Employee Registration</a></h1>
	<form id="form_16373" class="appnitro"  method="post" action="">
		<div class="form_description">
			<h2>Edit Profile</h2>
			<?=isset($message) ? $message : ""?>
			<?=isset($message_password) ? $message_password : ""?>
			<?=isset($error) ? $error : ""?>
			<p></p>
			<a href="/employee/dashboard.php" class="back">< Back to profile</a>

		</div>
		<ul >

			<li id="li_1" >
				<label class="description" for="element_1">Personal Information </label>
				<span>
			<input id="first_name" name="first_name" class="element text" maxlength="255" size="14"  value="<?=$profile['first_name']?>" />
			<label class="tam">First Name</label>
		</span>

				<span>
			<input id="middle_name" name="middle_name" class="element text" maxlength="255" size="14"  value="<?=$profile['middle_name']?>" />
		<label class="tam">Middle Name</label>

		</span>

				<span>
			<input id="last_name" name="last_name" class="element text" maxlength="255" size="14"  value="<?=$profile['last_name']?>" />
			<label class="tam">Last Name</label>
		</span>

			</li>		<li id="li_2" >
				<label class="description" for="element_2">Email </label>
				<div>
					<input id="usernam" name="username" class="element text medium" type="email" maxlength="255"  value="<?=$profile['username']?>" disabled />
				</div>
			</li>		<li id="li_3" >
				<label class="description" for="element_3">Address </label>

				<div>
					<input id="address" name="address" class="element text large"  value="<?=$profile['address']?>" type="text">
					<label for="element_3_1">Street Address</label>
				</div>

				<div>
					<input id="barangay" name="barangay" class="element text large"  value="<?=$profile['barangay']?>" type="text">
					<label for="element_3_2">Barangay</label>
				</div>

				<div class="left">
					<input id="city" name="city" class="element text medium"  value="<?=$profile['city']?>" type="text">
					<label for="element_3_3">City</label>
				</div>

				<div class="right">
					<input id="province" name="province" class="element text medium"  value="<?=$profile['province']?>"  type="text">
					<label for="element_3_4">State / Province / Region</label>
				</div>

				<div class="left">
					<input id="zip" name="zip" class="element text medium" maxlength="15"  value="<?=$profile['zip']?>"  type="text">
					<label for="element_3_5">Postal / Zip Code</label>
				</div>


			</li>
            <li id="li_4" >
                <label class="description" for="element_4">Birthday</label>
                <span>
			<input id="element_4_1" name="element_4_1" class="element text" size="2" maxlength="2" value="<?=$profile['birth_month']?>" type="text"> /
			<label for="element_4_1">MM</label>
		</span>
                <span>
			<input id="element_4_2" name="element_4_2" class="element text" size="2" maxlength="2" value="<?=$profile['birth_day']?>" type="text"> /
			<label for="element_4_2">DD</label>
		</span>
                <span>
	 		<input id="element_4_3" name="element_4_3" class="element text" size="4" maxlength="4" value="<?=$profile['birth_year']?>" type="text">
			<label for="element_4_3">YYYY</label>
		</span>

                <span id="calendar_4">
			<img id="cal_img_4" class="datepicker" src="./form/calendar.gif" alt="Pick a date.">
		</span>
                <script type="text/javascript">
                    Calendar.setup({
                        inputField	 : "element_4_3",
                        baseField    : "element_4",
                        displayArea  : "calendar_4",
                        button		 : "cal_img_4",
                        ifFormat	 : "%B %e, %Y",
                        onSelect	 : selectDate
                    });
                </script>

            </li>
			<li id="li_2" >
				<label class="description" for="element_2">Gender</label>
				<div>
					<select name="gender" id="gender">
						<option value="M" <?= $profile['gender'] == 'M' ? 'selected' : '' ?>>Male</option>
						<option value="F" <?= $profile['gender'] == 'F' ? 'selected' : '' ?>>Female</option>
					</select>
				</div>
			</li>


			<li id="li_5" >
				<label class="description" for="element_5">Mobile Number</label>
				<span>
			<input id="phone" name="phone" class="element text" maxlength="255" size="14" value="<?=$profile['phone']?>" />
		</span>

			</li>



			<li id="li_1" >



				<label class="description" for="element_1">Password</label>
				<span>
			<input id="old_password" name="old_password" class="element text" maxlength="255" size="14" value="" type="password"/>
		<label class="tam">Old Password</label>

		</span>
				<span>
			<input id="new_password" name="new_password" class="element text" maxlength="255" size="14" value="" type="password"/>
		<label class="tam">New Password</label>

		</span>

				<span>
			<input id="confirm_password" name="confirm_password" class="element text" maxlength="255" size="14" value="" type="password"/>
			<label class="tam">Confirm Password</label>
		</span>


			</li>

			<li class="buttons">
				<input type="hidden" name="form_id" value="16373" />

				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
			</li>

		</ul>
	</form>

</div>
<img id="bottom" src="bottom.png" alt="">
</body>
</html>

