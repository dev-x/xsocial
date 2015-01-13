<?php
namespace app\lib;

class Image {
    public static function resize ($fn, $thumbnails, &$fileinfo) {
        $dir = dirname($fn);
        $f = basename($fn);
        if (!preg_match('/^(.*)\.(.*)$/i', $f, $m)) return false;

        $fileinfo['file_name'] = $m[1];
        $fileinfo['file_ext'] = $m[2];


        $imgsize = getimagesize($fn);

        if (!is_array($imgsize)) return false;
        $width = $imgsize[0];
        $height = $imgsize[1];
        $image_type = $imgsize[2];

        $fileinfo['or_width']  = $width;
        $fileinfo['or_height'] = $height;

        //	print_r($imgsize);
        switch ($image_type) {
            case IMAGETYPE_JPEG: $src_image = imagecreatefromjpeg($fn); break;
            case IMAGETYPE_PNG:  $src_image = imagecreatefrompng($fn);  break;
            case IMAGETYPE_GIF:  $src_image = imagecreatefromgif($fn);  break;
        }

        if(!$src_image) return false;

        foreach($thumbnails as $thumbnail) {

            if ($thumbnail['crop']) {
                $src_x = 0;
                $src_y = 0;
                if (($width / $height) > ($thumbnail['width'] / $thumbnail['height'])) {
                    $src_h = $height;
                    $src_w = round($thumbnail['width'] * $src_h / $thumbnail['height']);
                    if (isset($thumbnail['cropframe'])) $cropframe = $thumbnail['cropframe']; else $cropframe = 2;
                    switch($cropframe) {
                        case 1: $src_x = 0; break;
                        case 3: $src_x = ($width - $src_w);
                        default: $src_x = round(($width - $src_w) / 2);
                    }

                } else {
                    $src_w = $width;
                    $src_h = round($src_w * $thumbnail['height'] / $thumbnail['width']);
                    if (isset($thumbnail['cropframe'])) $cropframe = $thumbnail['cropframe']; else $cropframe = 2;
                    switch($cropframe) {
                        case 1: $src_y = 0; break;
                        case 3: $src_y = ($height - $src_h);
                        default: $src_y = round(($height - $src_h) / 2);
                    }
                }
                $dst_w = $thumbnail['width'];
                $dst_h = $thumbnail['height'];
            } else {
                if (($width / $height) > ($thumbnail['width'] / $thumbnail['height'])) {
                    $dst_w = $thumbnail['width'];
                    $dst_h = round($height * $dst_w / $width);
                } else {
                    $dst_h = $thumbnail['height'];
                    $dst_w = round($width * $dst_h / $height);
                }
                $src_w = $width;
                $src_h = $height;
                $src_x = 0;
                $src_y = 0;
            }

            $dst_x = 0;
            $dst_y = 0;

            $dst_image = imagecreatetruecolor($dst_w, $dst_h);
            imagecopyresampled( $dst_image, $src_image, $dst_x, $dst_y , $src_x , $src_y , $dst_w , $dst_h , $src_w , $src_h );

            $nfn = $dir."/".$fileinfo['file_name'].$thumbnail['suffix'].".".$fileinfo['file_ext'];

            switch ($image_type) {
                case IMAGETYPE_JPEG: imagejpeg($dst_image, $nfn, 85); break;
                case IMAGETYPE_PNG:  imagepng($dst_image, $nfn);  break;
                case IMAGETYPE_GIF:  imagegif($dst_image, $nfn);  break;
            }
            imagedestroy($dst_image);
        }
        return true;
    }
}

?>