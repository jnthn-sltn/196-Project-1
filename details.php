<!DOCTYPE html>
<html>
<head>
    <title>AmbiLamp</title>
    <link rel="stylesheet" type="text/css" href="header.css">
    <link rel="stylesheet" type="text/css" href="details.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
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

    <script type="text/javascript" src="details.js"></script>
</body>
</html>
