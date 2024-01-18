
<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'mydatabase';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = 'SELECT dateA, hoursA, Temperature, Luminosity, Humidity, AirQuality, UVvalue FROM mydata';
$result = $conn->query($sql);

$data = array(
    'dates' => array(),
    'temperatures' => array(),
    'luminositys' => array(),
    'humiditys' => array(),
    'airQualitys' => array(),
    'uvValue' => array()
);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $datetime = $row['dateA'] . ' ' . $row['hoursA'];
        array_push($data['dates'], $datetime);
        array_push($data['temperatures'], $row['temperature']);
        array_push($data['humiditys'], $row['Humidity']);
        array_push($data['luminositys'], $row['Luminosity']);
        array_push($data['airQualitys'],$row['AirQuality']);
        array_push($data['uvValue'], $row[('UVvalue')]);
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
