<?php

error_reporting(E_ALL);
//-- settings --//

//brainboxes serial ports
//on 'nix start with cu.usbserial-
//on windows starts with com : must be lower case in windows and end with a colon
$portName = 'COM2';
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


try 
{
	//the serial port resource
	$bbSerialPort;
	
	echoFlush(  "Connecting to serial port: {$portName}" );

	
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') 
	{ 

		$bbSerialPort = dio_open($portName, O_RDWR );
		//we're on windows configure com port from command line
		// exec("mode {$portName} baud={$baudRate} data={$bits} stop={$spotBit} parity=n xon=on");
	} 

	if(isset($bbSerialPort))
	{
		// var_dump($bbSerialPort);
		// exit;

		// sleep(3);
		$data = dio_read($bbSerialPort, 256); //this is a blocking call
		if ($data) {
			echoFlush(  "Data Received: ". $data );
		}
		echoFlush(  "Closing Port" );
		// dio_close($bbSerialPort);
	}
	
} 
catch (Exception $e) 
{
	echoFlush(  $e->getMessage() );
	exit(1);
} 

?>