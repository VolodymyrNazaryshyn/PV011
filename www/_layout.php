<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/burger_menu.css" />
    <title>PV011 <?= $_CONTEXT['page_title'] ?? '' ?></title>
</head>
<body>
    <div class="main_wrapper">
        <header class="main_header">
            <div class="main_container">
                <div class="header__body">
                    <a href="/index" class="header__logo">
                        <img src="/img/php.png" alt="logo">
                    </a>
                    <div class="header__burger" id="header__burger">
                        <span></span>
                    </div>
                    <nav class="header__menu" id="header__menu">
                        <ul class="header__list">
                            <li><a href="/basics" class="header__link">Intro РНР</a></li>
                            <li><a href="/fundamentals" class="header__link">Fund РНР</a></li>
                            <li><a href="/layout" class="header__link">Pattern</a></li>
                            <li><a href="/formdata" class="header__link">Formdata</a></li>
                            <li><a href="/db" class="header__link">Db</a></li>
                            <li><a style="color:hotpink" href="/email_test" class="header__link">E-mail</a></li>
                            <li><a href="/register" class="header__link">Register</a></li>

                            <?php include "_auth.php" ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main class="main_container">
            <?php
                if( $path_parts[1] === '' ) $path_parts[1] = 'index' ;
                switch( $path_parts[1] ) { // [1] - первая непустая часть (суть контроллер) 
                    case 'email_test'   :
                    case 'register'     : include "{$path_parts[1]}.php" ; break ;
                    case 'index'        :
                    case 'fundamentals' : 
                    case 'basics'       : 
                    case 'db'           : 
                    case 'formdata'     :
                    case 'layout'       : 
                    case 'authorization': 
                    case 'shop'         :
                    case 'profile'      : include "views/components/{$path_parts[1]}.php" ; break ;
                    default             : include "views/components/404.php";
                }
            ?>
        </main>

        <?php 
            $currentYear = date("Y");
            include "views/index/footer.php" 
        ?>
    </div>

    <script>
        let header__burger = document.getElementById('header__burger');
        header__burger.addEventListener('click', () => {
            header__burger.classList.toggle('active');
            document.getElementById('header__menu').classList.toggle('active');
            document.body.classList.toggle('lock');
        });
    </script>
</body>
</html>