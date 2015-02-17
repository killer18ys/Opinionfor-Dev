<header id="main-header" class="small-header">
    <div class="container">      
        <div class="logo-nav-line clearfix">
            <h2 class="header-logo">
                <a class="logo ir" href="./feed.php">opinion for</a>
            </h2>

            <nav>
                <ul>
                    <li class="btn"><a href="./feed.php">Мнения</a></li>
                    <li class="separator"></li>

                    <li class="user-tag">
                        <a href="./settings-profile.php">
                            <img src="img/temp-profile-pic.jpg" alt="profile-pic">
                            <span class="username"><?php echo escape($user->data()->username);?></span>
                        </a>
                    </li>
                    <li class="separator"></li>

                    <li class="menu">

                        <span class="settings-gear"></span>
                        

                        <nav class="header-menu">
                            <div>
                                <ul>
                                    <li><a href="./give-opinion.php">Сподели мнение</a></li>
                                    <li><a href="./view-opinion.php">Виж мнения</a></li>
                                </ul>    

                                <ul>
                                    <li><a href="./settings-profile.php">Настройки</a></li>
                                    <!-- <li><a href="#">Help</a></li> -->
                                    <li><a href="./logout.php">Изход</a></li>
                                </ul>
                            </div>
                        </nav>

                    </li>
                    <li class="separator"></li>
                </ul>
            </nav>
        </div>
    </div>
</header>