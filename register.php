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
			<p></p>
		</div>
		<ul >

			<li id="li_1" >
				<label class="description" for="element_1">Personal Information </label>
				<span>
			<input id="first_name" name="first_name" class="element text" maxlength="255" size="14" value=""/>
			<label class="tam">First Name</label>
		</span>

				<span>
			<input id="middle_name" name="middle_name" class="element text" maxlength="255" size="14" value=""/>
		<label class="tam">Middle Name</label>

		</span>

				<span>
			<input id="last_name" name="last_name" class="element text" maxlength="255" size="14" value=""/>
			<label class="tam">Last Name</label>
		</span>

			</li>		<li id="li_2" >
				<label class="description" for="element_2">Email </label>
				<div>
					<input id="email" name="email" class="element text medium" type="email" maxlength="255" value=""/>
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


			</li>		<li id="li_4" >
				<label class="description" for="element_4">Birthday</label>
				<span>
			<input id="b_month" name="b_month" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_4_1">MM</label>
		</span>
				<span>
			<input id="b_day" name="b_day" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_4_2">DD</label>
		</span>
				<span>
	 		<input id="b_year" name="b_year" class="element text" size="4" maxlength="4" value="" type="text">
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

			</li>		<li id="li_5" >
				<label class="description" for="element_5">Mobile Number</label>
				<span>
			<input id="phone" name="phone" class="element text" maxlength="255" size="14" value=""/>
		</span>

			</li>



			<li id="li_1" >
				<label class="description" for="element_1">Password</label>
				<span>
			<input id="password" name="password" class="element text" maxlength="255" size="14" value="" type="password"/>
		<label class="tam">Password</label>

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