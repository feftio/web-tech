<?php include_once 'src/php/functions.php'; ?>

<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name="description" content="Lab 1">
    <meta name="author" content="Lik Eduard">
    <link rel="stylesheet" href="src/css/reset.css?v=<?php echo generateRandomString(5); ?>">
    <link rel="stylesheet" href="src/css/style.css?v=<?php echo generateRandomString(5); ?>">
    <title>Lab 1</title>
</head>
<body>
    <div class="wrapper">
        <div class="box">
            <div class="box_text">
                <h2>Lab 1</h2>
            </div>
            <form class="box_form" method="POST">

                <?php if (isset($_GET['get_server_variables']) || isset($_POST['get_server_variables'])) { 
                    
                    foreach ($_SERVER as $key => $value) { ?>

                    <div style="margin: 15px 10px 20px 10px"><span><?php echo $key; ?></span><p><?php echo $value; ?></p></div>

                <?php } } elseif (isset($_GET['write_to_file']) || isset($_POST['write_to_file'])) { ?>

                    <?php

                    ?>

                <?php } else { ?>
                    <div class="box_form-inputs">
                        <input type="submit" name="get_server_variables" value="Get Server Variables">
                        <input type="submit" name="write_to_file" value="Write To File">
                    </div>

                <?php } ?>

            </form>
        </div>
    </div>
</body>
</html>