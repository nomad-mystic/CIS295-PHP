<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/26/2016
 * Time: 8:36 PM
 */


class ImageSet
{
    const FILE_KEY = 'file';
    const FILE_TYPE = 'type';
    const FILE_SIZE = 'size';
    const FILE_TMP_NAME = 'tmp_name';
    const FILE_NAME = 'name';

    // sharing constants
    const SHARING_PRIVATE = 'private';
    const SHARING_PUBLIC = 'public';

    const PAGE_IMAGE_WIDTH = 800;
    const THUMBNAIL_SIZE = 128;

    const IMAGE_SET_ID_KEY = 'id';
    const IMAGE_SET_SIZE_KEY = 'size';
    
    // private variables
    private $m_id = 0;

    // upload files constructor
    public function __construct($file)
    {
        $size = $file[ImageSet::FILE_SIZE];
        $type = $file[ImageSet::FILE_TYPE];
        $data = file_get_contents($file[ImageSet::FILE_TMP_NAME]);
        $name = $file[ImageSet::FILE_NAME];

        $image = new Imagick();
        $image->readImageBlob($data);

        $coalesced = $image->coalesceImages();
        $d = $coalesced->getImageGeometry();

        $width = $d['width'];
        $height = $d['height'];
        $original = new Image($type, $size, $width, $height, $data);

        // for creating full size image
        $page = ImageSet::createPageImage($image);
        $data = $page->getImageBlob();
        $page->coalesceImages();
        $d = $page->getImageGeometry();

        $size = strlen($data);
        $width = $d['width'];
        $height = $d['height'];

        $page_image = new Image($type, $size, $width, $height, $data);

        // for creating thumbnail image
        $thumb = ImageSet::createThumbnailImage($page);

//        $page = ImageSet::createPageImage($image);
        $data = $thumb->getImageBlob();
        $thumb->coalesceImages();
        $d = $thumb->getImageGeometry();

        $size = strlen($data);
        $width = $d['width'];
        $height = $d['height'];

        $thumb_image = new Image($type, $size, $width, $height, $data);

        // Marc / Nomad Notes
        // this is where my program breaks
        // it creates three images in the database of the three different sizes
        // and the imagesets table ID's are all the same
        // This is the function I had before experimentation
        /* $this->m_id = $database->insertImageSet(
            User::getUser(),
                $name,
                ImageSet::SHARING_PRIVATE,
                $original_id->getId(),
                $original_id->getId(),
                $original_id->getId()
            );
        */
        $database = new SharerDatabase();
        $this->m_id = $database->insertImageSet(
            User::getUser(),
            $name,
            ImageSet::SHARING_PRIVATE,
            $page_image->getId(),
            $page_image->getId(),
            $page_image->getId()
        );
    } // end __construct()

    public function getID()
    {
        return $this->m_id;
    }

    private static function createPageImage($source_image)
    {
        $image = $source_image->coalesceImages();
        $d = $image->getImageGeometry();

        foreach ($image as $frame) {
            $frame->scaleImage(ImageSet::PAGE_IMAGE_WIDTH, 0);
            // positioning images at absolute 0 0 0 0
            $frame->setImagePage(0, 0, 0, 0);
        }

        return $image;
    } // end createPageImage()

    private static function createThumbnailImage($source_image)
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

        return $image;
    } // end createThumbnailImage()

    public static function fetchImage($set_id, $size_type_key)
    {
        $database = new SharerDatabase();
        return $database->fetchImage($set_id, $size_type_key);
    } // end fetchImage()
} // end ImageSet class