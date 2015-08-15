<?php

namespace Phpimageprescaler\PIP;


use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

abstract class Source
{
    private $source_file;
    private $extension;

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @return mixed
     */
    public function getSourceFile()
    {
        return $this->source_file;
    }

    abstract public function imageCreateFrom($resource, $crop);

    abstract public function showImage($resource, $filename, $quality);

    public function __construct()
    {
        $requested_uri = parse_url(urldecode($_SERVER['REQUEST_URI']), PHP_URL_PATH);

        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $requested_uri)) {

            header('HTTP/1.0 404 Not Found');
            echo "File not found";
            exit;
        } else if(!is_readable($_SERVER['DOCUMENT_ROOT'] . $requested_uri)) {
            header('HTTP/1.0 403 Forbidden');
            echo "File not readable";
            exit;
        }

        $this->setSourceFile($_SERVER['DOCUMENT_ROOT'] . $requested_uri);
        $this->setExtension(strtolower(pathinfo($this->getSourceFile(), PATHINFO_EXTENSION)));

        return $this;
    }

    /**
     * @param string $extension
     */
    private function setExtension($extension)
    {
        $this->extension = $extension;
    }

    /**
     * @param mixed $source_file
     * @return $this
     */
    private function setSourceFile($source_file)
    {
        $this->source_file = $source_file;
        return $this;
    }

    protected function crop($dimension)
    {

        // la magie crop se fait la
        /* Create 75x75 format */
        $imagine = new Imagine();
        $size = new Box($dimension, $dimension);
        $mode = ImageInterface::THUMBNAIL_OUTBOUND;
        $imagine
            ->open($this->getSourceFile())
            ->thumbnail($size, $mode)
            ->show('jpg');
        ;
        var_dump($imagine); die();
    }
}
