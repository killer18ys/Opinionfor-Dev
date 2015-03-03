<?php 
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Session::exists('Error')){
    echo '<p>' .Session::flash('Error') . '</p>';
}

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            )
        ));

        if ($validation->passed()) {
            try {
                $user->update(array(
                    'name' => Input::get('name')

                ));

                Session::flash('home', 'Your details have been updated.');
                Redirect::to('feed.php');

            } catch (Exception $e) {
                die($e->getMessage());
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
                            <h2>Настройки по акаунта</h2>
                            <p>Вашата информация и настройки по пофила Ви.</p>
                        </div>
                   
                        <div class="profile-info-wrapper">
                                <div class="clearfix">
                                    <div class="container-small left">
                                        <form action="upload.php" method="post" id="image_upload_form" enctype="multipart/form-data">
                                            <div class="upload-img-wrapper">
                                               <div class="upload-img">
                                                 <?php 
                                                       if ($user->data()->avatar) {
                                                            echo "<img src=\"img/profile_picture/" . $user->data()->avatar . "\" alt=\"Profile_picture\">";
                                                       }else{
                                                            echo "<img src=\"img/profile_picture/profile-placeholder.png\" alt=\"profile_picture\">";
                                                      }
                                                  ?>
                                                </div>
                                                <input id="select_image" type="file" name="imageToUpload">
                                                <span class="btn btn-raised">Upload image</span>
                                        </form>
                                        </div>
                                    </div>

                                    <form action="" method="post">
                                            <div class="container-large right">
                                                <fieldset>
                                                    <label for="name">Име</label>
                                                    <div class="form-item">
                                                        <label for="name">Enter your full name</label>
                                                        <input type="text" class="light" value="<?php echo escape($user->data()->name); ?>" id="name" name="name">
                                                        <p class="error-message"></p>
                                                    </div>
                                                </fieldset>

                                                <fieldset>
                                                    <label for="bio_field">Биография</label>
                                                    <textarea name="bio_field" value="<?php echo escape($user->data()->bio); ?>" id="bio_field"></textarea>
                                                </fieldset>

                                                <fieldset>
                                                    <label for="email">Имейл адрес</label>
                                                    <div class="form-item">
                                                       <label for="email">Имейл адрес</label>
                                                        <input type="email" class="light" value="<?php echo escape($user->data()->email); ?>" id="email" name="email">
                                                       <p class="error-message"></p>
                                                    </div> 
                                                </fieldset>
                                            </div>    
                                        </div>

                                        <div class="clearfix buttons-wrapp">

                                            <div class="container-large right">
                                                <input type="submit" class="btn btn-raised large green right" id="save_changes" value="Save changes">
                                                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                            </div>   
                                        </div>
                                    </form>   
                        </div>
                    </div>
                </div>

                <div class="container-small left">
                    <nav class="side-nav">
                        <div class="header item">Настройки по акаунта</div>
                        <div class="item clearfix">
                            <a class="selected" href="./settings-profile.php">Профил</a>
                            <a href="./settings-change-password.php">Смяна на парола</a>
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
