<div class="wrapper">
    <?php if( is_array( $_CONTEXT[ 'auth_user' ] ) ) { ?>
            <h1>Hello, <?= $_CONTEXT[ 'auth_user' ][ 'name' ] ?></h1>
    <?php } else {  ?>
        <div class="reg-form-container">
            <div class="reg-form">
                <div class="reg-form-title">Authorization</div>
                <form class="registerForm" method="post">
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="userlogin">Login</label>
                            <input name="userlogin" required />
                            <?php if( isset( $_CONTEXT[ 'auth_error' ] ) ) echo $_CONTEXT[ 'auth_error' ] ; ?>
                        </div>
                    </div>
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="userpassw">Password</label>
                            <input type="password" name="userpassw" required />
                        </div>
                    </div>
                    <button class="reg-button">Log in</button>
                </form>
            </div>
        </div>
    <?php }  ?>
</div>