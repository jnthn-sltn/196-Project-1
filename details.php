<?php
    include "header.php";

    /* Connect to the DB*/
    $db = connectMongo();
    $sounds = $db->sound;
    $temperatures = $db->temp;
    $soundCursor = $temperatures->find()->sort(array('entry'=> -1))->limit(24);
    $temperatureCursor = $temperatures->find()->sort(array('entry'=> -1))->limit(24);
    /*Parse temperature data. We need to form a string representation
     of two arrays, which will become x-y pairs for a line chart.
     This is because Charts.js will need an array, which we will provide
     by assigning this string to a JS variable.*/
     $temperatureX = "[";
     $temperatureData = "[";
     foreach ($temperatureCursor as $doc) {
         $time = split('[ ]', $doc['time']);//split the date into day and time
         $temperatureX = $temperatureX . "'" . $time[1] . "',";//put time into the x axis
         $temperatureData = $temperatureData . $doc['val'] . ",";//add y value - temperature for that time
     }
     //strip the trailing commas and add the closing bracket
     $temperatureX = trim($temperatureX,",");
     $temperatureX = $temperatureX . "]";

     $temperatureData = trim($temperatureData,",");
     $temperatureData = $temperatureData . "]";
     /* End temperature parse*/
     echo "<script>";
     echo "var temperatureData = " . $temperatureData . ";";
     echo "var temperatureX = " . $temperatureX . ";";
     echo "</script>";
?>
<!DOCTYPE html>
<html>
<head>
    <title>AmbiLamp</title>
    <link rel="stylesheet" type="text/css" href="assets/css/details.css">
</head>
<body>
    <?php
	include "header.php";
    ?>
    <!-- BUTTONS AND CANVASES -->
    <input type="button" id="temp-btn" class="btn" value="View Temperature Chart" onclick="drawTemp()">
    <canvas id="temp-chart-long" class="chart" width="900" height="350" hidden></canvas>
    <input type="button" id="sound-btn" class="btn" value="View Sound Chart" onclick="drawSound()">
    <canvas id="sound-chart-long" class="chart" width="900" height="350" hidden></canvas>

    <!-- TABLES -->
    <div id="tables-container">
        <div class="table">
            <!-- HINTS -->
            <!-- remember flexbox -->
            <!-- table class can have an overflow: scroll -->
            <!-- table max height is max-heght: -webkit-calc(100vh - 80px -62px) -->
            <!-- table margin is 40px -->
            <table id="temp-table">
                <tr>
                    <th>Time</th>
                    <th>Temperature</th>
                    <th>Deviation from Average</th>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>am</td>
                    <td>a</td>
                </tr>
                <tr>
                    <td>table</td>
                    <td>for</td>
                    <td>demonstration</td>
                </tr>
            </table>
        </div>
        <div class="table">
                <table id="sound-table">
                    <tr>
                        <th>Time</th>
                        <th>Amplitude</th>
                        <th>Deviation from Average</th>
                    </tr>
                    <tr>
                        <td>I</td>
                        <td>am</td>
                        <td>a</td>
                    </tr>
                    <tr>
                        <td>table</td>
                        <td>for</td>
                        <td>demonstration</td>
                    </tr>
                    <tr>
                        <td>I</td>
                        <td>am</td>
                        <td>a</td>
                    </tr>
                    <tr>
                        <td>table</td>
                        <td>for</td>
                        <td>demonstration</td>
                    </tr>
                    <tr>
                        <td>I</td>
                        <td>am</td>
                        <td>a</td>
                    </tr>
                    <tr>
                        <td>table</td>
                        <td>for</td>
                        <td>demonstration</td>
                    </tr>
                </table>
        </div>
    </div>

    <script type="text/javascript" src="assets/js/details.js"></script>
</body>
</html>
