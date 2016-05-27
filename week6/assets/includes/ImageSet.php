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
    const THUMBNAIL_SIZE = 128;


    public function createPageImage($source_image)
    {
        $image = $source_image->coalesceImages();
        $d = $image->getImageGeometry();

        foreach ($image as $frame) {
            $frame->scaleImage(ImageSet::PAGE_IMAGE_WIDTH, 0);
            // positioning images at absolute 0 0 0 0
            $frame->setImagePage(0, 0, 0, 0);
        }

        $page_blob = $image->getImageBlob();
        $page_d = $image->getImageGeometry();

        return $page_blob;
    }

    public function createThumbnailImage($source_image)
    {
        $image = $source_image->coalesceImages();
        $d = $image->getImageGeometry();

        // cropping image
        if ($d['width'] <= $d['height']) {
            foreach ($image as $frame) {
                $frame->scaleImage(ImageSet::THUMBNAIL_SIZE, 0);
                $thumbnail_d = $image->getImageGeometry();
                $frame->cropImage(
                    ImageSet::THUMBNAIL_SIZE,
                    ImageSet::THUMBNAIL_SIZE,
                    0,
                    ($thumbnail_d['height'] - ImageSet::THUMBNAIL_SIZE) / 2
                );
                // positioning images at absolute 0 0 0 0
                $frame->setImagePage(0, 0, 0, 0);
            }
        } else {
            foreach ($image as $frame) {
                $frame->scaleImage(0, ImageSet::THUMBNAIL_SIZE);
                $thumbnail_d = $image->getImageGeometry();
                $frame->cropImage(
                    ImageSet::THUMBNAIL_SIZE,
                    ImageSet::THUMBNAIL_SIZE,
                    ($thumbnail_d['width'] - ImageSet::THUMBNAIL_SIZE) / 2,
                    0
                );
                // positioning images at absolute 0 0 0 0
                $frame->setImagePage(0, 0, 0, 0);
            }
        }
        $page_blob = $image->getImageBlob();
        $page_d = $image->getImageGeometry();

        return $page_blob;
    }

}