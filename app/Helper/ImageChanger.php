<?php 

   namespace App\Helper;

   class ImageChanger{


    function convertSvgToPng($svgContent, $width = 200, $height = 200)
{
    $im = imagecreate($width, $height);
    $white = imagecolorallocate($im, 255, 255, 255); // Set background to white
    imagefill($im, 0, 0, $white);

    // Load the SVG as an image
    $image = new Imagick();
    $image->readImageBlob($svgContent);
    $image->setImageFormat('png');

    ob_start();
    imagepng($im);
    $pngData = ob_get_clean();

    imagedestroy($im);

    return $pngData;
}

   }