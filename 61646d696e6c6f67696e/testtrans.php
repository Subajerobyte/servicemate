<?php
$img = imagecreatefrompng('../padhivetram/sig/61b830b771c65.png');
$white = imagecolorallocate($img, 255, 255, 255);
imagecolortransparent($img, $white);
imagepng($img, "../padhivetram/sig/61b830b771c65.png");
?>