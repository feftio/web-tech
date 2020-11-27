<?php

/**
 * Including files
 *
 */
include_once 'src/php/functions.php';

/**
 * Configuration
 *
 */
$LAB = 'Lab 1';
$FILE = 'log.txt';

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

                    <?php if (isset($_GET['get']) || isset($_POST['get'])) { ?>

                        <div class="list">
                        <?php foreach ($_SERVER as $key => $value) { ?>
                            <div class="record">
                                <span><?php echo $key; ?></span><p><?php echo $value; ?></p>
                            </div>
                        <?php } ?>
                        </div>

                        <input class="back" type="submit" name="back" value="Back">

                    <?php } elseif (isset($_GET['write']) || isset($_POST['write'])) { ?>
                        
                        <?php file_put_contents($FILE, implode("\n", $_SERVER)); ?>

                        <p class="record">Writed To File "<?php echo $FILE; ?>"</p>
                        <input class="back" type="submit" name="back" value="Back">

                    <?php } else { ?>

                        <div class="buttons">
                            <input type="submit" name="get" value="Get Server Variables">
                            <input type="submit" name="write" value="Write To File">
                        </div>

                    <?php } ?>
                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>