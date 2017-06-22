
<?php
function loginlogout()
{ if(isset($_SESSION['Username'])):?>
		<a href="logout.php">Logout</a>
	<?php else: ?>
		<a href="login.php">Login</a>
	<?php endif; ?>
<?php
}
function welcome()
{	if(isset($_SESSION['Username'])):
	$member = $_SESSION['Username'];?>
		<a href="#Member"><?php echo "Welcome $member";?></a>
		<div class="dropdown-content">
			<a href="userProfile.php">User Profile</a>
			<a href="refill.php">Online Refill money</a>
		</div>
	<?php else:?><a href="#Member"><?php echo "Welcome guest";?></a>
	<?php endif; ?>
<?php
}
