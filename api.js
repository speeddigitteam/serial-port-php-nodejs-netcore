const express = require('express');
const app = express();
const bodyParser= require('body-parser');
app.use(bodyParser.urlencoded({ extended: true }));

const { SerialPort } = require('serialport');
const port = new SerialPort({
    path: 'COM5',
    baudRate: 57600
});

app.get('/', (req, res) => {
    port.on('data', (line) => {
        console.log('On data');
        res.json(line.toString('utf-8'));
    })
    .on('error', err => {
        console.log(err);
    })
});

app.listen(3000, function() {
    console.log(`Server running on port 3000`);
});