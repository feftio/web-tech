<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Task">
    <meta name="author" content="Lik Eduard">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="resources/css/design.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <title>Task</title>
</head>
<body>
    <main class="auth">

        <div class="container signin">
            <h2>Welcome</h2>
            <form id="signin-form" method="post" action="">
                <input class="auth-textbox" type="text" name="username" placeholder="Username">
                <input class="auth-textbox" type="password" name="password" placeholder="Password">
                <input class="auth-submit" type="submit" name="signin" value="Login">

                <p>Need an account? <a href="#" id="show-signup">Sign up</a> now!</p>
            </form>
        </div>

        <div class="container signup" style="display: none;">
            <h2>Sign up</h2>
            <form id="signup-form" method="post" action="">
                <input class="auth-textbox" type="email" name="email" placeholder="Email">
                <input class="auth-textbox" type="text" name="username" placeholder="Username">
                <input class="auth-textbox" type="password" name="password" placeholder="Password">
                <input class="auth-textbox" type="password" name="password-r" placeholder="Repeat your password">
                <input class="auth-submit" type="submit" name="signup" value="Create an Account">

                <p>Already have an account? <a href="#" id="show-signin">Log in</a> now!</p>
            </form>
        </div>

        <ul class="bubbles"><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ul>
        
    </main>
</body>
<script src="resources/js/jquery-3.5.1.min.js"></script>
<script src="resources/js/sweetalert.min.js"></script>
<script src="resources/js/auth.js"></script>
</html>