<?php 
require_once 'core/init.php';

$user = new User();
$db = DB::getInstance();
$db->query("SET NAMES utf8");

if(!$user->isLoggedIn()){
	Redirect::to('register.php');
}

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $items_to_validate = array(
            'category' => array(
                'required' => true
            ),
            'opinion-field' => array(
                'required' => true
            ),
            'q1' => array(
               'required' => true     
            ),
            'q2' => array(
                'required' => true
            ),
            'q3' => array(
                'required' => true
            ),
            'q4' => array(
                'required' => true
            ),
            'q5' => array(
                'required' => true
            )
        );


        $validation = $validate->check($_POST, $items_to_validate);

        $category_name = $db->get("categories", array("id", "=", Input::get('category')))->first()->category;

        if ($validation->passed()) {
            try {
                    
                $db->insert('opinions', array(
                    'user_id' => $user->data()->id,
                    'category' => $category_name,
                    'name' => Input::get('item-name'),
                    'opinion' => Input::get('opinion-field'),
                    'q1'=> Input::get('q1'),
                    'q2'=> Input::get('q2'),
                    'q3'=> Input::get('q3'),
                    'q4'=> Input::get('q4'),
                    'q4'=> Input::get('q4'),
                    'q5'=> Input::get('q5'),
                    'post_date' => date('Y-m-d H:i:s')

                ));

                Session::flash('home', 'Your opinion was posted.');
                Redirect::to('index.php');

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
        
        <?php include "/includes/headers/header.php"; ?>



        <section id="inner-main">
            <div class="container">
                <div class="container-small left">
                    <nav class="side-nav">
                        <div class="header item">Навигация</div>
                        <div class="item clearfix">
                            <a href="./feed.php">Мнения</a>
                            <a class="selected" href="./give-opinion.php">Сподели мнение</a>
                            <a href="./view-opinion.php">Потърси мнения</a>
                        </div>                        
                    </nav>
                </div>


                <div class="container-middle left">
                        
                    <h1 class="center">Споделете вашето мнение</h1>
                   <!--  <p class="center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam ullam assumenda deserunt!</p> -->

                    <div class="form-container">   
                        <form action="" method="post">
                            <div class="form-item-select">
                                <label for="category">Изберете категория</label>
                                <select name="category" id="category">
                                    <option value="0">Моля изберете</option>
                                   <?php 
                                       $categories = $db->get('categories', array("perant_id", "=" , 0))->results();
                                       foreach ($categories as $category) {
                                        echo "<option value='{$category->id}'>{$category->category}</option>";
                                       }
                                    ?>
                                </select>
                            </div>

                            <div class="form-item-name">
                                <label for="item-name">Мнение относно</label>
                                <input type="text" id="item-name" name="item-name">
                            </div>

                            <div class="opinion-field-wrapper">
                                <label for="opinion-field">Мнението Ви</label>
                                <textarea name="opinion-field" id="opinion-field"></textarea>
                            </div>

                            
                            <div class="questions-section clearfix">
                                <div class="question-wrapper">
                                    <p>Местоположение</p>
                                    <div class="rating_stars_wrapper">
                                        <input class="star" type="radio" name="q1" value="1"/>
                                        <input class="star" type="radio" name="q1" value="2"/>
                                        <input class="star" type="radio" name="q1" value="3"/>
                                        <input class="star" type="radio" name="q1" value="4"/>
                                        <input class="star" type="radio" name="q1" value="5"/>
                                        
                                    </div>
                                </div>

                                <div class="question-wrapper">
                                    <p>Качество</p>
                                    <div class="rating_stars_wrapper">
                                        <input class="star" type="radio" name="q2" value="1"/>
                                        <input class="star" type="radio" name="q2" value="2"/>
                                        <input class="star" type="radio" name="q2" value="3"/>
                                        <input class="star" type="radio" name="q2" value="4"/>
                                        <input class="star" type="radio" name="q2" value="5"/>
                                    </div>
                                </div>
                            
                                <div class="question-wrapper">
                                    <p>Изгодно</p>
                                    <div class="rating_stars_wrapper">
                                        <input class="star" type="radio" name="q3" value="1"/>
                                        <input class="star" type="radio" name="q3" value="2"/>
                                        <input class="star" type="radio" name="q3" value="3"/>
                                        <input class="star" type="radio" name="q3" value="4"/>
                                        <input class="star" type="radio" name="q3" value="5"/>
                                    </div>
                                </div>     

                                <div class="question-wrapper">
                                    <p>Обслужване</p>
                                    <div class="rating_stars_wrapper">
                                        <input class="star" type="radio" name="q4" value="1"/>
                                        <input class="star" type="radio" name="q4" value="2"/>
                                        <input class="star" type="radio" name="q4" value="3"/>
                                        <input class="star" type="radio" name="q4" value="4"/>
                                        <input class="star" type="radio" name="q4" value="5"/>
                                    </div>
                                </div>     

                                <div class="question-wrapper">
                                    <p>Атмосфера</p>
                                    <div class="rating_stars_wrapper">
                                        <input class="star" type="radio" name="q5" value="1"/>
                                        <input class="star" type="radio" name="q5" value="2"/>
                                        <input class="star" type="radio" name="q5" value="3"/>
                                        <input class="star" type="radio" name="q5" value="4"/>
                                        <input class="star" type="radio" name="q5" value="5"/>
                                    </div>
                                </div>     

                            </div>
                            
                            <hr>

                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                            <input type="submit" class="btn btn-raised" value="Публикувай">
                        </form>
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
