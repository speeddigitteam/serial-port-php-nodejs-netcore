<?php

header('Content-Type: application/json; charset=utf-8'); 

$portName = 'COM2:';
$baudRate = 9600;
$bits = 8;
$spotBit = 1;

try {
    $bbSerialPort;
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $bbSerialPort = dio_open($portName, O_RDWR);
        exec("mode {$portName} baud={$baudRate} data={$bits} stop={$spotBit} parity=n xon=on");
    } 
    // sleep(3);
    $data = dio_read($bbSerialPort, 30); 
    $brackedEndPos = strpos($data, "}");
    $finalData = substr($data, 0, $brackedEndPos+1);
    if ($data) {
        echo json_encode($finalData);
    }
    dio_close($bbSerialPort);

} catch (Exception $e) {
    echo 'Fatal Error!';
    exit;
}
