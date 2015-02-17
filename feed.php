<?php
require_once 'core/init.php';

if(Session::exists('home')){
	echo '<p>' .Session::flash('home') . '</p>';
}

$user = new User(); // current user

if ($user->isLoggedIn()) {
	include "includes/feed.php";
}else{
	Redirect::to("register.php");	
}

?>

