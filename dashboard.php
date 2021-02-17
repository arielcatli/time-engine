<?php require_once './sections/header.php' ?>

<main class="dashboard">
	<div class="profile">
		<div class="clock-control">
			<p class="clock" id="clock-widget">--:--:--</p>
			<p class="date" id="date-widget">February 18, 2020</p>
			<button class="clock-in">Time In</button>
			<button class="clock-out">Time Out</button>
		</div>
		<div class="information">
			<h1>Profile</h1>
			<p class="label">Name</p>
			<p class="name">Jennifer Tugonon Reyes</p>
			<p class="label">Address</p>
			<p class="address">Mendiola Heights, Tuguegarrao City</p>
			<p class="label">Gender</p>
			<p class="gender">Female</p>
			<p class="label">Phone Number</p>
			<p class="phone">+5512124554154</p>
			<p class="label">Birthday</p>
			<p class="phone">05-14-1995</p>
			<p class="label">Status</p>
			<p class="status-in">Logged-in</p>
			<p class="status-out">Logged-out</p>
			<button class="clock-in" onclick="location.href = '/employee/edit.php';">Edit Profile</button>
<!--			<form action="" method="POST">-->
<!--				<input type="hidden" name="logout" value="true">-->
<!--				<button>Logout</button>-->
<!--			</form>-->
<!--			<button onclick="location.href = '/app/edit.php';">Edit Profile</button>-->
		</div>
	</div>
	<div class="time-history">
		<h1>Records</h1>
		<div class="records-container">
			<div class="record">
				<p class="record-time"><span class="employee">Maya Angelou</span><span class="record-in">TIME IN</span>15:04 February 18, 2020</p>
			</div>

			<div class="record">
				<p class="record-time"><span class="employee">Maya Angelou</span><span class="record-out">TIME OUT</span>17:04 February 18, 2020</p>
			</div>

			<div class="record">
				<p class="record-time"><span class="record-in">TIME IN</span>15:04 February 18, 2020</p>
			</div>

			<div class="record">
				<p class="record-time"><span class="record-out">TIME OUT</span>17:04 February 18, 2020</p>
			</div>

			<div class="record">
				<p class="record-time"><span class="record-in">TIME IN</span>15:04 February 18, 2020</p>
			</div>

			<div class="record">
				<p class="record-time"><span class="record-out">TIME OUT</span>17:04 February 18, 2020</p>
			</div>

			<div class="record">
				<p class="record-time"><span class="record-in">TIME IN</span>15:04 February 18, 2020</p>
			</div>

			<div class="record">
				<p class="record-time"><span class="record-out">TIME OUT</span>17:04 February 18, 2020</p>
			</div>

			<div class="record">
				<p class="record-time"><span class="record-in">TIME IN</span>15:04 February 18, 2020</p>
			</div>

			<div class="record">
				<p class="record-time"><span class="record-out">TIME OUT</span>17:04 February 18, 2020</p>
			</div>

			<div class="record">
				<p class="record-time"><span class="record-in">TIME IN</span>15:04 February 18, 2020</p>
			</div>

			<div class="record">
				<p class="record-time"><span class="record-out">TIME OUT</span>17:04 February 18, 2020</p>
			</div>

			<div class="record">
				<p class="record-time"><span class="record-in">TIME IN</span>15:04 February 18, 2020</p>
			</div>

			<div class="record">
				<p class="record-time"><span class="record-out">TIME OUT</span>17:04 February 18, 2020</p>
			</div>
		</div>
	</div>
</main>
<script src="/employee/clock.js"></script>

<?php require_once './sections/footer.php' ?>

