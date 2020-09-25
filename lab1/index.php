<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$submited = isset($_POST['button']) ? True : False;

if (!$submited) {

}

?>

<!DOCTYPE html>
<html lang='ru'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name="description" content="Lab 1">
    <meta name="author" content="Lik Eduard">
    <link rel="stylesheet" href="src/reset.css?v=<?php echo generateRandomString(5); ?>">
    <link rel="stylesheet" href="src/style.css?v=<?php echo generateRandomString(5); ?>">
    <title>Lab 1</title>
</head>

<body>
    <div class="wrapper">
        <div class="box">
            <div class="box__text">
                <h2>Lab 1</h2>
            </div>
            <form class="box__form" method="POST">

                <?php if (!$submited) { ?>

                <input type="submit" name="button" value="Get Environment Variables">

                <?php } else { ?>

                <?php foreach ($_SERVER as $key => $value) { ?>

                <div style="margin: 20px 0 20px 0"><span><?php echo $key; ?></span><p><?php echo $value; ?></p></div>

                <?php } 
                
                echo "Done by Lik Eduard";
            
            } ?>

            </form>
        </div>
    </div>
</body>

</html>