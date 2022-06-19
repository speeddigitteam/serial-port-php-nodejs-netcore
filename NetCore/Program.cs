using System;
using System.IO.Ports;
using System.Collections.Generic;
using System.Threading;

var _mySerialPort = new SerialPort("COM3");
_mySerialPort.BaudRate = 9600;
_mySerialPort.Parity = Parity.None;
_mySerialPort.StopBits = StopBits.One;
_mySerialPort.DataBits = 8;
_mySerialPort.Handshake = Handshake.None;
// _mySerialPort.DataReceived += new SerialDataReceivedEventHandler(DataReceivedHandler);

_mySerialPort.Open();
var myData = _mySerialPort.ReadByte();
Console.WriteLine(myDat);


// Console.WriteLine(_mySerialPort.IsOpen);
// _mySerialPort.Close();
// // Console.WriteLine(_mySerialPort.IsOpen);

// static void DataReceivedHandler(object sender, SerialDataReceivedEventArgs e)
// {
//     SerialPort sp = (SerialPort) sender;
//     string indata = sp.ReadExisting();
//     // Console.WriteLine(indata);
// }