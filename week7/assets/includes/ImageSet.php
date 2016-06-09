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
        $type = $file[ImageSet::FILE_TYPE];

        $original_size = $file[ImageSet::FILE_SIZE];
        $original_data = file_get_contents($file[ImageSet::FILE_TMP_NAME]);
        $name = $file[ImageSet::FILE_NAME];

        $image = new Imagick();
        $image->readImageBlob($original_data);

        $coalesced = $image->coalesceImages();
        $d = $coalesced->getImageGeometry();

        $original_width = $d['width'];
        $original_height = $d['height'];


        // for creating full size image
        $page = ImageSet::createPageImage($image);
        $page_data = $page->getImagesBlob();
        $page->coalesceImages();
        $d = $page->getImageGeometry();

        $page_size = strlen($page_data);
        $page_width = $d['width'];
        $page_height = $d['height'];



        // for creating thumbnail image
        $thumb = ImageSet::createThumbnailImage($page);

//        $page = ImageSet::createPageImage($image);
        $thumb_data = $thumb->getImagesBlob();
        $thumb->coalesceImages();
        $d = $thumb->getImageGeometry();

        $thumb_size = strlen($thumb_data);
        $thumb_width = $d['width'];
        $thumb_height = $d['height'];

        // Marc / Nomad Notes - week 6
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
        /*--Changed in week 7--*/
//        $original_id = new Image($type, $original_size, $original_width, $original_height, $original_data);
//        $page_id = new Image($type, $page_size, $page_width, $page_height, $page_data);
//        $thumb_id = new Image($type, $thumb_size, $thumb_width, $thumb_height, $thumb_data);
//
//        $database = new SharerDatabase();
//        $this->m_id = $database->insertImageSet(
//            User::getUser(),
//            $name,
//            ImageSet::SHARING_PRIVATE,
//            $original_id->getID(),
//            $page_id->getID(),
//            $thumb_id->getID()
//        );
        /*---changed in week 7--*/
        $database = new SharerDatabase();
        $database->createImageSet(
            User::getUser(),
            $name,
            ImageSet::SHARING_PRIVATE,
            $type, $original_size, $original_width, $original_height, $original_data,
            $page_size, $page_width, $page_height, $page_data,
            $thumb_size, $thumb_width, $thumb_height, $thumb_data
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

        $page_blob = $image->getImagesBlob();
        $page_d = $image->getImageGeometry();

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