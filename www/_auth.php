<?php if( is_array( $_CONTEXT[ 'auth_user' ] ) ) { ?>
    <li><b>Hello, <?= $_CONTEXT[ 'auth_user' ][ 'name' ] ?></b></li>
    <a href="/profile/<?= $_CONTEXT['auth_user']['login'] ?>">
        <img class='user-avatar' src='/avatars/<?= empty($_CONTEXT['auth_user']['avatar']) ? 'no-avatar.png' : $_CONTEXT['auth_user']['avatar'] ?>'>
    </a>
    <?php  // проверка на неподтвержденную почту, показ поля для кода
        if( $_CONTEXT[ 'auth_user' ][ 'confirm' ] != null ) {
            // почта не подтверждена ?>
        <input id='confirm-code' />
        <input type='button' value="Ok" onclick="confirmCode()" />
        <script>
            function confirmCode() {
                window.location = "/confirm?code=" +
                document.getElementById('confirm-code').value ;
            }
        </script>
    <?php }
    ?>
    <!-- Кнопка выхода из авторизованного режима - ссылка передающая параметр "logout" -->
    <li>
        <a href="?logout" class="header__link">
            <img class="logout" src="/img/logout.png" alt="logout">
        </a>
    </li>
<?php } else {  ?>
    <li><a href="/authorization" class="header__link">Log in</a></li>
<?php }  ?>