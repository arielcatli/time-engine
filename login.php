<?php require_once './sections/header.php' ?>

<main class="login">
	<div class="display-logo">
		<img src="/employee/images/employee.png" alt="" class="logo">
		<h1>Time Engine</h1>
		<p class="subtitle">Your partner in time.</p>
		<p class="register-link">New employee? Go to registration <a href="/employee/register.php">here</a>.</p>
	</div>
	<div class="login-form-container">
		<form action="" class="login-form">
			<label for="username">Username</label>
			<input type="email" name="username" id="username" required/>
			<label for="password">Password</label>
			<input type="password" name="password" id="password" required>
			<button type="submit" class="login">Login</button>
		</form>
	</div>
</main>

<?php require_once './sections/footer.php' ?>
