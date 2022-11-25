<div class="wrapper">
    <main>
        <div class="reg-form-container">
            <div class="reg-form">
                <div class="reg-form-title">Create Account</div>
                <form class="registerForm" method="post">
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="login">Login</label>
                            <input name="login" required />
                        </div>
                    </div>
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="userName">Username</label>
                            <input name="userName" />
                        </div>
                    </div>
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="userPassword1">Password</label>
                            <input type="password" name="userPassword1" required />
                        </div>
                    </div>
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="email">Email</label>
                            <input type="email" name="email" required />
                        </div>
                    </div>
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="confirm">Confirm</label>
                            <input name="confirm" />
                        </div>
                    </div>
                    <button class="reg-button">Registration</button>
                </form>
            </div>
        </div>
    </main>
</div>

<!-- Д.З.
✅ Разработать и сверстать форму регистрации со всеми необходимыми для БД полями:
`login`    NOT NULL,
`name`     NULL,
`pass`     NOT NULL,
`email`    NOT NULL,
`confirm`  NULL,
✅ Добавить ссылку на форму (страницу) рядом c Log In
❌ * Реализовать добавление нового пользователя в БД с рег. данными.
-->