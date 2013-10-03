<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CodeIgniter Login/Registration</title>

	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="/ck/codingdojo/codeigniter/assets/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="/ck/codingdojo/codeigniter/assets/css/advanced.css">

</head>
<body>

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <h3>CodingDojo Advanced CodeIgniter</h3>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/ck/codingdojo/codeigniter/welcome">Home</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>

	<div id="login-register">
		<div id="login-form" class="inline-b">
			<h3>Login</h3>
			<form id="login" action="/ck/codingdojo/codeigniter/login/process_login/" method="post">
				<p>Email: <input type="text" name="email" class="form-control"></p>

				<p>Password: <input type="password" name="password" class="form-control"></p>

				<input type="hidden" name="action" value="login">
				<input type="submit" value="Login" class="btn btn-primary">
			</form>
		</div>

		<div id="register-form">
			<h3>Register</h3>
			<form id="register" action="/ck/codingdojo/codeigniter/login/process_registration/" method="post">
				<p>First Name: <input type="text" name="first_name" class="form-control"></p>

				<p>Last Name: <input type="text" name="last_name" class="form-control"></p>

				<p>Email: <input type="text" name="email" class="form-control"></p>

				<p>Password: <input type="password" name="password" class="form-control"></p>

				<p>Confirm Password: <input type="password" name="confirm_password" class="form-control"></p>

				<input type="hidden" name="action" value="register">
				<input type="submit" value="Register" class="btn btn-primary">
			</form>
		</div>
	</div>
	
</body>
</html>