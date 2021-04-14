<?php
require 'autoload.php';
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintBuffers\ImagePrintBuffer;
use Mike42\Escpos\GdEscposImage;


$connector = new WindowsPrintConnector("POS58SERIES");
$printer = new Printer($connector);

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$logo = EscposImage::load("logo.jpg", false);
   $printer -> bitImageColumnFormat($logo);

$printer->cut();
$printer->close();
