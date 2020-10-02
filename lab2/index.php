<?php

/**
 * Including files
 *
 */
include 'src\php\functions.php';

/**
 * Configuration
 *
 */
$LAB = 'Lab 2';
$METHODS = ['COOKIE', 'SESSION'];

/**
 * Actions
 * 
 */
useMethod($METHODS[0]);

?>

<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name="description" content="<?php echo $LAB; ?>">
    <meta name="author" content="Lik Eduard">
    <link rel="stylesheet" href="src/css/reset.css?v=<?php echo generateRandomString(5); ?>">
    <link rel="stylesheet" href="src/css/style.css?v=<?php echo generateRandomString(5); ?>">
    <title><?php echo $LAB; ?></title>
</head>
<body>
    <div class="wrapper">
        <div class="box">

            <div class="box_name">
                <h2><?php echo $LAB; ?></h2>
            </div>

            <div class="box_task">
                <form method="post">
                    <div class="q-block">
                        <label class="q" for="q1">What's your name?</label>
                        <input type="text" id="q1" name="q1">
                    </div>
                    <div class="q-block">
                        <label class="q" for="q2">How old are you?</label>
                        <input type="number" id="q2" name="q2">
                    </div>
                    <div class="q-block">
                        <label class="q" for="q3">Phone Number</label>
                        <input type="tel" id="q3" name="q3">
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>
</html>