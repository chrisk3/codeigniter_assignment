<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CodeIgniter Login/Registration</title>

	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="/ck/codingdojo/codeigniter/assets/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="/ck/codingdojo/codeigniter/assets/css/advanced.css">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

  <script>

      $(document).ready(function() {

            $('.remove').click(function(e) {
                e.preventDefault();
                var answer = confirm("Are you sure you want to delete?");

                if (answer)
                {
                    $(this).parent().submit();
                }
            });

      });

  </script>

</head>
<body>

	   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <h3>CodingDojo Advanced CodeIgniter</h3>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/ck/codingdojo/codeigniter/login/form">Dashboard</a></li>
            <li><a href="/ck/codingdojo/codeigniter/users/edit">Profile</a></li>
            <li><a href="/ck/codingdojo/codeigniter/login/logout">Logout</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>

    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <a class="btn btn-primary btn-small pull-right" href="/ck/codingdojo/codeigniter/users/add">Add New User</a>
          <h3>Manage Users</h3>
          <table class="table">
          	<thead>
          		<tr>
          			<th>ID</th>
          			<th>Name</th>
          			<th>Email</th>
          			<th>Created</th>
          			<th>User Level</th>
          			<th>Actions</th>
          		</tr>
          	</thead>
          	<tbody>
<?php         foreach ($users as $user)
              {
                  echo "<tr>";
                  echo "<td>" . $user->id . "</td>";
                  echo "<td><a href='/ck/codingdojo/codeigniter/users/show/{$user->id}'>" . $user->first_name . ' ' . $user->last_name . "</a></td>";
                  echo "<td>" . $user->email . "</td>";
                  echo "<td>" . $user->created_at . "</td>";
                  echo "<td>" . $user->permission . "</td>";
                  echo "<td><a href='/ck/codingdojo/codeigniter/users/admin_edit/{$user->id}' class='btn btn-link'>edit</a> <form action='/ck/codingdojo/codeigniter/users/remove_user/{$user->id}' method='post'><input type='submit' value='remove' class='remove btn btn-link'></form></td>";
                  echo "</tr>";
              }
?>
          	</tbody>
          </table>
        </div>
      </div>

    </div><!-- /.container -->
	
</body>
</html>