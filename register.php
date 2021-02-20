<?php
    require_once './connection.php';
    session_start();

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        header('Location: /employee/dashboard.php');
        exit();
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

	$post_new_password = addslashes(htmlentities(($post_new_password)));
	$post_confirm_password = addslashes(htmlentities(($post_confirm_password)));
	$post_birth_day = addslashes(htmlentities(($post_element_4_1)));
	$post_birth_month = addslashes(htmlentities(($post_element_4_2)));
	$post_birth_year = addslashes(htmlentities(($post_element_4_3)));

	$SQL_NEW_PROFILE = "INSERT into time_engine.employee (username, password, first_name, middle_name, last_name, address, barangay, city, province, zip, gender, phone, birth_day, birth_month, birth_year, role) VALUES ('$post_username', '$post_new_password', '$post_first_name', '$post_middle_name', '$post_last_name', '$post_address', '$post_barangay', '$post_city', '$post_province', '$post_zip', '$post_gender', '$post_phone', '$post_birth_day', '$post_birth_month', '$post_birth_year', 'external')";

	$SQL_CHECK_EXIST_PROFILE = "SELECT * FROM time_engine.employee WHERE username = '$post_username'";

	$check_exist = $connection->query($SQL_CHECK_EXIST_PROFILE);

	if($check_exist->num_rows > 0) {
		$error = 'Email is already existing.';
	} else {
		if($post_new_password != $post_confirm_password) {
			$error = 'The passwords do not match.';
		}
		else {
			$result = $connection->query($SQL_NEW_PROFILE);

			if($result) {
				header('Location: /employee/dashboard.php');
			} else {
				$error = 'Server problem';
				print($connection->error);
			}
		}
	}

	print($connection->error);


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

<img id="top" src="top.png" alt="">
<div id="form_container">

	<h1><a>Employee Registration</a></h1>
    <form id="form_16373" class="appnitro"  method="post" action="">
		<div class="form_description">
			<h2>Employee Registration</h2>
            <p class="error"><?=isset($error) ? $error : ""?></p>

            <p></p>
		</div>
		<ul >

			<li id="li_1" >
				<label class="description" for="element_1">Personal Information </label>
				<span>
			<input id="first_name" name="first_name" class="element text" maxlength="255" size="14" value="" required/>
			<label class="tam">First Name</label>
		</span>

				<span>
			<input id="middle_name" name="middle_name" class="element text" maxlength="255" size="14" value=""/>
		<label class="tam">Middle Name</label>

		</span>

				<span>
			<input id="last_name" name="last_name" class="element text" maxlength="255" size="14" value="" required/>
			<label class="tam">Last Name</label>
		</span>

			</li>		<li id="li_2" >
				<label class="description" for="element_2">Email </label>
				<div>
					<input id="usernam" name="username" class="element text medium" type="email" maxlength="255" value="" required/>
				</div>
			</li>		<li id="li_3" >
				<label class="description" for="element_3">Address </label>

				<div>
					<input id="address" name="address" class="element text large" value="" type="text">
					<label for="element_3_1">Street Address</label>
				</div>

				<div>
					<input id="barangay" name="barangay" class="element text large" value="" type="text">
					<label for="element_3_2">Barangay</label>
				</div>

				<div class="left">
					<input id="city" name="city" class="element text medium" value="" type="text">
					<label for="element_3_3">City</label>
				</div>

				<div class="right">
					<input id="province" name="province" class="element text medium" value="" type="text">
					<label for="element_3_4">State / Province / Region</label>
				</div>

				<div class="left">
					<input id="zip" name="zip" class="element text medium" maxlength="15" value="" type="text">
					<label for="element_3_5">Postal / Zip Code</label>
				</div>


			</li>
            <li id="li_4" >
                <label class="description" for="element_4">Birthday</label>
                <span>
			<input id="element_4_1" name="element_4_1" class="element text" size="2" maxlength="2"  type="text"> /
			<label for="element_4_1">MM</label>
		</span>
                <span>
			<input id="element_4_2" name="element_4_2" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_4_2">DD</label>
		</span>
                <span>
	 		<input id="element_4_3" name="element_4_3" class="element text" size="4" maxlength="4" value="" type="text">
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
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
            </li>


            <li id="li_5" >
				<label class="description" for="element_5">Mobile Number</label>
				<span>
			<input id="phone" name="phone" class="element text" maxlength="255" size="14" value=""/>
		</span>

			</li>



			<li id="li_1" >
				<label class="description" for="element_1">Password</label>
				<span>
			<input id="new_password" name="new_password" class="element text" maxlength="255" size="14" value="" type="password" required/>
		<label class="tam">Password</label>

		</span>

				<span>
			<input id="confirm_password" name="confirm_password" class="element text" maxlength="255" size="14" value="" type="password" required/>
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