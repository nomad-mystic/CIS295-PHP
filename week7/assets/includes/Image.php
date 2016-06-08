<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/26/2016
 * Time: 12:46 AM
 */



class Image
{
    private $m_id = 0;

    public function __construct($type, $size, $width, $height, $data)
    {
        $database = new SharerDatabase();
        $this->m_id = $database->insertImage($type, $size, $width, $height, $data);
    }

    public function getID()
    {
        return $this->m_id;
    }
} // end Image class