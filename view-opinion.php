<?php 
require_once 'core/init.php';

$user = new User();
$db = DB::getInstance();
$db->query("SET NAMES utf8");

if(!$user->isLoggedIn()){
    Redirect::to('register.php');
}


?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
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

                <div class="container-small left">
                    <nav class="side-nav">
                        <div class="header item">Навигация</div>
                        <div class="item clearfix">
                            <a href="./feed.php">Мнения</a>
                            <a href="./give-opinion.php">Сподели мнение</a>
                            <a class="selected" href="./view-opinion.php">Потърси мнения</a>
                        </div>                        
                    </nav>
                </div>

                <div class="container-middle left">
                    <form action="" method="POST" class="search-wrapper">
                        <fieldset>
                            <div class="form-item">
                                <label for="search-field">Търси</label>
                                <input type="text" id="search-field" name="search-field">
                                <input type="submit" class="btn btn-raised" id="search-btn" value="Търси" >
                                <!-- <p class="error-message">This is required.</p> -->
                            </div> 
                        </fieldset>
                    </form>

                    <?php 
                        $search = Input::get("search-field");
                        $query_string = "SELECT * FROM opinions WHERE category LIKE '%" . $search . "%' OR name LIKE '%". $search ."%'";

                        $opinions = $db->query($query_string)->results();
                      
                        if (!$search || !$opinions){
                            echo  "<div class=\"center\">
                                    <h3 class=\"no-results\">Няма резултати</h3>
                                </div>";
                        }
                        else{
                            echo "<div id=\"opinions-feed-wrapper clearfix\">";

                            foreach ($opinions as $opinion) {
                                $user_info = $db->get("users", array("id", "=", $opinion->user_id))->first();

                                $rating = ($opinion->q1 + $opinion->q2 + $opinion->q3 + $opinion->q4 + $opinion->q5)/5;
                                $rating = round($rating, 0, PHP_ROUND_HALF_UP);
                                $stars_off = 5 - $rating;

                                $post_date = split(" ", $opinion->post_date)[0];
                                $post_time = split(" ", $opinion->post_date)[1];
                                $post_date = split("-", $post_date);
                                $post_date = $post_date[2] .'.' . $post_date[1] . '.' .$post_date[0];
                                $avatar = $user_info->avatar ? $user_info->avatar : "profile-placeholder.png" ;
                                
                                echo "  <div class=\"opinion-wrapper left\">
                                            <div class=\"user-info clearfix\">
                                                <img class=\"left\" src=\"img/profile_picture/". $avatar ."\" alt=\"". $avatar ."\">
                                                <div class=\"info left\">
                                                    <div class=\"name\">" . $user_info->name . "</div>
                                                    <div class=\"rating\">"; 

                                                        for ($i=0; $i < $rating; $i++) { 
                                                            echo "<div class=\"star-rating star-rating-on\"><a></a></div>";
                                                        }

                                                        for ($i=0; $i < $stars_off ; $i++) { 
                                                            echo "<div class=\"star-rating\"><a></a></div>";
                                                        }

                                echo "
                                                    </div>

                                                    <div class=\"post-date\">". $post_date ."</div>
                                                </div>
                                            </div>
                                            <h3 class=\"item-name\"><a href=\"#\">" . $opinion->category ." - " . $opinion->name . "</a></h3>
                                            <p class=\"opinion-text\">" .$opinion->opinion . "</p>
                                        </div>";             
                            }
                            echo "</div>";
                        }

                        ?>
                                                   

                </div>

                <div class="container-small left">
                    <img src="img/temp-banner.jpg" alt="">
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
