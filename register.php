<?php 
	require_once 'core/init.php';	
	if(Input::exists()) {
		if (Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'username' => array(
					'required' => true,
					'min' => 2,
					'max' => 20,
					'uniqe' => 'users'
				),
				'password' => array(
					'required' => true,
					'min' => 6
				),
				'password_again' => array(
					'required' => true,
					'matches' => 'password'	
				),
				'email' => array(
					'required' => true
				)
			));


			if ($validation->passed()) {
				$user = new User();

				$salt = Hash::salt(32);
				
				
					$user->create(array(
						'username' => Input::get('username'),
						'email' => Input::get('email'),
						'password' =>  Hash::make(Input::get('password'), $salt),
						'salt' => $salt,
                        'name' => "",
                        'bio' => "",
						'gender' => "",
						'joined' => date('Y-m-d H:i:s'),
						'group' => 1
					));

                    $login = $user->login(Input::get('username'), Input::get('password'), $remember);

                    if($login){
                        Session::flash('Home', 'Your registration was successful!');
                        Redirect::to('feed.php');
                    }

			}else{

				foreach ($validation->errors() as $error) {
						echo $error . "<br>";
					}	
			}
		}
	}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
    <title>Регистрирай се в Opinonfor.com</title>
    <meta name="description" content="">
    <?php include "/includes/head/meta-default.php"; ?>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <?php include "/includes/head/links.php"; ?>
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
	<?php include "/includes/headers/header-not-logged.php"; ?>

    <section id="form-container">
        <div class="container">
            <header class="center">
                <h1>Безплатна регистрация</h1>
                <h2>Присъединете се към общността на  Opinionfor</h2>
            </header>
            
            <div class="form-wrapper">
                <div class="social-login">
                    <img src="img/temp-facebook-sign-up.png" alt="facebook-sign-up">
                    <img src="img/temp-google-sign-up.png" alt="google-sign-up">

                    <div class="or-separator">
                        <svg version="1.1" x="0px" y="0px"
                             viewBox="0 0 240 10.2" xml:space="preserve">
                        <line stroke-miterlimit="10" x1="0" y1="5.7" x2="100" y2="5.7"/>
                        <line  stroke-miterlimit="10" x1="140" y1="4.7" x2="240" y2="4.7"/>
                        <path d="M120.4,5c0,2.8-1.7,4.3-3.8,4.3c-2.1,0-3.6-1.7-3.6-4.1c0-2.6,1.6-4.2,3.8-4.2C119,0.9,120.4,2.6,120.4,5z
                             M114.1,5.1c0,1.7,0.9,3.3,2.6,3.3c1.7,0,2.6-1.5,2.6-3.4c0-1.6-0.8-3.3-2.6-3.3C115,1.8,114.1,3.4,114.1,5.1z"/>
                        <path  d="M121.7,1.2c0.5-0.1,1.3-0.2,2-0.2c1.1,0,1.8,0.2,2.3,0.7c0.4,0.4,0.6,0.9,0.6,1.5c0,1.1-0.7,1.8-1.5,2.1v0
                            c0.6,0.2,1,0.8,1.2,1.6c0.3,1.1,0.5,1.9,0.6,2.2h-1.1c-0.1-0.2-0.3-0.9-0.5-1.9c-0.2-1.1-0.7-1.5-1.6-1.6h-1v3.5h-1V1.2z
                             M122.8,4.8h1.1c1.1,0,1.8-0.6,1.8-1.5c0-1-0.8-1.5-1.9-1.5c-0.5,0-0.9,0-1,0.1V4.8z"/>
                        </svg>
                    </div>
                </div>

                <form action="" method="post">
                    <fieldset>
                        <div class="form-item">
                            <!-- <div class="error-field">  When error occurs  -->
                                <label for="username">Потребителско име</label>
                                <input type="text" id="username" name="username" autocomplete="off">
                            <!-- </div> -->
                            <p class="error-message">This is required.</p>
                        </div>    
                    </fieldset>

                    <fieldset>
                        <div class="form-item">
                            <label for="email">Е-майл</label>
                            <input type="email" id="email" name="email">
                            <p class="error-message">This is required.</p>
                        </div> 
                    </fieldset>


                    <fieldset>
                        <div class="form-item">
                            <label for="password">Парола</label>
                            <input type="password" id="password" name="password">
                            <p class="error-message">Your password is too short so it won't protect your account very well. Please enter at least 4 characters.</p>
                        </div>
                    </fieldset>


                    <fieldset>
                        <div class="form-item">
                            <label for="password_again">Повторете паролата</label>
                            <input type="password" name="password_again" id="password_again" >
                            <p class="error-message">Your password is too short so it won't protect your account very well. Please enter at least 4 characters.</p>
                        </div>
                    </fieldset>

					<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <input type="submit" class="btn btn-raised" value="Създай акаунт">
                </form>

                <p class="note">
                    By creating an account you agree to the Opinionfor <br> <a href="/terms">Terms of Service</a> and <a href="/privacy">Privacy Policy</a>.
                </p>
            </div>

        </div>
    </section>


	<?php include "/includes/footers/footer.php"; ?>	

	<?php include "/includes/head/bottom-scripts.php"; ?>

</body>
