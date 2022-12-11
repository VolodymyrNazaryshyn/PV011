<div class='profile-container'>
    <?php $is_my_profile = ($_PROF_DATA['login'] === $_CONTEXT['auth_user']['login']) ; ?>
    <h1><?= $_PROF_DATA['title'] ?></h1>

    <img class='profile-avatar' src='/avatars/<?= empty($_PROF_DATA['avatar']) ? 'no-avatar.png' : $_PROF_DATA['avatar'] ?>' alt="avatar">

    <h3>Welcome,</h4>

    <h2 class='profile-name'><?= $_PROF_DATA['name'] ?></h3>

    <table class='profile-table' >
        <tr>
            <td>Login</td>
            <td><span class='profile-input' id='user-login' <?= $is_my_profile ? 'contenteditable' : '' ?> ><?= $_PROF_DATA['login'] ?></span></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><span class='profile-input' id='user-name' <?= $is_my_profile ? 'contenteditable' : '' ?> ><?= $_PROF_DATA['name'] ?></span></td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td><span class='profile-input' id='user-email' <?= $is_my_profile ? 'contenteditable' : '' ?> ><?= $_PROF_DATA['email'] ?></span></td>
        </tr>
    </table>

    <?php if( $is_my_profile ) : ?>
        <button class='update-profile-btn' onclick='updateProfile()'>Update Profile</button>
        <script>
            function updateProfile() {
                let spanLogin = document.getElementById('user-login') ;
                if( ! spanLogin ) throw "spanLogin no found" ;
                let spanName = document.getElementById('user-name') ;
                if( ! spanName ) throw "spanName no found" ;
                let spanEmail = document.getElementById('user-email') ;
                if( ! spanEmail ) throw "spanEmail no found" ;
                fetch('/profile', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `login=${spanLogin.innerText}&name=${spanName.innerText}&email=${spanEmail.innerText}`
                }).then( r => r.text() )
                .then( console.log );
            }
        </script>
    <?php endif ?>

    <!-- + Оформить вид личного кабинета -->
</div>