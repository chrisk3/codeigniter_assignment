<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CodeIgniter Login/Registration</title>

  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="/ck/codingdojo/codeigniter/assets/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="/ck/codingdojo/codeigniter/assets/css/advanced.css">

  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <h3>CodingDojo Advanced CodeIgniter</h3>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/ck/codingdojo/codeigniter/dashboard">Dashboard</a></li>
            <li><a href="/ck/codingdojo/codeigniter/users/edit">Profile</a></li>
            <li><a href="/ck/codingdojo/codeigniter/login/logout">Logout</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>

    <div class="container">
<?php $session = $this->session->all_userdata(); ?>
      <div id="edit-user">

        <h3>Edit Profile</h3>

        <div id="edit_info">
          <h4>Edit Information</h4>
          <form id="register" <?= "action='/ck/codingdojo/codeigniter/users/update_user/{$session['id']}'" ?> method="post">
            <p>Email: <input type="text" name="email" class="form-control" value=<?= "'{$session['email']}'"; ?>></p>

            <p>First Name: <input type="text" name="first_name" class="form-control" value=<?= "'{$session['first_name']}'"; ?>></p>

            <p>Last Name: <input type="text" name="last_name" class="form-control" value=<?= "'{$session['last_name']}'"; ?>></p>

            <input type="hidden" name="action" value="edit_info">
            <input type="submit" value="Save" class="btn btn-success">
          </form>
        </div>

        <div id="edit_pass">
          <h4>Update Password</h4>
          <form id="register" <?= "action='/ck/codingdojo/codeigniter/users/update_user/{$session['id']}'" ?> method="post">
            <p>Password: <input type="password" name="password" class="form-control"></p>

            <p>Confirm Password: <input type="password" name="confirm_password" class="form-control"></p>

            <input type="hidden" name="action" value="edit_password">
            <input type="submit" value="Update Password" class="btn btn-success">
          </form>
        </div>

        <div id="edit_desc">
          <h4>Edit Description</h4>
          <form id="register" <?= "action='/ck/codingdojo/codeigniter/users/update_user/{$session['id']}'" ?> method="post">
            <textarea class="form-control" name="description" rows="5" cols="100"><?= "{$session['description']}"; ?></textarea>

            <input type="hidden" name="action" value="edit_desc">
            <input type="submit" value="Save" class="btn btn-success">
          </form>
        </div>

      </div>

    </div><!-- /.container -->
  
</body>
</html>