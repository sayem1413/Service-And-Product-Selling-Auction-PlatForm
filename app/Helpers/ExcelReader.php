<?php
/**
 * Created by PhpStorm.
 * @author Sakib Rahman
 * User: ByteLab
 * Date: 9/24/2018
 * Time: 12:38 PM
 */

namespace App\Helper;
use Excel;

class ExcelReader
{
    /**
     * @var $data - Extracted data
     * @var $fileExists - Target file found or not
     */
    protected $data;
    protected $fileExist = false ;

    /**
     * ExcelReader constructor.
     *
     * Initializes input file with Excel import library
     *
     * @param $file_path
     */
    public function __construct($file_path)
    {
        if(file_exists($file_path)) {

            $this->data = Excel::load($file_path, function (){})->get();
            $this->fileExist = true;

        } else {
            echo ($file_path." does not exist, cannot read and import data");
        }
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function fileExists()
    {
        return $this->fileExist;
    }


}