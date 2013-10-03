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
<?php $session = $this->session->all_userdata(); ?>

	<div id="wrapper">

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

	    	<div id="user_info">
				<h3><?= $user['first_name'] . " " . $user['last_name']; ?></h3>

				<ul>
					<li>Registered At:</li>
					<li>User ID:</li>
					<li>Email Address:</li>
					<li>Description:</li>
				</ul>

				<ul>
					<li><?= date('F j, Y', strtotime($user['created_at'])); ?></li>
					<li>#<?= $user['id']; ?></li>
					<li><?= $user['email']; ?></li>
					<li><?= $user['description']; ?></li>
				</ul>

			</div>

			<div id="content">

				<div id="message_box">
					<h4>Leave a Message for <?= $user['first_name']; ?></h4>
					<form action="/ck/codingdojo/codeigniter/users/message" method="post">
						<textarea name="post_message" cols="100" rows="3" placeholder="Post your message here"></textarea>
						<input type="hidden" name="user_id" value=<?= "'{$user['id']}'"; ?>>
						<input type="hidden" name="poster_user_id" value=<?= "'{$session['id']}'"; ?>>
						<input type="submit" value="Post a Message" class="btn btn-success">
					</form>
					
				</div>

				<div id="display_messages">

<?php 			foreach ($messages as $message)
				{
?>
					<div class="message_container">
						<h5 class='inline-b heavy'><?= $message['first_name'] . " " . $message['last_name']; ?> wrote</h5><span class="pull-right italic">
<?php 
							$created = strtotime($message['created_at']);
							$now = time();
							$diff = $now - $created;

							if ($diff < 3600)
								echo intval(date('i', $diff)) . " minutes ago";
							else if ($diff < 86400)
								echo round($diff / 60 / 60, 0) . " hours ago";
							else
								echo date('F j, Y', $created);
?>
						</span>

						<div class='message'>
							<p><?= $message['message']; ?></p>
						</div>

						<div class="comment">
<?php
						foreach ($comments as $comment)
						{
							if ($comment['message_id'] == $message['id'])
							{
?>
							<h5 class='inline-b heavy'><?= $comment['first_name'] . " " . $comment['last_name']; ?> wrote</h5><span class="pull-right italic">
<?php 
								$created = strtotime($comment['created_at']);
								$now = time();
								$diff = $now - $created;

								if ($diff < 3600)
									echo intval(date('i', $diff)) . " minutes ago";
								else if ($diff < 86400)
									echo round($diff / 60 / 60, 0) . " hours ago";
								else
									echo date('F j, Y', $created);
?>
							</span>

							<div class='comment'>
								<p><?= $comment['comment']; ?></p>
							</div>
<?php						} 
					}

?>
						</div>

						<div class="comment">
							<h5 class="heavy">Post a Comment</h5><form action='/ck/codingdojo/codeigniter/users/comment' method='post'>
							<input type="hidden" name="profile_user_id" value=<?= "{$user['id']}" ?>>
							<input type="hidden" name="comment_message_id" value=<?= "'{$message['id']}'"; ?>>
							<input type='hidden' name='comment_poster_user_id' value=<?= "'{$session['id']}'"; ?>>
							<textarea name='post_comment' cols='93' rows='3' placeholder='Post your comment here'></textarea>
							<input type='submit' value='Post a Comment' class='btn btn-success'></form>
						</div>
					</div>

<?php 			}
?>
				</div>

			</div>

		</div>

	   </div>
	
</body>
</html>