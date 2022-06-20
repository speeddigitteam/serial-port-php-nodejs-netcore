const { SerialPort } = require('serialport');

const port = new SerialPort({
    path: 'COM1',
    baudRate: 9600
});

let amount = 1200;
setInterval(function() {
    port.write(amount.toString() + "*");
    amount += 1;

}, 100);

