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

if ($_POST['save']) {
    setcookie('test', json_encode($_POST), time() + 3600);
    $test = $_POST;
} else {
    if (isset($_COOKIE['test'])) $test = json_decode($_COOKIE['test'], true);
}



?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
                        <label class="q" for="q1">1. What's your name?</label>
                        <input type="text" id="q1" name="q1" value="<?php show($test['q1']); ?>">
                    </div>
                    <div class="q-block">
                        <label class="q" for="q2">2. How old are you?</label>
                        <input type="number" id="q2" name="q2" value="<?php show($test['q2']); ?>">
                    </div>
                    <div class="q-block">
                        <label class="q" for="q3">3. Your phone number?</label>
                        <input type="tel" id="q3" name="q3" value="<?php show($test['q3']); ?>">
                    </div>
                    <div class="q-block">
                        <label class="q" for="q4">4. Your address?</label>
                        <input type="text" id="q4" name="q4" value="<?php show($test['q4']); ?>">
                    </div>
                    <div class="q-block">
                        <label class="q">5. How are you feeling?</label>
                        <label class="choose" for="q5-1"><input type="radio" id="q5-1" name="q5" value="q5-1" <?php show_radio($test['q5'], 'q5-1'); ?>>Great! Never better.</label>
                        <label class="choose" for="q5-2"><input type="radio" id="q5-2" name="q5" value="q5-2" <?php show_radio($test['q5'], 'q5-2'); ?>>Like I need a vacation.</label>
                        <label class="choose" for="q5-3"><input type="radio" id="q5-3" name="q5" value="q5-3" <?php show_radio($test['q5'], 'q5-3'); ?>>A little depressed.</label>
                        <label class="choose" for="q5-4"><input type="radio" id="q5-4" name="q5" value="q5-4" <?php show_radio($test['q5'], 'q5-4'); ?>>Really awful.</label>
                    </div>
                    <div class="q-block">
                        <label class="q">6. How was your day?</label>
                        <label class="choose" for="q6-1"><input type="radio" id="q6-1" name="q6" value="q6-1" <?php show_radio($test['q6'], 'q6-1'); ?>>Really good!</label>
                        <label class="choose" for="q6-2"><input type="radio" id="q6-2" name="q6" value="q6-2" <?php show_radio($test['q6'], 'q6-2'); ?>>Very productive.</label>
                        <label class="choose" for="q6-3"><input type="radio" id="q6-3" name="q6" value="q6-3" <?php show_radio($test['q6'], 'q6-3'); ?>>Super busy.</label>
                        <label class="choose" for="q6-4"><input type="radio" id="q6-4" name="q6" value="q6-4" <?php show_radio($test['q6'], 'q6-4'); ?>>A total nightmare.</label>
                    </div>
                    <div class="q-block">
                        <label class="q">7. Your the best programming languages?</label>
                        <label class="choose" for="q7-1"><input type="radio" id="q7-1" name="q7" value="q7-1" <?php show_radio($test['q7'], 'q7-1'); ?>>PHP</label>
                        <label class="choose" for="q7-2"><input type="radio" id="q7-2" name="q7" value="q7-2" <?php show_radio($test['q7'], 'q7-2'); ?>>JS</label>
                        <label class="choose" for="q7-3"><input type="radio" id="q7-3" name="q7" value="q7-3" <?php show_radio($test['q7'], 'q7-3'); ?>>Perl</label>
                        <label class="choose" for="q7-4"><input type="radio" id="q7-4" name="q7" value="q7-4" <?php show_radio($test['q7'], 'q7-4'); ?>>Python</label>
                    </div>
                    <input type="submit" name="save" value="Save">
                </form>
            </div>

        </div>
    </div>
</body>
</html>