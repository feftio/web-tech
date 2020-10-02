<?php
include_once 'src/php/functions.php';

// CONFIG
$LAB = 'Lab 2';

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
            <div class="box_text">
                <h2><?php echo $LAB; ?></h2>
            </div>
            <form class="box_form" method="POST">
            
            </form>
        </div>
    </div>
</body>
</html>