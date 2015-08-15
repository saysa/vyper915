<?php

namespace Phpimageprescaler\PIP;


class SourceJpg extends Source
{
    public function imageCreateFrom($resource, $crop)
    {
        if (is_int($crop)) {
            $this->crop($crop);
        }

        $return = imagecreatefromjpeg($this->getSourceFile()); // FIXME Warning: imagecreatefromjpeg(/vagrant/htdocs/watchtimenet//static/img/db/00000_s95_zoccai_zwgd0009rrdil.jpg): failed to open stream: No such file or directory
        imageinterlace($resource, true); // FIXME Warning: imageinterlace() expects parameter 1 to be resource, boolean given
        return $return;
    }

    function showImage($resource, $filename, $quality)
    {
        return imagejpeg($resource, $filename, $quality); // FIXME Warning: imagejpeg() expects parameter 1 to be resource, boolean given
    }
}