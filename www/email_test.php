<?php

include_once "helper/send_email.php" ;

if ( ! function_exists( "send_email" ) ) {
    echo "include error" ;
    exit ;
}

send_email( "volodimirnazarisin@gmail.com",
    "Email verification", 
    "<b>Hello</b><br/>Type code XXXXXX to confirm email" ) ;

/* Д.З. 
✅ Настроить и Реализовать отправку почтовых сообщений по SMTP протоколу.
✅ При регистрации пользователя формировать и отправлять письмо с кодом подтверждения почты (confirm)
** сохранять в БД статус отправки письма 
*/

/*
 include          подключить (и выполнить) файл. Если файла нет - warning и идем дальше
 include_once     то же самое, но + проверка не был ли файл подключен ранее
 require          то же самое, но если файла нет - фатальная ошибка (работа останавливается)
 require_once
 @include_once "TheClass.php" ;
 if( ! class_exists( "TheClass" ) ) ... местная обработка ошибки
*/