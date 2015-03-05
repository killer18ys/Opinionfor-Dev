<?php
require_once 'core/init.php';

if(Session::exists('home')){
	echo '<p class="flash-message success">' .Session::flash('home') . '</p>';
}

$user = new User(); // current user
$db = DB::getInstance();
$db->query("SET NAMES utf8");

if ($user->isLoggedIn()) {
	include "includes/feed.php";
}else{
	Redirect::to("register.php");	
}

?>

