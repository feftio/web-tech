<?php include_once 'src/php/utils.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Task">
    <meta name="author" content="Lik Eduard">
    <link rel="stylesheet" href="src/css/default.css?v=<?php echo random_str(5); ?>">
    <link rel="stylesheet" href="src/css/style.css?v=<?php echo random_str(5); ?>">
    <title>Task</title>
</head>
<body>
    <div class="wrapper-auth">

        <div class="container-login">
            <h2>Welcome</h2>
            <form method="post" >
                <input type="text" placeholder="Username">
                <input type="password" placeholder="Password">
                <input type="submit" value="Log in">
                <p>Need an account? <a href="#" id="sign-up">Sign up</a> now!</p>
            </form>
        </div>

        <div class="container-reg">

        </div>
    </div>
</body>
<script src="src/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript"></script>
</html>