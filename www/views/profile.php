<h1>My Profile</h1>

<img class='profile-avatar' src='/avatars/<?= empty($_PROF_DATA['avatar']) ? 'no-avatar.png' : $_PROF_DATA['avatar'] ?>' alt="avatar">

<h3>Welcome,</h4>

<h2 class='profile-name'><?= $_PROF_DATA['name'] ?></h3>

<table class='profile-table' >
    <tr>
        <td>Login</td>
        <td><input class='profile-input' value='<?= $_PROF_DATA['login'] ?>' /></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><input class='profile-input' value='<?= $_PROF_DATA['name'] ?>' /></td>
    </tr>
    <tr>
        <td>E-mail</td>
        <td><input class='profile-input' type="email" value='<?= $_PROF_DATA['email'] ?>' /></td>
    </tr>
</table>

<button class='update-profile-btn'>Update Profile</button>

<!-- + Оформить вид личного кабинета -->