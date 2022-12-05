<?php
require_once 'HTTP/Request2.php';
$request = new HTTP_Request2();
$request->setUrl('https://airapi.airly.eu/v2/measurements/point?lat=XX.XXXXXXXXX&lng=XX.XXXXXXXXX');
$request->setMethod(HTTP_Request2::METHOD_GET);
$request->setConfig(array(
    'follow_redirects' => true
));
$request->setHeader(array(
    'Accept-Language' => 'pl',
    'apikey' => 'apikeyapikeyapikeyapikeyapikey'
));
try
{
    $response = $request->send();
    if ($response->getStatus() == 200)
    {
        $daneJSON = $response->getBody();
        //echo $daneJSON;
        //echo "Jest OK";
        //echo '<br>';
        $json = json_decode($daneJSON, true);

        $path = "/home/airly/dane/";
        $fp = fopen("airly.txt", "w");
        $n = "airly.txt";
        fwrite($fp, $n);
        fclose($fp);

        $pm1 = $json['current']['values'][0]['value'];
        echo 'PM1: ';
        echo $pm1;
        $fp = fopen($path . "pm1.txt", "w");
        fwrite($fp, $pm1);
        fclose($fp);

        echo '<br>';
        $pm25 = $json['current']['values'][1]['value'];
        echo 'PM2.5: ';
        echo $pm25;
        $fp = fopen($path . "pm25.txt", "w");
        fwrite($fp, $pm25);
        fclose($fp);

        echo '<br>';
        $who_pm25 = $json['current']['standards'][0]['percent'];
        echo '% NORMY WHO PM2.5: ';
        echo $who_pm25;
        $fp = fopen($path . "who_pm25.txt", "w");
        fwrite($fp, $who_pm25);
        fclose($fp);

        echo '<br>';
        $pm10 = $json['current']['values'][2]['value'];
        echo 'PM10: ';
        echo $pm10;
        $fp = fopen($path . "pm10.txt", "w");
        fwrite($fp, $pm10);
        fclose($fp);

        echo '<br>';
        $who_pm10 = $json['current']['standards'][1]['percent'];
        echo '% NORMY WHO PM10: ';
        echo $who_pm10;
        $fp = fopen($path . "who_pm10.txt", "w");
        fwrite($fp, $who_pm10);
        fclose($fp);

        echo '<br>';
        $pressure = $json['current']['values'][3]['value'];
        echo 'PRESSURE: ';
        echo $pressure;
        $fp = fopen($path . "pressure.txt", "w");
        fwrite($fp, $pressure);
        fclose($fp);

        echo '<br>';
        $humidity = $json['current']['values'][4]['value'];
        echo 'HUMIDITY: ';
        echo $humidity;
        $fp = fopen($path . "humidity.txt", "w");
        fwrite($fp, $humidity);
        fclose($fp);

        echo '<br>';
        $temperature = $json['current']['values'][5]['value'];
        echo 'TEMPERATURE: ';
        echo $temperature;
        $fp = fopen($path . "temperature.txt", "w");
        fwrite($fp, $temperature);
        fclose($fp);

    }
    else
    {
        echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' . $response->getReasonPhrase();
    }
}
catch(HTTP_Request2_Exception $e)
{
    echo 'Error: ' . $e->getMessage();
}
?>
