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

        
        <?php include "/includes/headers/header.php"; ?>



        <section id="inner-main">
            <div class="container clearfix">

                <div class="container-small left">
                    <nav class="side-nav">
                        <div class="header item">Навигация</div>
                        <div class="item clearfix">
                            <a class="selected" href="./feed.php">Мнения</a>
                            <a href="./give-opinion.php">Сподели мнение</a>
                            <a href="./view-opinion.php">Потърси мнения</a>
                        </div>                        
                    </nav>
                </div>


                <div class="container-middle left">
                    <div id="content">

                        <div id="container_for_title">
                            <div class="head-description">
                                <h2>Мнения</h2>
                                <p>Последните споделени мнения</p>
                                <span class="icon"></span>
                            </div>

                            <div id="opinions-feed-wrapper clearfix">
                                <?php 

                                    $query_string = "SELECT * FROM opinions ORDER BY post_date DESC";
                                    $opinions = $db->query($query_string)->results();

                                    foreach ($opinions as $opinion) {
                                        $user_info = $db->get("users", array("id", "=", $opinion->user_id))->first();

                                        $rating = ($opinion->q1 + $opinion->q2 + $opinion->q3 + $opinion->q4 + $opinion->q5)/5;
                                        $rating = round($rating, 0, PHP_ROUND_HALF_UP);
                                        $stars_off = 5 - $rating;

                                        $post_date = split(" ", $opinion->post_date)[0];
                                        $post_time = split(" ", $opinion->post_date)[1];
                                        $post_date = split("-", $post_date);
                                        $post_date = $post_date[2] .'.' . $post_date[1] . '.' .$post_date[0];

                                        $name = $user_info->name ? $user_info->name : $user_info->username;
                                        $avatar = $user_info->avatar ? $user_info->avatar : "profile-placeholder.png" ;
                                        
                                        echo "  <div class=\"opinion-wrapper left\">
                                                    <div class=\"user-info clearfix\">
                                                        <img class=\"left\" src=\"img/profile_picture/". $avatar ."\" alt=\"". $avatar ."\">
                                                        <div class=\"info left\">
                                                            <div class=\"name\">" . $name . "</div>
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


                                 ?>
                            </div>
                        </div>

                       

                    </div>
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

    </body>
</html>
