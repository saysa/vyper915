<?php

namespace Phpimageprescaler\PIP;

class Config
{

    private $resolutions;
    private $sharpen;
    private $cache_path;
    private $browser_cache;
    private $debug_mode;
    private $jpg_quality;
    private $jpg_quality_retina;
    private $retina;
    private $setup = array();
    private $images_param = array();
    private $type;
    private $image_filter;
    private $crop;

    /**
     * @param mixed $image_filter
     * @return $this
     */
    private function setImageFilter($image_filter)
    {
        $this->image_filter = $image_filter;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageFilter()
    {
        return $this->image_filter;
    }

    /**
     * @return $this
     */
    private function setType()
    {
        $this->type = (isset($_GET['size'])) ? $_GET['size'] : false;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param boolean $boolean
     * @return $this
     */
    private function setRetina($boolean)
    {
        $this->retina = $boolean;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRetina()
    {
        return $this->retina;
    }

    /**
     * @param mixed $jpg_quality_retina
     * @return $this
     */
    private function setJpgQualityRetina($jpg_quality_retina)
    {
        $this->jpg_quality_retina = $jpg_quality_retina;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getJpgQualityRetina()
    {
        return $this->jpg_quality_retina;
    }

    /**
     * @param mixed $jpg_quality
     * @return $this
     */
    public function setJpgQuality($jpg_quality)
    {
        $this->jpg_quality = $jpg_quality;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getJpgQuality()
    {
        return $this->jpg_quality;
    }

    /**
     * @param boolean $boolean
     * @return $this
     */
    private function setDebugMode($boolean)
    {
        $this->debug_mode = $boolean;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDebugMode()
    {
        return $this->debug_mode;
    }

    /**
     * How long the BROWSER cache should last (seconds, minutes, hours, days. 7days by default)
     *
     * @param int $browser_cache
     * @return $this
     */
    private function setBrowserCache($browser_cache)
    {
        $this->browser_cache = $browser_cache;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBrowserCache()
    {
        return $this->browser_cache;
    }

    /**
     * @param mixed $cache_path
     * @return $this
     */
    private function setCachePath($cache_path)
    {
        $this->cache_path = $cache_path;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCachePath()
    {
        return $this->cache_path;
    }

    /**
     * @param boolean $sharpen
     * @return $this
     */
    private function setSharpen($sharpen)
    {
        $this->sharpen = $sharpen;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getSharpen()
    {
        return $this->sharpen;
    }

    /**
     * @param mixed $resolutions
     * @return $this
     */
    private function setResolutions($resolutions)
    {
        $this->resolutions = $resolutions;
        return $this;
    }


    public function setCrop()
    {
        if (!array_key_exists($this->type, $this->setup)) return false;

        if (isset($this->setup[$this->type]['crop'])) {
            $this->crop = $this->setup[$this->type]['crop'];
        } else {
            $this->crop = false;
        }


        return $this;
    }

    /**
     * @return mixed
     */
    public function getCrop()
    {
        return $this->crop;
    }

    /**
     * @return mixed
     */
    public function getResolutions()
    {
        return $this->resolutions;
    }

    /**
     * @return $this|bool
     */
    public function setImgParams()
    {
        if (!array_key_exists($this->type, $this->setup)) return false;

        foreach ($this->setup[$this->type]['dimensions'] as $key => $breakpoint) {
            $this->images_param[$key]['val'] = $breakpoint;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getImagesParam()
    {
        return $this->images_param;
    }

    /**
     * @param $file
     */
    private function initializeFromJsonFile($file)
    {
        $this->initialize(json_decode(file_get_contents($file), true));
    }

    /**
     * @param $options
     * @return $this
     */
    public function initialize($options)
    {
        if (isset($options['resolutions'])) $this->setResolutions($options['resolutions']);
        if (isset($options['sharpen'])) $this->setSharpen($options['sharpen']);
        if (isset($options['cache_path'])) $this->setCachePath($options['cache_path']);
        if (isset($options['browser_cache'])) $this->setBrowserCache($options['browser_cache']);
        if (isset($options['debug_mode'])) $this->setDebugMode($options['debug_mode']);
        if (isset($options['jpg_quality'])) $this->setJpgQuality($options['jpg_quality']);
        if (isset($options['jpg_quality_retina'])) $this->setJpgQualityRetina($options['jpg_quality_retina']);
        if (isset($options['retina'])) $this->setRetina($options['retina']);
        if (isset($options['setup'])) $this->setup = $options['setup'];
        if (isset($options['setup'][$this->getType()]['filter'])) $this->setImageFilter($options['setup'][$this->getType()]['filter']);

        return $this;
    }

    public function __construct($config = null)
    {
        $this->setRetina(true);
        $this->setJpgQuality(80);
        $this->setJpgQualityRetina(80);
        $this->setDebugMode(true);
        $this->setBrowserCache(60 * 60 * 24 * 7);
        $this->setCachePath("cache/pip");
        $this->setSharpen(true);
        $this->setType();
        $this->setResolutions(array(
            'mobile' => 0,
            'medium' => 1000,
            'large' => 1300
        ));

        if (is_array($config)) {

            $this->initialize($config);
        } elseif (is_file($config) && strtolower(pathinfo($config, PATHINFO_EXTENSION)) == 'json') {

            $this->initializeFromJsonFile($config);
        }
    }

    /**
     * @param $file
     * @return int
     */
    public function persistToJsonFile($file)
    {
        $config = array();
        $config['debug_mode']           = $this->getDebugMode();
        $config['retina']               = $this->getRetina();
        $config['jpg_quality']          = $this->getJpgQuality();
        $config['jpg_quality_retina']   = $this->getJpgQualityRetina();
        $config['browser_cache']        = $this->getBrowserCache();
        $config['cache_path']           = $this->getCachePath();
        $config['sharpen']              = $this->getSharpen();
        $config['resolutions']          = $this->getResolutions();
        $config['setup']                = $this->setup;

        return file_put_contents($file, json_encode($config, constant('JSON_PRETTY_PRINT')));
    }
} 