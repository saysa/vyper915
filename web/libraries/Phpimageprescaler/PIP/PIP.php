<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 01/07/2014
 * Time: 16:45
 */

namespace Phpimageprescaler\PIP;


class PIP
{

    private $config;
    private $src;
    private $requested_uri;
    private $class = array();
    private $options = array();

    /**
     * Constructor
     * @param array $config The config
     * @param bool $debug_mode
     */
    public function __construct($config = null, $debug_mode = false)
    {
        spl_autoload_register(array($this, "autoload"));
        ini_set('memory_limit', '256M');

        $this->requested_uri = parse_url(urldecode($_SERVER['REQUEST_URI']), PHP_URL_PATH);
        $request = $_SERVER['DOCUMENT_ROOT'] . $this->requested_uri;

        if (file_exists($request) && is_file($request) && is_readable($request)) {

            $this->config = new Config($config);
            $extension = strtolower(pathinfo($this->requested_uri, PATHINFO_EXTENSION));

            switch ($extension) {
                case 'png':
                    $this->src = new SourcePng();
                    break;
                case 'gif':
                    $this->src = new SourceGif();
                    break;
                default:
                    $this->src = new SourceJpg();
                    break;
            }
        }
    }

    /**
     * Includes all the required class
     */
    private static function autoload($class)
    {
        include_once "Config.php";
        include_once "JSONEncoder.php";
        include_once "PhpImagePrescaler.php";
        include_once "PipClass.php";
        include_once "Source.php";
        include_once "SourceGif.php";
        include_once "SourceJpg.php";
        include_once "SourcePng.php";
    }

    public function createClass($class_name)
    {
        $this->class[$class_name] = new PipClass($class_name);
        return $this;
    }

    public function getClass($name)
    {
        return $this->class[$name];
    }

    public function set(array $option)
    {
        $this->options[] = $option;
        return $this;
    }

    public function getOption()
    {
        return $this->options;
    }

    /**
     * @param mixed $boolean
     * @return $this
     */
    public function setDebug($boolean)
    {
        if (!is_bool($boolean)) return false;
        $debug = array('debug_mode' => $boolean);
        $this->set($debug);
        return $this;
    }

    /**
     * @param mixed $int
     * @return $this
     */
    public function setJpgQuality($int)
    {
        if (!is_int($int)) return false;
        if ($int < 0 || 100 < $int) return false;

        $debug = array('jpg_quality' => $int);
        $this->set($debug);
        return $this;
    }



    /**
     * Set the config
     * Write the option json file
     */
    public function persist()
    {
        $options = array();

        foreach ($this->class as $pip_class) {

            foreach ($pip_class->getWidth() as $name => $width) {

                $options['setup'][$pip_class->getName()]['dimensions'][$name]['w'] = $width;
            }

            foreach ($pip_class->getHeight() as $name => $height) {

                $options['setup'][$pip_class->getName()]['dimensions'][$name]['h'] = $height;
            }

            foreach ($pip_class->getFilter() as $filter_container) {

                foreach ($filter_container as $filter => $value) {
                    $options['setup'][$pip_class->getName()]['filter'][$filter] = $value;
                }
            }

            foreach ($this->getOption() as $option_container) {

                foreach ($option_container as $option => $value) {
                    $options[$option] = $value;
                }
            }

        }

        $this->config->initialize($options);
        return $this;
    }

    public function persistToJsonFile($file)
    {
        $this->persist();
        $this->config->persistToJsonFile($file);
    }

    public function run()
    {
        $o = new PhpImagePrescaler($this->src, $this->config);
        (isset($_GET['size'])) ? $o->initialize()->sendImage() : $o->sendImage($this->requested_uri);
    }
} 