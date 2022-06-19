const { SerialPort } = require('serialport');

const port = new SerialPort({
    path: 'COM3',
    baudRate: 9600
});

const list = SerialPort.list().then(data => console.log(data));