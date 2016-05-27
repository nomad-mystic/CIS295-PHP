<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/26/2016
 * Time: 8:36 PM
 */


class ImageSet
{
    // sharing constants
    const SHARING_PRIVATE = 'private';
    const SHARING_PUBLIC = 'public';

    const PAGE_IMAGE_WIDTH = 800;
    const THUMBNAIL_IMAGE_WIDTH = 128;
    const THUMBNAIL_IMAGE_HEIGHT = 128;


    public function createPageImage($source_image)
    {
        $image = $source_image->coalesceImages();
        $data = $image->getImageGeometry();

        foreach ($image as $frame) {
            $frame->scaleImage(ImageSet::PAGE_IMAGE_WIDTH, 0);
            // positioning images at absolute 0 0 0 0
            $frame->setImagePage(0, 0, 0, 0);
        }

        $page_blob = $image->getImageBlob();
        $page_data = $image->getImageGeometry();

        return $page_blob;
    }

}