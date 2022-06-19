<?php

//both exec work
//exec('mode com6: baud=115200 data=8 stop=1 parity=n xon=off dtr=off rts=off');
exec('mode COM3: baud=115200 data=8 stop=1 parity=n xon=off dtr=off rts=off');

$fd = dio_open(realpath(dirname($path))."/".basename($path), O_WRONLY | O_CREAT, 0644); //<--works
// $fd = dio_open('\\\\.\COM3', O_RDWR); //<-- dont work (invalid argument)

$command="\x11\x0E\x1B\x44\x4C\x1B\x47\x44\x00\x00\x00\x00\x3F\x01\xEF\x00\x9F\x00";
$len=17;

$bytes_written = dio_write($fd,$command,$len);

echo $bytes_written;

dio_close($fd);

?>