<div class="wrapper">
    <?php if( is_array( $_AUTH ) ) { ?>
            <h1>Hello</h1>
    <?php } else {  ?>
        <div class="reg-form-container">
            <div class="reg-form">
                <div class="reg-form-title">Authorization</div>
                <form class="registerForm" method="post">
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="userlogin">Login</label>
                            <input name="userlogin" required />
                            <?php if( is_string( $_AUTH ) ) { echo "<b class='error'>$_AUTH<b>" ; } ?>
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