<?php 
	require_once 'core/init.php';

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

                $user->data()->group

				if ($login) {
					Redirect::to('feed.php');
				}
				// else{
				// 	echo "Sorry login failed";  TODO
				// }
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
    <title>Администраторски панел</title>
    <meta name="description" content="">
    <?php include "/includes/head/meta-default.php"; ?>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <?php include "/includes/head/links.php"; ?>
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>

	<section id="form-container" class="sign-in">
        <div class="container">
            <header class="center">
                <h1>Администраторски панел</h1>  
            </header>
            
            <div class="form-wrapper">

                <form action="" method="post" autocomplete="off">
                    <fieldset>
                        <div class="form-item">
                            <label for="username">Потребителско име</label>
                            <input type="text" id="username" name="username" autocomplete="off">
                        </div> 
                    </fieldset>

                    <fieldset>
                        <div class="form-item">
                            <label for="password">Парола</label>
                            <input type="password" id="password" name="password" autocomplete="off">
                        </div>
                    </fieldset>

					
					<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <input type="submit" style="padding:13px 151px 12px;" class="btn btn-raised" value="Влез">


                </form>
            </div>
        </div>
    </section>

	<?php include "/includes/head/bottom-scripts.php"; ?>


</body>


