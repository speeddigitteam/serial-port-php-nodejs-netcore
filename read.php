<?php

//-- settings --//

//brainboxes serial ports
//on 'nix start with cu.usbserial-
//on windows starts with com : must be lower case in windows and end with a colon
$portName = 'com2:';
$baudRate = 9600;
$bits = 8;
$spotBit = 1;

header( 'Content-type: text/plain; charset=utf-8' ); 
?>
Serial Port Test
================
<?php


function echoFlush($string)
{
    echo $string . "\n";
}

if(!extension_loaded('dio'))
{
    echoFlush( "PHP Direct IO does not appear to be installed for more info see: http://www.php.net/manual/en/book.dio.php" );
    exit;
}

try 
{
    //the serial port resource
    $bbSerialPort;
    
    echoFlush(  "Connecting to serial port: {$portName}" );
    
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') 
    { 
        $bbSerialPort = dio_open($portName, O_RDWR );
        exec("mode {$portName} baud={$baudRate} data={$bits} stop={$spotBit} parity=n xon=on");
    } 

    if(!$bbSerialPort)
    {
        echoFlush( "Could not open Serial port {$portName} ");
        exit;
    }

    // sleep(2);
    $data = dio_read($bbSerialPort, 20); //this is a blocking call
    if ($data) {
        echoFlush($data);
    } 

    dio_close($bbSerialPort);

} 
catch (Exception $e) 
{
    echoFlush(  $e->getMessage() );
    exit(1);
} 

?>