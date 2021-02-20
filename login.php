<?php
require_once './connection.php';
session_start();

$login_error = null;

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	header('Location: /employee/dashboard.php');
	exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = htmlentities($_POST['username']);
	$password = htmlentities($_POST['password']);

//       $SQL_CHECK_USER_LOGIN = "SELECT id FROM dhvsu_app WHERE username = '$username' and password = '$password'";
	$SQL_CHECK_USER_LOGIN = "SELECT * FROM time_engine.employee WHERE username = '$username' and password = '$password'";
	$SQL_RESULT = $connection->query($SQL_CHECK_USER_LOGIN);

	if ($SQL_RESULT->num_rows > 0) {
		$profile = $SQL_RESULT->fetch_assoc();
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $username;

		$profile_id = $profile['id'];
		$now = new DateTime();
		$now->setTimezone(new DateTimeZone('Asia/Taipei'));
		$logged_in = $now->format('Y-m-d H:i:s');
		$SQL_ADD_TO_LOGIN_HISTORY = "INSERT INTO time_engine.login_records (employee_id, logged_in_at) VALUES ('$profile_id', '$logged_in')";
		$write_result = $connection->query($SQL_ADD_TO_LOGIN_HISTORY);

		if($write_result) {
			header('Location: /employee/dashboard.php');
			exit();
		} else {
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
			exit();
		}
	}
	else {
		$login_error = 'Invalid email or password.';
	}
}
?>

<?php require_once './sections/header.php' ?>

<main class="login">
	<div class="display-logo">
		<img src="/employee/images/employee.png" alt="" class="logo">
		<h1>Time Engine</h1>
		<p class="subtitle">Your partner in time.</p>
		<p class="register-link">New employee? Go to registration <a href="/employee/register.php">here</a>.</p>
	</div>
	<div class="login-form-container">
		<form action="" method="POST" class="login-form">
			<?php if($login_error != null): ?>
                <p class="error">Invalid email or password.</p>
			<?php endif; ?>
			<label for="username">Username</label>
			<input type="email" name="username" id="username" required/>
			<label for="password">Password</label>
			<input type="password" name="password" id="password" required>
			<button type="submit" class="login">Login</button>
		</form>
	</div>
</main>

<?php require_once './sections/footer.php' ?>
