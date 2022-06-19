const { SerialPort } = require('serialport');

const port = new SerialPort({
    path: 'COM1',
    baudRate: 9600
});


let i = 1200;
let weight = {
    amount: i 
};

// port.write(JSON.stringify(weight));

setInterval(function() {
    port.write(JSON.stringify(weight));
    weight.amount += 1;
}, 100);

