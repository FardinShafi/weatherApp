<?php
$api = 'd84c9060e9366380586eaaedc2dce151';
$city = $_GET['city'] ?? 'Dhaka';
if ($city == "") {
    $city = 'Dhaka';
}
$url = "http://api.openweathermap.org/data/2.5/forecast?q=" . $city . "&appid=d84c9060e9366380586eaaedc2dce151";
// $url = "api.openweathermap.org/data/2.5/forecast?q=London&appid=d84c9060e9366380586eaaedc2dce151";
$connect = file_get_contents($url);
$contents = json_decode($connect);
$date = $contents->list[0]->dt_txt;
$dt = $contents->list[0]->dt_txt;
$icon = array('0', '0', '0', '0');
$temp = array('0', '0', '0', '0');
$status = array('0', '0', '0', '0');
$dateArr = array('0', '0', '0', '0');

$d = substr($date, 8, 2) + 1;
$count = 0;
for ($i = 1; $i < 40; $i = $i + 1) {
    $data = $contents->list[$i];
    $d1 = $data->dt_txt;
    $d1 = substr($d1, 8, 2);
    if ($d == $d1) {
        $d3=$data->dt_txt;
        $d = substr($d3, 8, 2) + 1;
        $temp[$count] = $data->main->temp -273;
        $status[$count] = $data->weather[0]->main;
        $icon[$count] = "http://openweathermap.org/img/wn/" . $data->weather[0]->icon . "@2x.png";
        $d2 = $data->dt_txt;
        $dateArr[$count] = substr($d2, 8, 2) . "-" . substr($d2, 5, 2) . "-" . substr($d2, 0, 4);
        $count = $count + 1;

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Document</title>
</head>

<body>
    <div class="searchCard">
        <div class="searchHeader">
            <h1>FORECAST</h1>
            <div>
                <img class="locpic" src="images/pin_484167.png" alt="">
                <p style="display: inline-block;">Current Location</p>
                <h5>
                    <?= $contents->city->name . ", " . $contents->city->country ?>
                </h5>
            </div>
        </div>
        <div class="searchItems">
            <h1>City Weather Search</h1>
            <form>
                <!-- <label for="city">Enter city name:</label> -->
                <input type="text" id="city" name="city" placeholder="Enter City Name" required>
                <!-- <button type="submit" id="submit">Search</button> -->
                <!-- <input class="submit" type="submit" value="submit"> -->
                <!-- <img src="images/magnifying-glass_2811806.png" id="submit" type="submit" alt=""> -->
                <button type="submit" value="submit"></button>
            </form>
        </div>
    </div>
    <div class="weatherCard">
        <h1 class="title">Today</h1>
        <div class="current">
            <div class="current1">
                <h1><?= intval($contents->list[0]->main->temp -273) ?> &deg;C</h1>
                <div class="currentFlex">
                    <p class="currentW">
                        <?= $contents->list[0]->weather[0]->main ?>
                    </p>
                    </p>
                    <img src="<?= "http://openweathermap.org/img/wn/" . $contents->list[0]->weather[0]->icon . "@4x.png" ?>"
                        class="currentpic" alt="">
                </div>
                <p>
                    <?= substr($dt, 8, 2) . "-" . substr($dt, 5, 2) . "-" . substr($dt, 0, 4) ?>
                </p>

            </div>
            <div class="current2">
                <p>Feels like:
                    <?= $contents->list[0]->main->feels_like - 273 . "&degC" ?>
                </p>
                <p>Pressure:
                    <?= intval($contents->list[0]->main->pressure / 1000.0 ). " atm" ?>
                </p>
                <p>Visibility:<?= $contents->list[0]->visibility ?></p>
                <p>Wind speed: <?= $contents->list[0]->wind->speed?></p>
                <p>Humidity:
                    <?= $contents->list[0]->main->humidity . "%" ?>
                </p>
            </div>
        </div>
        <h2 class="title">Daily</h2>
        <div class="forecast">
            <div class="days">
                <img src="<?= $icon[0] ?>" alt="">
                <h4>
                    <?= intval($temp[0]) ?>&deg;C
                </h4>
                <h6>
                    <?= $status[0] ?>
                </h6>
                <p>
                    <?= $dateArr[0] ?>
                </p>
            </div>
            <div class="days">
                <img src="<?= $icon[1] ?>" alt="">
                <h4>
                    <?= intval($temp[1]) ?>&deg;C
                </h4>
                <h6>
                    <?= $status[1] ?>
                </h6>
                <p>
                    <?= $dateArr[1] ?>
                </p>
            </div>
            <div class="days">
                <img src="<?= $icon[2] ?>" alt="">
                <h4>
                    <?= intval($temp[2]) ?>&deg;C
                </h4>
                <h6>
                    <?= $status[2] ?>
                </h6>
                <p>
                    <?= $dateArr[2] ?>
                </p>
            </div>
            <div class="days">
                <img src="<?= $icon[3] ?>" alt="">
                <h4>
                    <?= intval($temp[3]) ?>&deg;C
                </h4>
                <h6>
                    <?= $status[3] ?>
                </h6>
                <p>
                    <?= $dateArr[3] ?>
                </p>
            </div>

        </div>
    </div>
</body>

</html>