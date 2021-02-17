<?php
    require_once './connection.php';
    session_start();

    if(!(isset($_SESSION['loggedin']))) {
        print(!(isset($_SESSION['loggedin'])));
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
        exit();
    }

//    Get personal records

$user_id = $profile['id'];
$SQL_GET_LOGIN_HISTORY = "SELECT * FROM time_engine.time_records WHERE employee_id = '$user_id'";
$SQL_GET_LOGIN_HISTORY_ADMIN = "SELECT time_engine.employee.first_name, time_engine.employee.middle_name, time_engine.employee.last_name, time_engine.time_records.timed_at, time_engine.time_records.time_type, time_engine.employee.role FROM time_engine.time_records INNER JOIN time_engine.employee ON time_engine.employee.id = time_engine.time_records.employee_id";

$results_records = $connection->query($profile['role'] == 'administrator' ? $SQL_GET_LOGIN_HISTORY_ADMIN : $SQL_GET_LOGIN_HISTORY);
print($connection->error);
$records = array();
while($row = $results_records->fetch_assoc()) {
	$records[] = $row;
}


// Get timed-in people
$SQL_GET_LOGIN_HISTORY_ADMIN_IN = "SELECT * FROM time_engine.employee WHERE time_status = 'in'";
$timed_in_results = $connection->query($SQL_GET_LOGIN_HISTORY_ADMIN_IN);
$in_people = array();
while($row = $timed_in_results->fetch_assoc()) {
    $in_people[] = $row;
}


    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['button-log-out'])) {
            print('I am logging out');
            unset($_SESSION['loggedin']);
            unset($_SESSION['username']);
            $_SESSION = array();
            session_destroy();
            header('Location: /employee/');
            exit();
        }

	    $profile_id = $profile['id'];
	    $now = new DateTime();
	    $now->setTimezone(new DateTimeZone('Asia/Taipei'));
	    $logged_in = $now->format('Y-m-d H:i:s');


        if(isset($_POST['button-time-in'])) {

            $SQL_ADD_TIME_IN = "INSERT INTO time_engine.time_records (employee_id, timed_at, time_type) VALUES ('$profile_id', '$logged_in', 'in')";
            $in_result = $connection->query($SQL_ADD_TIME_IN);

            if($in_result) {

                $SQL_UPDATE_STATUS = "UPDATE time_engine.employee SET time_status = 'in' WHERE id = '$profile_id'";
                $in_update = $connection->query($SQL_UPDATE_STATUS);

                if($in_update) {
	                header('Location: /employee/dashboard.php');
	                exit();
                } else {
	                print($connection->error);
                }

            } else {
                print($connection->error);
//	            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
//	            exit();
            }
        }

	    if(isset($_POST['button-time-out'])) {
		    $SQL_ADD_TIME_OUT = "INSERT INTO time_engine.time_records (employee_id, timed_at, time_type) VALUES ('$profile_id', '$logged_in', 'out')";
		    $out_result = $connection->query($SQL_ADD_TIME_OUT);

		    if($out_result) {

			    $SQL_UPDATE_STATUS = "UPDATE time_engine.employee SET time_status = 'out' WHERE id = '$profile_id'";
			    $out_update = $connection->query($SQL_UPDATE_STATUS);

			    if($out_update) {
				    header('Location: /employee/dashboard.php');
				    exit();
			    } else {
				    print($connection->error);
			    }

		    } else {
			    print($connection->error);
//	            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
//	            exit();
		    }
	    }
    }

?>


<?php require_once './sections/header.php' ?>

<main class="dashboard">
	<div class="profile">
		<div class="clock-control">
			<p class="clock" id="clock-widget">--:--:--</p>
			<p class="date" id="date-widget">February 18, 2020</p>
            <?php if($profile['time_status'] != 'in'): ?>
                <form action="" method="POST">
                    <input type="hidden" name="button-time-in" />
                    <button class="clock-in">Time In</button>
                </form>
            <?php endif; ?>

            <?php if($profile['time_status'] == 'in'): ?>
                <form action="" method="POST">
                    <input type="hidden" name="button-time-out" />
                    <button class="clock-out">Time Out</button>
                </form>
            <?php endif; ?>


            <form action="" method="POST">
                <input type="hidden" name="button-log-out" />
                <button class="log-out">Log Out</button>
            </form>

		</div>
		<div class="information">
			<h1>Profile</h1>

            <p class="label"><?=$profile['role'] == 'administrator' ? "Administrator" : "Name"?></p>
            <p class="name"><?=$profile['first_name']?> <?=$profile['middle_name']?> <?=$profile['last_name']?></p>
            <p class="label">Address</p>
            <p class="address"><?=$profile['address']?>, <?=$profile['barangay']?>, <?=$profile['city']?>, <?=$profile['province']?> <?=$profile['zip']?></p>
            <p class="label">Gender</p>
            <p class="gender"><?=$profile['gender'] == 'M' ? 'Male' : 'Female';?></p>
            <p class="label">Phone Number</p>
            <p class="phone"><?=$profile['phone']?></p>
			<p class="label">Birthday</p>
			<p class="phone"><?=$profile['birth_month']?>-<?=$profile['birth_day']?>-<?=$profile['birth_year']?></p>
			<p class="label">Status</p>
            <?= $profile['time_status'] == 'in' ? "<p class='status-in'>Timed-in</p>" : "<p class='status-out'>Timed-out</p>" ?>
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
            <div class="all-records">
                <h2>All Records</h2>
                <?php foreach ($records as $time_record): ?>
                    <div class="record">
                        <p class="record-time"><?= ($profile['role'] == 'administrator')? "<span class='employee'>" . $time_record['first_name'] . " " . $time_record['middle_name'] . " " . $time_record['last_name'] . "</span>" : "" ?><?= $time_record['time_type'] == 'in' ? "<span class='record-in'>TIME IN</span>":"<span class='record-out'>TIME OUT</span>"?>15:04 February 18, 2020</p>
                    </div>
                <?php endforeach; ?>
            </div>
			<?php if($profile['role'] == 'administrator'): ?>
                <div class="presents">
                    <h2>Currently Timed-in</h2>
                    <?php foreach ($in_people as $person): ?>
                        <div class="record">
                            <p class="record-time"><?=$person['role'] == 'administrator' ? "<span class='employee orange'>Administrator</span>" : "<span class='employee blue'>Employee</span>"?><?=$person['first_name']?> <?=$person['middle_name']?> <?=$person['last_name']?> </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
		</div>
	</div>
</main>
<script src="/employee/clock.js"></script>

<?php require_once './sections/footer.php' ?>

