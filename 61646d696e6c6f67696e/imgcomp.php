<?php
$directorys = array(
    '../padhivetram/iexpense',
    '../padhivetram/calls',
    '../padhivetram/tickets',
    '../padhivetram/site'
);
foreach ($directorys as $directory) {
    $images = glob($directory . "/*.jpg");
    foreach ($images as $image) {
        // Load the image
        $img = imagecreatefromjpeg($image);

        // Compress the image progressively in chunks
        ob_start();
        imagejpeg($img, NULL, 10); // Compress the image to quality 10 (adjust as needed)
        $compressed_image = ob_get_clean();

        // Write the compressed image back to the file
        file_put_contents($image, $compressed_image);

        // Free up memory
        imagedestroy($img);
    }
}
header("location:filemanager.php?remarks=The image has been compressed successfully");
?>