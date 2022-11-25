<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css" />
    <title>PV011</title>
</head>
<body>
    <header>
        <img src="/img/php.png" alt="logo" class="logo" />
        <nav>
            <ul>
                <li><a href="/basics">Введение в РНР</a></li>
                <li><a href="/fundamentals">Основы РНР</a></li>
                <li><a href="/layout">Шаблонизация</a></li>
                <li><a href="/formdata">Данные форм</a></li>
                <li><a href="/db">Работа с БД</a></li>
            </ul>
        </nav>
        
        <?php if( is_array( $_AUTH ) ) { ?>
            <b>Hello</b>
        <?php } else {  ?>
            <form method="post">
                <label><input name="userlogin" placeholder="login" /></label>
                <label><input name="userpassw" type="password" /></label>
                <button>Log in</button>
                <button type="button" onclick="location = '/register'">Register</button>
            </form>
            <?php if( is_string( $_AUTH ) ) { echo $_AUTH ; } ?>
        <?php }  ?>
        
    </header>

    <!-- Render body -->
    <?php
    if( $path_parts[1] === '' ) $path_parts[1] = 'index' ;
    switch( $path_parts[1] ) { // [1] - первая непустая часть (суть контроллер)
        case 'index'        : 
        case 'basics'       : 
        case 'fundamentals' : 
        case 'layout'       : 
        case 'formdata'     :
        case 'db'           : 
        case 'register'     : include "{$path_parts[1]}.php" ; break ;
        default             : include "404.php";
    }
    ?>

    <?php 
    $currentYear = date("Y");
    include "footer.php" 
    ?>
</body>
</html>