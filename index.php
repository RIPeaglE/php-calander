<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>PHP Calendar</title>
</head>

<style>
    .button {
        width: 100px;
        height: 30px;
        border-radius: 10px;
    }

    a {
        text-decoration: none;
    }

    table {
        display: flex;
        justify-content: center;
        text-align: center;
        border-collapse: inherit;
    }

    .header {
        display: flex;
        justify-content: space-evenly;
    }

    .fontS{
        font-size: 30px;
    }
</style>

<body class="bg bg-secondary">
    <?php
    include 'monthEmoji.php';

    $month = isset($_GET['month']) ? $_GET['month'] : date('n');
    $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

    if ($month == 1) {
        $prevMonth = 12;
        $prevYear = $year - 1;
    } else {
        $prevMonth = $month - 1;
        $prevYear = $year;
    }

    $currEmoji = $emoji[$month]; 

    include 'namnsdag.php';

    echo("<table class='header'>");
    echo("<tr>");
    echo("<td>");
    echo("<button><a href='?month=" . $prevMonth . "&year=" . $prevYear . "'>Previous</a></button>");
    echo("</td>");
    echo("<td class='fontS'>");
    echo $currEmoji . " " . date('F Y', strtotime("$year-$month-01")) . " " . $currEmoji;
    echo("</td>");
    echo("<td>");
    echo("<button><a href='?month=" . (($month % 12) + 1) . "&year=" . ($month == 12 ? $year + 1 : $year) . "'>Next</a></button>");
    echo("</td>");
    echo("</tr>");
    echo("</table>");

    echo("<table class='table table-success table-striped'>");
    echo("<tr>");

    $daysOfWeek = array('Week', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

    foreach ($daysOfWeek as $day) {
        echo("<th>");
        echo $day;
        echo("</th>");
    }
    echo("</tr>");

    $firstDayOfWeek = date('N', strtotime("$year-$month-01"));
    $emptyCells = $firstDayOfWeek - 1;

    echo("<tr>");
    echo("<td>");
    echo date("W", strtotime("$year-$month-01"));
    echo("</td>");

    for ($x = 1; $x <= date("t", strtotime("$year-$month-01")); $x++) {
        if ($x == 1) {
            for ($i = 1; $i <= $emptyCells; $i++) {
                echo("<td></td>");
            }
        }

        echo("<td");
        if (($x + $emptyCells) % 7 == 0) {
            echo(" style='color: red;'");
        }
        echo(">");

        echo date("d", strtotime("$year-$month-$x"));
        $dayOfYear = date("z", strtotime("$year-$month-$x")) + 1;
        echo " <br>" . "Dag: " . $dayOfYear . "";

        if (array_key_exists($dayOfYear, $namnsdag)) {
            $names = implode(', ', $namnsdag[$dayOfYear]);
            echo "<br>" . $names;
        }

        echo("</td>");

        if (($x + $emptyCells) % 7 == 0) {
            echo("</tr>");
            echo("<tr>");
            echo("<td>");
            echo date("W", strtotime("$year-$month-$x"));
            echo("</td>");
        }
    }

    echo("</table>");
    ?>
</body>
</html>
