<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Access-Control-Max-Age: 1000');
header('Content-Type: application/json; charset=utf-8');

$portName = 'COM5:';
$baudRate = 9600;
$bits = 8;
$spotBit = 1;

if (!extension_loaded('dio')) {
    throw new Exception("PHP Direct IO does not appear to be installed for more info see: http://www.php.net/manual/en/book.dio.php");
    exit;
}

try {
    $bbSerialPort;
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $bbSerialPort = dio_open($portName, O_RDWR);
        exec("mode {$portName} baud={$baudRate} data={$bits} stop={$spotBit} parity=n xon=on");
    } 

    if (!$bbSerialPort) {
        throw new Exception("Could not open Serial port {$portName}");
        exit;
    }
    
    sleep(1);
    $data = dio_read($bbSerialPort, 256);
    if ($data) {
        echo $data;
    }
    dio_close($bbSerialPort);
} catch (Exception $e) {
    exit(1);
}
