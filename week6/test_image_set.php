<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/26/2016
 * Time: 8:47 PM
 */


require_once('assets/includes/ImageSet.php');

$image_set = new ImageSet();

// tmp get image
$data = file_get_contents('assets/images/test_image_png.png');
$image = new Imagick();
$image->readImageBlob($data);

$blob = $image_set->createThumbnailImage($image);

header('Content-Type: image/png');
echo $blob;