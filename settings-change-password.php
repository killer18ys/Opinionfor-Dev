<?php 

require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'password_current' => array(
                    'required' => true,
                    'min' => 6
                ),
                'password_new' => array(
                    'required' => true,
                    'min' => 6
                ),
                'password_new_again' => array(
                    'required' => true,
                    'min' => 6,
                    'matches' => 'password_new'
                )
            ));

            if ($validation->passed()) {
                if (Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
                    echo 'Your current password is wrong';
                }else{
                    $salt = Hash::salt(32);
                    $user->update(array(
                        'password' => Hash::make(Input::get('password_new'), $salt),
                        'salt' => $salt
                    ));

                    Session::flash('home', 'Your password has been changed');
                    Redirect::to('index.php');
                }


            }else{
                foreach ($validation->errors() as $error) {
                    echo $error, '<br>';
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
        <title></title>
        <meta name="description" content="">
        <?php include "/includes/head/meta-default.php"; ?>

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    

        <?php include "/includes/head/links.php"; ?>
        
        <link rel="stylesheet" href="css/fancySelect.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->


        <?php include "/includes/headers/header.php";?>   

        <section id="inner-main">
            <div class="container">
                <div class="container-large right">
                    <div id="content">

                        <div class="head-description">
                            <h2>Смяна на парола</h2>
                            
                        </div>
                   
                        <div class="profile-info-wrapper change-password">
                            <form action="" method="post">                                    
                                    <fieldset>
                                        <label for="password_current">Парола</label>
                                        <div class="form-item">
                                            <label for="password_current">Enter your current password</label>
                                            <input type="password" class="light" id="password_current" name="password_current">
                                            <p class="error-message"></p>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <label for="password_new">Нова парола</label>
                                        <div class="form-item">
                                            <label for="password_new">Въведете новата парола</label>
                                            <input type="password" class="light" id="password_new" name="password_new">
                                            <p class="error-message"></p>
                                        </div>
                                    </fieldset>  

                                    <fieldset>
                                        <label for="possword_new_again">Нова парола отново</label>
                                        <div class="form-item">
                                            <label for="possword_new_again">Въведете новата парола отново</label>
                                            <input type="password" class="light" id="possword_new_again" name="possword_new_again">
                                            <p class="error-message"></p>
                                        </div>
                                    </fieldset>   

                                    <div class="buttons-wrapp">
                                        <input type="submit" value="Обновете паролата" id="update_password" class="btn btn-raised large green" >
                                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                    </div>                             
                            </form>   
                        </div>
                    </div>
                </div>

                <div class="container-small left">
                    <nav class="side-nav">
                        <div class="header item">Настройки по акаунта</div>
                        <div class="item clearfix">
                            <a href="./settings-profile.php">Профил</a>
                            <a class="selected" href="./settings-change-password.php">Смяна на парола</a>
                        </div>
                    </nav>
                </div>

            </div>
        </section>
    
        <?php include "/includes/footers/footer.php"; ?>

        <?php include "/includes/head/bottom-scripts.php"; ?>

        <script src="js/vendor/fancySelect.js"></script>
        <script src="js/vendor/jquery.rating.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<!--         <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script> -->
    </body>
</html>
