<?php
ini_set('display_errors', 1);

require_once "../imagine/Image/PointInterface.php";
require_once "../imagine/Image/Point.php";
require_once "../imagine/Image/ManipulatorInterface.php";
require_once "../imagine/Image/ImageInterface.php";
require_once "../imagine/Gd/Image.php";
require_once "../imagine/Image/Palette/ColorParser.php";
require_once "../imagine/Image/Palette/PaletteInterface.php";
require_once "../imagine/Image/Palette/RGB.php";
require_once "../imagine/Image/BoxInterface.php";
require_once "../imagine/Image/Box.php";
require_once "../imagine/Image/ImagineInterface.php";
require_once "../imagine/Gd/Imagine.php";
require_once "PIP/PIP.php";
$pip = new \Phpimageprescaler\PIP\PIP('pip_config.json');
$pip->run();
