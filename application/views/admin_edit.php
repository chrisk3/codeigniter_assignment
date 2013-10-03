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

      <a class="btn btn-primary btn-small pull-right" href="#">Return to Dashboard</a>

      <div id="admin-edit-user">

        <h3>Edit User <?= $users['id'] ?></h3>

        <div id="edit_info">
          <h4>Edit Information</h4>
          <form id="register" <?= "action='/ck/codingdojo/codeigniter/users/update_user/{$users['id']}'" ?> method="post">
            <p>First Name: <input type="text" name="first_name" class="form-control" value="<?= $users['first_name'] ?>"></p>

            <p>Last Name: <input type="text" name="last_name" class="form-control" value="<?= $users['last_name'] ?>"></p>

            <p>Email: <input type="text" name="email" class="form-control" value="<?= $users['email'] ?>"></p>

            <select name="user_level" class="form-control">
              <option value="admin" <?php if ($users['permission'] == 'admin') echo 'selected'; ?>>Admin</option>
              <option value="normal" <?php if ($users['permission'] == 'normal') echo 'selected'; ?>>Normal</option>
            </select>

            <input type="hidden" name="action" value="edit_info">
            <input type="submit" value="Save" class="btn btn-success">
          </form>
        </div>

        <div id="edit_pass">
          <h4>Update Password</h4>
          <form id="register" <?= "action='/ck/codingdojo/codeigniter/users/update_user/{$users['id']}'" ?> method="post">
            <p>Password: <input type="password" name="password" class="form-control"></p>

            <p>Confirm Password: <input type="password" name="confirm_password" class="form-control"></p>

            <input type="hidden" name="action" value="edit_password">
            <input type="submit" value="Update Password" class="btn btn-success">
          </form>
        </div>

      </div>

    </div><!-- /.container -->
  
</body>
</html>