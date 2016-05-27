<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/26/2016
 * Time: 12:46 AM
 */



class Image
{
    const FILE_KEY = 'file';
    const FILE_TYPE = 'type';
    const FILE_SIZE = 'size';
    const FILE_TMP_NAME = 'tmp_name';

    private $m_id = 0;

    public function __construct($file)
    {
        $database = new SharerDatabase();
        $size = $file[Image::FILE_SIZE];
        $type = $file[Image::FILE_TYPE];
        $data = file_get_contents($file[Image::FILE_TMP_NAME]);

        $image = new Imagick();
        $image->readImageBlob($data);
        $coalesced = $image->coalesceImages();
        $d = $coalesced->getImageGeometry();

        $this->m_id = $database->insertImage($type, $size, $d['width'], $d['height'],  $data);
    }

    public function getId()
    {
        return $this->m_id;
    }
} // end Image class