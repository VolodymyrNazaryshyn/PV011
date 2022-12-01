<?php
// одна из задач контроллера - разделить работу по методам запроса
// echo "<pre>" ; print_r( $_SERVER ) ;

$reg_error = [
    'login_err' => [
        0 => 'Empty login',
        1 => 'Login length must be more than 3 symbols',
        2 => 'Login in use'
    ],
    'userName_err' => [
        0 => 'Empty username',
        1 => 'Username couldn\'t contain space(s)'
    ],
    'password_err' => [
        0 => 'Empty password',
        1 => 'Password doesn\'t follow the pattern: Minimum 8 characters, one digit, one uppercase letter and one lowercase letter'
    ],
    'confirm_err' => [
        0 => 'Passwords mismatch'
    ],
    'email_err' => [
        0 => 'Empty email',
        1 => 'Email doesn\'t follow the pattern (example: volodimir@gmail.com, Alex@mail.odessa.ua)'
    ],
    'file_err' => [
        0 => "Invalid extension, choose from 'png', 'jpg', 'gif', 'jpeg'"
    ]
];

// @ - подавление вывода ошибок
@session_start() ; // сессии - перед обращением к сессии обязательно $_SESSION[] - формируется стартом
switch( strtoupper( $_SERVER[ 'REQUEST_METHOD' ] ) ) {
case 'GET'  :
    $view_data = [] ;
    if( isset( $_SESSION[ 'reg_error' ] ) ) {
        $view_data[ 'reg_error' ] = $_SESSION[ 'reg_error' ] ;
        unset( $_SESSION[ 'reg_error' ] );
        // при ошибке сохраняются введенные данные - восстанавливаем
        $view_data[ 'login' ] = $_SESSION[ 'login' ] ;
        $view_data[ 'email' ] = $_SESSION[ 'email' ] ;
        $view_data[ 'userName' ] = $_SESSION[ 'userName' ] ;
    }
    if( isset( $_SESSION[ 'reg_ok' ] ) ) {
        $view_data[ 'reg_ok' ] = $_SESSION[ 'reg_ok' ] ;
        unset( $_SESSION[ 'reg_ok' ] );
    }
    include "_layout.php" ; // ~return View
    break ;

case 'POST' :
    $file_name = $_FILES['avatar']['name'];
    // echo "<pre>" ; print_r( $_FILES ) ; exit ;
    // данные формы регистрации - обрабатываем
    if( empty( $_POST['login'] ) ) {
        $_SESSION[ 'reg_error' ] = $reg_error['login_err'][0] ;
    }
    else if ( strlen($_POST['login']) < 3 ) {
        $_SESSION[ 'reg_error' ] = $reg_error['login_err'][1] ;
    }
    else if ( empty( $_POST['userName'] ) ) {
        $_SESSION[ 'reg_error' ] = $reg_error['userName_err'][0] ;
    }
    else if ( preg_match( "/\s/", $_POST['userName'] ) ) {
        $_SESSION[ 'reg_error' ] = $reg_error['userName_err'][1] ;
    }
    else if( empty( $_POST['userPassword1'] ) ) {
        $_SESSION[ 'reg_error' ] = $reg_error['password_err'][0] ;
    }
    else if ( !preg_match( "/^(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $_POST['userPassword1'] ) ) {
        $_SESSION[ 'reg_error' ] = $reg_error['password_err'][1] ;
    }
    else if( $_POST['userPassword1'] !== $_POST['confirm'] ) {
        $_SESSION[ 'reg_error' ] = $reg_error['confirm_err'][0] ;
    } 
    else if( empty( $_POST['email'] ) ) {
        $_SESSION[ 'reg_error' ] = $reg_error['email_err'][0] ;
    }
    else if( !preg_match( "/^[A-z][A-z\d_]{3,16}@([a-z]{1,10}\.){1,5}[a-z]{2,3}$/", $_POST['email'] ) ) {
        $_SESSION[ 'reg_error' ] = $reg_error['email_err'][1] ;
    } else {
        try {
            $prep = $connection->prepare(
                "SELECT COUNT(id) FROM Users u WHERE u.`login` = ? " ) ;
            $prep->execute( [ $_POST['login'] ] ) ;
            $cnt = $prep->fetch( PDO::FETCH_NUM )[0] ;
        }
        catch( PDOException $ex ) {
            $_SESSION[ 'reg_error' ] = $ex->getMessage() ;
        }
        if( $cnt > 0 ) {
            $_SESSION[ 'reg_error' ] = $reg_error['login_err'][2] ;
        }

        // Проверяем наличие аватарки и загружаем файл:
        // Берем имя файла, отделяем расширение, проверяем на допустимые (изображения)
        // сохраняем расширение, но меняем имя файла (генерируем случайно)
        //  использовать переданные имена опасно (возможный конфликт - перезапись,
        //  возможные DT-атаки со спецсимволами в именах файлов (../../) )
        // Файлы храним в отдельной папке, их имена (с расширениями) - в БД

        if( isset( $_FILES['avatar'] ) ) {  // наличие файлового поля на форме
            if( $_FILES['avatar']['error'] === 0 && $_FILES['avatar']['size'] !== 0 ) {
                // есть переданный файл
                $dot_position = strrpos( $_FILES['avatar']['name'], '.' ) ;  // strRpos ~ lastIndexOf
                if( $dot_position === -1 ) {  // нет расширения у файла
                    $_SESSION[ 'reg_error' ] = "File without type not supported" ;
                }
                else {
                    $extension = substr( $_FILES['avatar']['name'], $dot_position ) ;  // расширение файла с точкой (".png")
                    
                    // Д.З. Загрузка аватарки:
                    $ext_array = ['.png', '.jpg', '.gif', '.jpeg']; // Массив доступных расширений

                    if( in_array($extension, $ext_array)  ) { // ✅ Проверить расширение файла на допустимый перечень (изображения)
                        // убеждаемся, что в имени файла нету ../ (защита от DT)
                        if( str_contains( $file_name, '../' ) ) $file_name = str_replace( '../', '', $file_name );
                        
                        $avatars = scandir( "./avatars/" ); // Получаем все файлы из директории

                        // ✅ Сгенерировать случайное имя файла, сохранить расширение
                        foreach( $avatars as $key => $val ) {
                            if($file_name === $val) {
                                $path_parts = pathinfo($val);
                                $filename_only = $path_parts['filename']; // файл без расширения
                                $file_ext = $path_parts['extension']; // расширение файла
                                $file_name = $filename_only . bin2hex(random_bytes(16)) . '.' . $file_ext; // формируем новое имя файла
                            }
                        }

                        // ✅ Загрузить файл в папку www/avatars
                        move_uploaded_file( $_FILES['avatar']['tmp_name'], './avatars/' . $file_name ) ;
                    } else {
                        $_SESSION[ 'reg_error' ] = $reg_error['file_err'][0] ;
                    }

                    // echo $extension ; exit ;
                }
            }
        }
    }

    if( empty( $_SESSION[ 'reg_error' ] ) ) { // не было ошибок выше
        // $_SESSION[ 'reg_error'] = "OK" ;
        $salt = md5( random_bytes(16) );
        $pass = md5( $_POST['confirm'] . $salt );
        $confirm_code = bin2hex( random_bytes(3) ) ;

        // ✅ Имя файла добавить в параметры SQL-запроса и передать в БД

        $sql = "INSERT INTO Users(`id`,`login`,`name`,`salt`,`pass`,`email`,`confirm`,`avatar`)
                VALUES(UUID(),?,?,'$salt','$pass',?,'$confirm_code','$file_name')" ;
        try {
            $prep = $connection->prepare( $sql ) ;
            $prep->execute( [ $_POST['login'], $_POST['userName'], $_POST['email'] ] ) ;
            $_SESSION[ 'reg_ok' ] = "Reg ok" ;
        }
        catch( PDOException $ex ) {
            $_SESSION[ 'reg_error' ] = $ex->getMessage() ;
        }
    }
    else { // были ошибки - сохраняем в сессии все введенные значения (кроме пароля)
        $_SESSION[ 'login' ]    = $_POST['login'] ;
        $_SESSION[ 'email' ]    = $_POST['email'] ;
        $_SESSION[ 'userName' ] = $_POST['userName'] ;
    }
    // echo "<pre>" ; print_r( $_POST ) ;
    // на запросы кроме GET (кроме API) всегда возвращается redirect
    header( "Location: /" .  $path_parts[1] ) ;
    break ;
}