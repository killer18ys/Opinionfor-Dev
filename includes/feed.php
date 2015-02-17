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
                            <a href="./view-opinion.php">Виж мнения</a>
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
                                <div class="opinion-wrapper left">
                                    <div class="user-info clearfix">
                                        <img class="left" src="img/layout/profile-placeholder.png" alt="">
                                        <div class="info left">
                                            <div class="name">Lubo Ivanov</div>
                                            <div class="rating">
                                                <div class="star-rating star-rating-on"><a></a></div>
                                                <div class="star-rating star-rating-on"><a></a></div>
                                                <div class="star-rating star-rating-on"><a></a></div>
                                                <div class="star-rating star-rating-on"><a></a></div>
                                                <div class="star-rating"><a></a></div>
                                            </div>

                                            <div class="post-date">2 day ago</div>
                                        </div>
                                    </div>
                                    <h3 class="item-name"><a href="#">Product name</a></h3>
                                    <p class="opinion-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam id laborum, alias neque fugiat ad mollitia tempore officiis quam sit.   </p>
                                </div>

                            <div class="opinion-wrapper left">
                                    <div class="user-info clearfix">
                                        <img class="left" src="img/layout/profile-placeholder.png" alt="">
                                        <div class="info left">
                                            <div class="name">Lubo Ivanov</div>
                                            <div class="rating">
                                                <div class="star-rating star-rating-on"><a></a></div>
                                                <div class="star-rating star-rating-on"><a></a></div>
                                                <div class="star-rating star-rating-on"><a></a></div>
                                                <div class="star-rating star-rating-on"><a></a></div>
                                                <div class="star-rating"><a></a></div>
                                            </div>

                                            <div class="post-date">2 day ago</div>
                                        </div>
                                    </div>
                                    <h3 class="item-name"><a href="#">Product name</a></h3>
                                    <p class="opinion-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam id laborum, alias neque fugiat ad mollitia tempore officiis quam sit.   </p>
                                </div>

                                <div class="opinion-wrapper left">
                                    <div class="user-info clearfix">
                                        <img class="left" src="img/layout/profile-placeholder.png" alt="">
                                        <div class="info left">
                                            <div class="name">Lubo Ivanov</div>
                                            <div class="rating">
                                                <div class="star-rating star-rating-on"><a></a></div>
                                                <div class="star-rating star-rating-on"><a></a></div>
                                                <div class="star-rating star-rating-on"><a></a></div>
                                                <div class="star-rating star-rating-on"><a></a></div>
                                                <div class="star-rating"><a></a></div>
                                            </div>

                                            <div class="post-date">2 day ago</div>
                                        </div>
                                    </div>
                                    <h3 class="item-name"><a href="#">Product name</a></h3>
                                    <p class="opinion-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam id laborum, alias neque fugiat ad mollitia tempore officiis quam sit.   </p>
                                </div>
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
