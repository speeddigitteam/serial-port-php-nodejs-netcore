const { SerialPort } = require('serialport');

const port = new SerialPort({
    path: 'COM2',
    baudRate: 9600
});

//port.close();
port.on('data', line => console.log(line.toString('utf-8')));
port.on('error', err => console.log(err));
