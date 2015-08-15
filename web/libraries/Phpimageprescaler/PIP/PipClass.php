<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 02/07/2014
 * Time: 13:06
 */

namespace Phpimageprescaler\PIP;


class PipClass
{

    private $name;
    private $width = array();
    private $height = array();
    private $filter = array();

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param $width
     * @return $this
     */
    public function setWidth($width)
    {
        if (is_array($width)) {

            $this->width = $width;

        } elseif (is_numeric($width)) {

            $this->width[0] = $width;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param $height
     * @return $this
     */
    public function setHeight($height)
    {
        if (is_array($height)) {

            $this->height = $height;

        } elseif (is_numeric($height)) {

            $this->height[0] = $height;
        }

        return $this;
    }

    /**
     * @param array $filter
     * @return $this
     */
    public function setFilter(array $filter)
    {
        $this->filter[] = $filter;
        return $this;
    }

    /**
     * @return array
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Constructor
     * @param $name
     */
    public function __construct($name)
    {
        $this->setName($name);
    }


}