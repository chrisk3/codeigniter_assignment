codeigniter_assignment
======================

A simple application to learn CodeIgniter. Includes login/registration, user management, and a Facebook-esque "wall" component.

To Do Items:
<ol>
<li>Fix bug where the last remaining admin could remove admin status on himself, resulting in no admins.</li>
<li>Fix issues with URL paths (.htaccess)</li>
<li>Fix update_user() function where an admin updating the info of a normal user sets their session data to "normal", effectively preventing them from performing admin tasks (first try to replicate because I didn't encounter this myself).</li>
<li>Fix login issues where first and last name fields can contain spaces (currently only alpha chars supported)</li>
<li>Look into the is_unique form validation parameter for checking if email is already registered</li>
<li>Improve password encryption (pw field in database needs varchar(255)</li>
</ol>
