<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Access-Control-Max-Age: 1000');
header('Content-Type: application/json; charset=utf-8');

$portName = 'COM2:';
$baudRate = 9600;
$bits = 8;
$spotBit = 1;

if(!extension_loaded('dio'))
{
    throw new Exception("PHP direct IO does not appear to be installed");
    exit;
}

try {
    $bbSerialPort;
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $bbSerialPort = dio_open($portName, O_RDWR);
        exec("mode {$portName} baud={$baudRate} data={$bits} stop={$spotBit} parity=n xon=on");
    } 
    else 
    {
        $bbSerialPort = dio_open($portName, O_RDWR | O_NOCTTY | O_NONBLOCK );
        dio_fcntl($bbSerialPort, F_SETFL, O_SYNC);
        dio_tcsetattr($bbSerialPort, array(
            'baud' => $baudRate,
            'bits' => $bits,
            'stop'  => $spotBit,
            'parity' => 0
        ));
    }

    if(!isset($bbSerialPort))
    {
        throw new Exception("Could not open serial port {$portName}");
        exit;
    }

    // date_default_timezone_set("Asia/Dhaka");
    // $runForSeconds = new DateInterval("PT1S"); // 1 second(s)
    // $endTime = (new DateTime())->add($runForSeconds);
    // while (new DateTime() < $endTime) {
    //     $data = dio_read($bbSerialPort, 20); //this is a blocking call
    //     $brackedEndPos = strpos($data, "}");
    //     $data = substr($data, 0, $brackedEndPos+1);
    //     if ($data) {
    //         echo json_encode(['data' => $data]);
    //     }
    // }

    $data = dio_read($bbSerialPort, 20);
    $data = substr($data, 0, strpos($data, '*')+1);
    if ($data) {
        echo json_encode(['data' => $data]);
        // echo $data;
    }

    dio_close($bbSerialPort);

} catch (Exception $e) {
    echo $e->getMessage();
    exit(1);
}