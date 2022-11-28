<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/burger_menu.css" />
    <title>PHP</title>
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
                            <li><a href="/fundamentals" class="header__link">Fundament РНР</a></li>
                            <li><a href="/layout" class="header__link">Pattern</a></li>
                            <li><a href="/formdata" class="header__link">Formdata</a></li>
                            <li><a href="/db" class="header__link">Db</a></li>
                            <li><a href="/authorization" class="header__link">Log in</a></li>
                            <li><a href="/register" class="header__link">Register</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main class="main_container">
            <?php
                if( $path_parts[1] === '' ) $path_parts[1] = 'index' ;
                switch( $path_parts[1] ) { // [1] - первая непустая часть (суть контроллер)
                    case 'index'        : 
                    case 'basics'       : 
                    case 'fundamentals' : 
                    case 'layout'       : 
                    case 'formdata'     :
                    case 'db'           : 
                    case 'authorization': 
                    case 'register'     : include "{$path_parts[1]}.php" ; break ;
                    default             : include "404.php";
                }
            ?>
        </main>

        <?php 
            $currentYear = date("Y");
            include "footer.php" 
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