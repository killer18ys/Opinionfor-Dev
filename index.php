<?php
require_once 'core/init.php';

$user = new User(); // current user

if ($user->isLoggedIn()) {
	// if ($user->hasPermission('admin')) {
	// 	echo '<p>You are administrator</p>';  TODO
	// }

	Redirect::to('feed.php');

}else{
	if (Input::exists()) {
		if (Token::check(Input::get('token'))) {
			
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'username' => array(
					'require' => true,
					'min' => 2,
					'max' => 20					
				),
				'password' => array(
					'require' => true,
					'min' => 6
				)
			));

			if ($validation->passed()) {
				
				$user = new User();

				$remember = (Input::get('remember') === 'on') ? true : false;
				$login = $user->login(Input::get('username'), Input::get('password'), $remember);

				if ($login) {
					Redirect::to('feed.php');
				}
				// else{
				// 	echo "Sorry login failed";  TODO
				// }
			}

		}
	}
	include 'includes/index.php';
}


?>

<!-- 
	<p>Hello <a href="profile.php?user=<?php echo escape($user->data()->username) ?>"><?php echo escape($user->data()->username);?></a>!</p>
	<ul>
		<li><a href="logout.php">Log out</a></li>
		<li><a href="update.php">Update detailes</a></li>
		<li><a href="changepassword.php">Change password</a></li>
		<li><a href="give-opinion.php">Give opinion</a></li>
	</ul> -->