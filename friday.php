<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/friday.css">
    <title>Friday</title>
</head>
<body>

<form action="#" method="POST">
        <input type="date" name="dat">

        <input name="skicka" type="submit" value="FREDAG?">
    </form>

    <?php
        if (isset($_POST['dat'])) {
            $fredag = $_POST['dat'];   
    
            $time = strtotime($fredag);
            $idag = date('w', $time);
            $tillfredag = 5 - $idag;
    
            if ($tillfredag === 0) {
                echo "<br> <img src='img/fridaygif.gif' alt='Friday GIF' />";
            } else {
                if ($tillfredag < 0) {
                    $tillfredag += 7;
                }
                echo "<p> Det är $tillfredag dagar kvar till nästa fredag. </p>";
            }
        }
        
    ?>
    
</body>
</html>