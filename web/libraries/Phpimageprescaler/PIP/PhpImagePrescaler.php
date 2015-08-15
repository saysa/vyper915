<?php
/**
 * Adaptive-Images ( is based on and inspired from "Adaptive Images" by Matt Wilcox )
 *
 * forked from:
 * GitHub:        https://github.com/MattWilcox/Adaptive-Images
 * Version:    1.5.2
 * Homepage:    http://adaptive-images.com
 * Twitter:    @responsiveimg
 * LEGAL:        Adaptive Images by Matt Wilcox is licensed under a Creative Commons Attribution 3.0 Unported License.
 *
 * extended by:
 * GitHub:        https://github.com/johannheyne/adaptive-images-for-wordpress
 * Version:    1.2
 * Changed:    2014.03.06 14:35
 */


namespace Phpimageprescaler\PIP;


class PhpImagePrescaler
{
    /**
     * @var Source
     */
    private $source_file;
    private $current_breakpoint;
    private $img_setup_width;
    private $img_setup_height;
    private $cache_file;
    private $pixel_density;
    private $generated_image;
    private $config;

    /**
     * @param mixed $config
     */
    private function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    private function getConfig()
    {
        return $this->config;
    }

    public function initialize()
    {
        $this->setCookieResolution();
        $this->setImgParams();
        $this->setCrop();
        $cookie_data = explode(",", $_COOKIE['resolution']);
        if (@$cookie_data[1]) $this->setPixelDensity($cookie_data[1]);
        if ($this->getRetina() == false) $this->setPixelDensity(1);
        if ($this->getPixelDensity() >= 2) $this->setJpgQuality($this->getJpgQualityRetina());
        $this->setImgSetup();
        $this->generateResourceImage();

        return $this;
    }

    public function sendImage($file = null)
    {
        if ($file !== null) {
            $file = $this->getSourceFile();
        } elseif (file_exists($this->getCacheFile()) && !$this->getDebugMode()) {
            $file = $this->getCacheFile();
        } else {
            $file = $this->generateCacheFile($this->getGeneratedImage());
        }

        $this->setContentType();
        header("Cache-Control: private, max-age=" . $this->getBrowserCache());
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $this->getBrowserCache()) . ' GMT');
        header('Content-Length: ' . filesize($file));
        readfile($file);

        exit();
    }

    public function __construct(Source $source, Config $config)
    {
        $this->setSourceFile($source);
        $this->setConfig($config);
        $this->setCurrentBreakpoint('undefined');
        $this->setImgSetupHeight(false);
        $this->setImgSetupWidth(false);
        $this->setPixelDensity(1);
        $this->setCacheFile();
    }

    /**
     * Apply a 3x3 convolution matrix, using coefficient and offset
     *
     * @param $img
     * @return $this
     */
    private function sharpen($img)
    {
        if (function_exists('imageconvolution')) {

            $img_src = $this->getSourceFileDimensions();
            $img_scaled = $this->getImgScaledSize();
            $intSharpness = $this->findSharp($img_src[0], $img_scaled['w']);
            $arrMatrix = array(
                array(-1, -2, -1),
                array(-2, $intSharpness + 12, -2),
                array(-1, -2, -1)
            );
            imageconvolution($img, $arrMatrix, $intSharpness, 0);
        }

        return $this;
    }

    private function applyImageFilter($config, $src)
    {
        foreach ($config as $key => $value) {

            if ($value !== false) {

                if ($value === true) {

                    imagefilter($src, constant($key));
                } elseif (is_array($value)) {

                    if (count($value) === 2) {

                        imagefilter($src, constant($key), $value[0], $value[1]);
                    }

                    if (count($value) === 3) {

                        imagefilter($src, constant($key), $value[0], $value[1], $value[2]);
                    }
                } else {

                    imagefilter($src, constant($key), $value);
                }
            }
        }

        return $this;
    }

    /**
     * generates the resource file with the given resolution
     *
     * @return mixed
     */
    private function generateResourceImage()
    {

        $img_new = $this->getImgNewSize();
        $img = imagecreatetruecolor($img_new['w'], $img_new['h']); // FIXME Warning: imagecreatetruecolor(): Invalid image dimensions
        $src = $this->source_file->imageCreateFrom($img, $this->getConfig()->getCrop());

        if ($this->getSourceFileExtension() == 'png') {
            imagealphablending($img, false);
            imagesavealpha($img, true);
            $transparent = imagecolorallocatealpha($img, 255, 255, 255, 127);
            imagefilledrectangle($img, 0, 0, $img_new['w'], $img_new['h'], $transparent);
        }

        if (is_array($this->getConfig()->getImageFilter())) {
            $this->applyImageFilter($this->getConfig()->getImageFilter(), $src);
        }

        $img_scaled = $this->getImgScaledSize();
        $src_file = $this->getSourceFileDimensions();




        if (is_resource($src)) {
            imagecopyresampled($img, $src, 0, 0, 0, 0, $img_scaled['w'], $img_scaled['h'], $src_file[0], $src_file[1]); // do the resize in memory
            imagedestroy($src);
        } else {
            $this->sendErrorImage("imagecopyresampled() expects parameter 1 to be resource");
        }

        if ($this->getSharpen()) $this->sharpen($img);

        if ($this->getDebugMode()) {

            $color = imagecolorallocate($img, 255, 0, 0); // ugly red FIXME Warning: imagecolorallocate() expects parameter 1 to be resource, boolean given
            imagestring($img, 5, 10, 5, ceil($img_new['w']) . ' x ' . ceil($img_new['h']), $color); // FIXME Warning: imagestring() expects parameter 1 to be resource, boolean given
            imagestring($img, 5, 10, 20, $_COOKIE['resolution'], $color); // FIXME Warning: imagestring() expects parameter 1 to be resource, boolean given
        }

        $this->setGeneratedImage($img);
        return $this;
    }

    /**
     * generates the given cache file for the given source file
     *
     * @param $img : generated source file
     * @return mixed
     */
    private function generateCacheFile($img)
    {
        $cache_dir = dirname($this->getCacheFile());
        $this->createCacheDir($cache_dir, $img);

        if (!is_writable($cache_dir)) {
            $this->sendErrorImage("The cache directory is not writable: $cache_dir");
        }

        $gotSaved = $this->source_file->showImage($img, $this->getCacheFile(), $this->getJpgQuality());
        imagedestroy($img); // FIXME Warning: imagedestroy() expects parameter 1 to be resource, boolean given

        if (!$gotSaved && !file_exists($this->getCacheFile())) {
            $this->sendErrorImage("Failed to create image: " . $this->getCacheFile());
        }

        return $this->getCacheFile();
    }

    /**
     * does the cookie look valid? [whole number, comma, potential floating number]
     *
     * @return bool
     */
    private function isCookieValid()
    {
        if (preg_match("/^[0-9]+[,]*[0-9\.]+$/", $_COOKIE['resolution'])) return true;
        else return false;
    }

    /**
     * @param $message
     */
    private function sendErrorImage($message)
    {

        /* get all of the required data from the HTTP request */
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        $requested_uri = parse_url(urldecode($_SERVER['REQUEST_URI']), PHP_URL_PATH);
        $requested_file = basename($requested_uri);
        $source_file = $this->getSourceFile();

        $im = imagecreatetruecolor(800, 300);
        $text_color = imagecolorallocate($im, 233, 14, 91);
        $message_color = imagecolorallocate($im, 91, 112, 233);

        imagestring($im, 5, 5, 5, "Adaptive Images encountered a problem:", $text_color);
        imagestring($im, 3, 5, 25, $message, $message_color);

        imagestring($im, 5, 5, 85, "Potentially useful information:", $text_color);
        imagestring($im, 3, 5, 105, "DOCUMENT ROOT IS: $document_root", $text_color);
        imagestring($im, 3, 5, 125, "REQUESTED URI WAS: $requested_uri", $text_color);
        imagestring($im, 3, 5, 145, "REQUESTED FILE WAS: $requested_file", $text_color);
        imagestring($im, 3, 5, 165, "SOURCE FILE IS: $source_file", $text_color);

        header("Cache-Control: no-store"); // FIXME (this collides with xdebug) Warning: Cannot modify header information - headers already sent by (output started at /vagrant/lib/php_image_prescaler-trunk/phpimageprescaler/phpimageprescaler.php:650)
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() - 1000) . ' GMT'); // FIXME Warning: Cannot modify header information - headers already sent by (output started at /vagrant/lib/php_image_prescaler-trunk/phpimageprescaler/phpimageprescaler.php:650)
        header('Content-Type: image/jpeg'); // FIXME Warning: Cannot modify header information - headers already sent by (output started at /vagrant/lib/php_image_prescaler-trunk/phpimageprescaler/phpimageprescaler.php:650)
        imagejpeg($im);
        imagedestroy($im);
        exit();
    }

    /**
     * @param $cache_dir
     * @param null $rsrc
     * @return $this
     */
    private function createCacheDir($cache_dir, $rsrc = null)
    {
        if (!is_dir($cache_dir)) {
            if (!mkdir($cache_dir, 0755, true)) {
                // check again if it really doesn't exist to protect against race conditions
                if (!is_dir($cache_dir)) {
                    // uh-oh, failed to make that directory
                    if ($rsrc) imagedestroy($rsrc);
                    $this->sendErrorImage("Failed to create cache directory: $cache_dir");
                }
            }
        }

        return $this;
    }

    /**
     * Ensure to have correct and valid cookie value
     *
     * @return $this
     */
    private function setCookieResolution()
    {
        if (!isset($_COOKIE['resolution'])) {

            $_COOKIE['resolution'] = '9999,1';

        } else {

            if (!$this->isCookieValid()) {

                setcookie("resolution", "", time() - 100); // delete the mangled cookie
                $_COOKIE['resolution'] = '9999,1';
            }
        }

        return $this;
    }

    /**
     * Set ImgSetup width and height
     *
     * @return $this
     */
    private function setImgSetup()
    {
        $cookie_data = explode(",", $_COOKIE['resolution']);
        $screen_width = (int)$cookie_data[0]; // the base resolution (CSS pixels)

        foreach ($this->getConfig()->getImagesParam() as $key => $item) {

            if (is_numeric($key)) {

                $breakpoint = $key;

            } else {

                $resolutions = $this->getResolutions();
                $breakpoint = $resolutions[$key];
            }

            if ($breakpoint <= $screen_width) {

                $this->setCurrentBreakpoint($breakpoint);

                if (!$this->getImgSetupWidth() || ($item['val']['w'] * $this->getPixelDensity()) > $this->getImgSetupWidth()) {

                    if (isset($item['val']['w'])) {

                        $this->setImgSetupWidth(ceil($item['val']['w'] * $this->getPixelDensity()));
                    }

                    if (isset($item['val']['h'])) {

                        $this->setImgSetupHeight(ceil($item['val']['h'] * $this->getPixelDensity()));
                    }
                }
            }
        }

        return $this;
    }

    /**
     * @param $intOrig
     * @param $intFinal
     * @return mixed
     */
    private function findSharp($intOrig, $intFinal)
    {
        $intFinal = $intFinal * (750.0 / $intOrig);
        $intA = 52;
        $intB = -0.27810650887573124;
        $intC = .00047337278106508946;
        $intRes = $intA + $intB * $intFinal + $intC * $intFinal * $intFinal;
        return max(round($intRes), 0);
    }

    /**
     * @return $this
     */
    private function setImgParams()
    {
        if ($this->getConfig()->setImgParams($this->getType())) return $this;
        else {
            $this->sendErrorImage($_GET['size'] . ' is not valid');
            return $this;
        }
    }

    /**
     * @return $this
     */
    private function setCrop()
    {
        if ($this->getConfig()->setCrop()) return $this;
        else {
            $this->sendErrorImage($_GET['size'] . ' is not valid');
            return $this;
        }
    }

    /**
     * @return $this
     */
    private function setContentType()
    {
        if (in_array($this->getSourceFileExtension(), array('png', 'gif', 'jpeg'))) {
            header("Content-Type: image/" . $this->getSourceFileExtension());
        } else {
            header("Content-Type: image/jpeg");
        }
        return $this;
    }

    /**
     * @return boolean
     */
    private function getSharpen()
    {
        return $this->getConfig()->getSharpen();
    }

    /**
     * @param mixed $generated_image
     * @return $this
     */
    private function setGeneratedImage($generated_image)
    {
        $this->generated_image = $generated_image;
        return $this;
    }

    /**
     * @return mixed
     */
    private function getGeneratedImage()
    {
        return $this->generated_image;
    }

    /**
     * @return mixed
     */
    private function getBrowserCache()
    {
        return $this->getConfig()->getBrowserCache();
    }

    /**
     * set a default, used for non-retina style JS snippet
     *
     * @param mixed $pixel_density
     * @return $this
     */
    private function setPixelDensity($pixel_density)
    {
        $this->pixel_density = $pixel_density;
        return $this;
    }

    /**
     * @return mixed
     */
    private function getPixelDensity()
    {
        return $this->pixel_density;
    }

    /**
     * @return mixed
     */
    private function getCachePath()
    {
        return $this->getConfig()->getCachePath();
    }

    /**
     * @return $this
     */
    private function setCacheFile()
    {
        $size = (isset($_GET['size'])) ? $_GET['size'] : 'default';
        $requested_uri = parse_url(urldecode($_SERVER['REQUEST_URI']), PHP_URL_PATH);
        $cache_slug = '';
        $cache_slug .= '_d' . $this->getPixelDensity();
        $cache_slug .= '_w' . str_pad($this->getImgSetupWidth(), 4, '0', STR_PAD_LEFT);
        $cache_slug .= '_h' . str_pad($this->getImgSetupHeight(), 4, '0', STR_PAD_LEFT);
        $cache_path_rel = '/' . $this->getCachePath() . '/' . $size . '/s' . str_pad($this->getCurrentBreakpoint(), 4, '0', STR_PAD_LEFT) . '_' . trim($cache_slug, '_') . '/' . $requested_uri;

        $this->cache_file = $_SERVER['DOCUMENT_ROOT'] . $cache_path_rel;

        return $this;
    }

    /**
     * @return mixed
     */
    private function getCacheFile()
    {
        $this->setCacheFile();
        return $this->cache_file;
    }

    /**
     * @param mixed $img_setup_height
     * @return $this
     */
    private function setImgSetupHeight($img_setup_height)
    {
        $this->img_setup_height = $img_setup_height;
        return $this;
    }

    /**
     * @return mixed
     */
    private function getImgSetupHeight()
    {
        return $this->img_setup_height;
    }

    /**
     * @param mixed $img_setup_width
     * @return $this
     */
    private function setImgSetupWidth($img_setup_width)
    {
        $this->img_setup_width = $img_setup_width;
        return $this;
    }

    /**
     * @return mixed
     */
    private function getImgSetupWidth()
    {
        return $this->img_setup_width;
    }

    /**
     * @param mixed $current_breakpoint
     * @return $this
     */
    private function setCurrentBreakpoint($current_breakpoint)
    {
        $this->current_breakpoint = $current_breakpoint;
        return $this;
    }

    /**
     * @return mixed
     */
    private function getCurrentBreakpoint()
    {
        return $this->current_breakpoint;
    }


    /**
     * @return mixed
     */
    private function getResolutions()
    {
        return $this->getConfig()->getResolutions();
    }

    /**
     * @return mixed
     */
    private function getType()
    {
        return $this->getConfig()->getType();
    }

    /**
     * @param mixed $jpg_quality
     * @return $this
     */
    private function setJpgQuality($jpg_quality)
    {
        $this->getConfig()->setJpgQuality($jpg_quality);
        return $this;
    }

    /**
     * @return mixed
     */
    private function getJpgQuality()
    {
        return $this->getConfig()->getJpgQuality();
    }

    /**
     * @return mixed
     */
    private function getJpgQualityRetina()
    {
        return $this->getConfig()->getJpgQualityRetina();
    }

    /**
     * @return mixed
     */
    private function getRetina()
    {
        return $this->getConfig()->getRetina();
    }

    /**
     * @param Source $source
     * @return $this
     */
    private function setSourceFile(Source $source)
    {
        $this->source_file = $source;
        return $this;
    }

    /**
     * @return mixed
     */
    private function getSourceFile()
    {
        return $this->source_file->getSourceFile();
    }

    /**
     * @return mixed
     */
    private function getDebugMode()
    {
        return $this->getConfig()->getDebugMode();
    }

    /**
     * @return string
     */
    private function getSourceFileExtension()
    {
        return $this->source_file->getExtension();
    }

    /**
     * Get image scaled dimensions
     *
     * @return array
     */
    private function getImgScaledSize()
    {
        $img_scaled = array();

        if ($this->getImgSetupWidth() && $this->getImgSetupHeight()) {

            $img_scaled['w'] = $this->getImgSetupWidth();
            $img_scaled['h'] = $this->getImgSetupHeight();
            return $img_scaled;
        }

        $src_img_size = $this->getSourceFileDimensions();
        $img_new = $this->getImgNewSize();

        $scale = $src_img_size[0] / $img_new['w']; // FIXME Warning: Division by zero
        $img_scaled['w'] = $src_img_size[0] / $scale; // FIXME Warning: Division by zero
        $img_scaled['h'] = $src_img_size[1] / $scale; // FIXME Warning: Division by zero

        return $img_scaled;
    }

    /**
     * The return width and height are needed by the function imagecreatetruecolor()
     * @return array
     */
    private function getImgNewSize()
    {
        $src_img_size = $this->getSourceFileDimensions();
        $img_new = array();
        $img_new['w'] = $src_img_size[0];
        $img_new['h'] = $src_img_size[1];

        if ($this->getImgSetupWidth() && $this->getImgSetupHeight()) {
            $img_new['w'] = $this->getImgSetupWidth();
            $img_new['h'] = $this->getImgSetupHeight();
            return $img_new;
        }

        if ($this->getImgSetupWidth()) {
            if ($this->getConfig()->getCrop()) {
                $img_new['w'] = $this->getImgSetupWidth();
                $img_new['h'] = $this->getImgSetupWidth();
            } else {
                $ratio_src = $src_img_size[0] / $src_img_size[1];
                $img_new['w'] = $this->getImgSetupWidth();
                $img_new['h'] = $this->getImgSetupWidth() / $ratio_src;
            }

        } elseif ($this->getImgSetupHeight()) {
            if ($this->getConfig()->getCrop()) {
                $img_new['h'] = $this->getImgSetupHeight();
                $img_new['w'] = $this->getImgSetupHeight();
            } else {
                $ratio_src = $src_img_size[1] / $src_img_size[0]; // FIXME Warning: Division by zero
                $img_new['h'] = $this->getImgSetupHeight();
                $img_new['w'] = $this->getImgSetupHeight() / $ratio_src; // FIXME Warning: Division by zero
            }
        }

        return $img_new;
    }

    /**
     * @return array
     */
    private function getSourceFileDimensions()
    {
        if (!file_exists($this->getSourceFile())) {
            header('HTTP/1.0 404 Not Found');
            echo "File not found";
            exit;
        } else if(!is_readable($this->getSourceFile())) {
            header('HTTP/1.0 403 Forbidden');
            echo "File not readable";
            exit;
        } else {
            return getimagesize($this->getSourceFile());
        }
    }
}
