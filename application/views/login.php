<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CodeIgniter Login/Registration</title>
</head>
<body>

	<div>
		<form id="login" action="/ck/codingdojo/codeigniter/login/process_login/" method="post">
			<label>Email: </label>
			<input type="text" name="email">

			<label>Password: </label>
			<input type="password" name="password">

			<input type="hidden" name="action" value="login">
			<input type="submit" value="Login">
		</form>
	</div>

	<div>
		<form id="register" action="/ck/codingdojo/codeigniter/login/process_login/" method="post">
			<label>First Name: </label>
			<input type="text" name="first_name">

			<label>Last Name: </label>
			<input type="text" name="last_name">

			<label>Email: </label>
			<input type="text" name="email">

			<label>Password: </label>
			<input type="password" name="password">

			<label>Confirm Password: </label>
			<input type="text" name="confirm_password">

			<input type="hidden" name="action" value="register">
			<input type="submit" value="Register">
		</form>
	</div>
	
</body>
</html>