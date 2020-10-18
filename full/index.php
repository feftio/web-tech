<?php include_once 'src/php/utils.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Task">
    <meta name="author" content="Lik Eduard">
    <link rel="stylesheet" href="src/css/design.css?v=<?php echo random_str(5); ?>">
    <link rel="stylesheet" href="src/css/style.css?v=<?php echo random_str(5); ?>">
    <title>Task</title>
</head>
<body>
    <div class="auth">

        <div class="container login">
            <h2>Welcome</h2>
            <form method="post" action="">
                <input class="auth-textbox" type="text" name="username" placeholder="Username">
                <input class="auth-textbox" type="password" name="password" placeholder="Password">
                <input class="auth-submit" type="submit" name="login" value="Log in">
                <p>Need an account? <a href="#" id="toggle-signup">Sign up</a> now!</p>
            </form>
        </div>

        <div class="container signup" style="display: none;">
            <h2>Sign up</h2>
            <form method="post" action="">
                <input class="auth-textbox" type="email" name="email" placeholder="Email">
                <input class="auth-textbox" type="text" name="username" placeholder="Username">
                <input class="auth-textbox" type="password" name="password" placeholder="Password">
                <input class="auth-textbox" type="password" name="password-r" placeholder="Repeat your password">
                <input class="auth-submit" type="submit" name="create" value="Create an Account">
                <p>Already have an account? <a href="#" id="toggle-login">Log in</a> now!</p>
            </form>
        </div>

        <div class="popup">

        </div>

        <ul class="bubbles"><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ul>
        
    </div>
</body>
<script src="src/js/jquery-3.5.1.min.js"></script>
<script src="src/js/auth.js"></script>
</html>