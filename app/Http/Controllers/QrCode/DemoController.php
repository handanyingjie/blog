<?php

namespace App\Http\Controllers\QrCode;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use BaconQrCode\Encoder\Encoder;
use BaconQrCode\Common\ErrorCorrectionLevel;

class DemoController extends Controller
{
    private $qrCode;
    private $size = 500;
    private $backgroudImg;
    private $x = 0;
    private  $y = 0;
    private $margin = 0;
    private $data_dir = 'images';
    private $content = '';

    public function __construct()
    {
        $this->backgroudImg = public_path( '/images/background.png');
        $this->content = 'http://www.7cha.co/demo/zhurou/';
    }

    public function index(){
        $this->qrCode = Encoder::encode($this->content, ErrorCorrectionLevel::H(),'UTF-8');
        $matrix = $this->qrCode->getMatrix();
        $maxtriWidth = $matrix->getWidth();
        $size = $this->size;
        $outputWidth = $outputHeight = max($size, $maxtriWidth);
        $pixelPerPoint = $outputWidth / $maxtriWidth;

        //生成等比例缩略图,width = height = size
        $img = $this->makeThumbByImagick($this->backgroudImg, $this->size, $this->size);
        $bgImgWidth = $img->getImageWidth();
        $bgImgHeight = $img->getImageHeight();

        //创建二维码画布
        $base_image = new \Imagick();
        $base_image->newImage($outputWidth + 2 * $pixelPerPoint, $outputHeight + 2 * $pixelPerPoint, 'none');
        $base_image->setFormat('png');

        //绘制四个角的矩阵块
        $maxtriImg = new \ImagickDraw();
        // 保护边距白色
        $maxtriImg->setFillColor('#ffffff');
        $maxtriImg->setStrokeAntialias(true);
        $maxtriImg->setFillOpacity(0.6);
        $maxtriImg->rectangle(0, 0, $pixelPerPoint * 9, $pixelPerPoint * 9);
        $maxtriImg->rectangle(($maxtriWidth - 7) * $pixelPerPoint, 0, ($maxtriWidth + 2) * $pixelPerPoint, $pixelPerPoint * 9);
        $maxtriImg->rectangle(0, ($maxtriWidth - 7) * $pixelPerPoint, $pixelPerPoint * 9, ($maxtriWidth + 2) * $pixelPerPoint);
        $maxtriImg->rectangle(($maxtriWidth - 8) * $pixelPerPoint, ($maxtriWidth - 8) * $pixelPerPoint, $pixelPerPoint * ($maxtriWidth - 3), ($maxtriWidth - 3) * $pixelPerPoint);
        $dotScale = 0.35;
        $xyOffset = (1 - $dotScale) * 0.5;


        //绘制二维码的小点
        $color = '#000000';
        for ($y = 0; $y < $maxtriWidth; $y++) {
            for ($x = 0; $x < $maxtriWidth; $x++) {
                $isBlkPosCtr = (($x < 8 && ($y < 8 || $y >= $maxtriWidth - 8)) || ($x >= $maxtriWidth - 8 && $y < 8));
                $isBlkPos = (($x < 7 && ($y < 7 || $y >= $maxtriWidth - 7)) || ($x >= $maxtriWidth - 7 && $y < 7));
                $inAgnRange = (($x < $maxtriWidth - 4 && $x >= $maxtriWidth - 4 - 5 && $y < $maxtriWidth - 4 && $y >= $maxtriWidth - 4 - 5));

                $needDotBlack = $matrix->get($x, $y) === 1;
                if (!($inAgnRange || $isBlkPosCtr || $isBlkPos)) {
                    if ($needDotBlack) {
                        $maxtriImg->setFillColor($color);
                        $maxtriImg->setFillOpacity(0.9);
                    } else {
                        $maxtriImg->setFillColor('#ffffff');
                        $maxtriImg->setFillOpacity(0.6);
                    }
                    $maxtriImg->roundRectangle(($x + 1 + $xyOffset) * $pixelPerPoint, ($y + 1 + $xyOffset) * $pixelPerPoint, ($x + 1 + $dotScale + $xyOffset) * $pixelPerPoint, ($y + 1 + $dotScale + $xyOffset) * $pixelPerPoint, 1000, 1000);

                } else {
                    if ($needDotBlack) {
                        $maxtriImg->setFillColor($color);
                        $maxtriImg->rectangle(($x + 1) * $pixelPerPoint, ($y + 1) * $pixelPerPoint, ($x + 2) * $pixelPerPoint, ($y + 2) * $pixelPerPoint);
                    }
                }
            }
        }
        $base_image->drawImage($maxtriImg);

        //偏移距离
        $xDeviation = $this->x;
        $yDeviation = $this->y;
        //缩放后的尺寸
        $ImgResize = min($bgImgWidth, $bgImgHeight);

//        if ($outputWidth > $ImgResize) {
            $imgDeviation = min($xDeviation, $yDeviation);
            $base_image->resizeImage($ImgResize - $imgDeviation, $ImgResize - $imgDeviation, \Imagick::FILTER_UNDEFINED, 1, true);
//        }

        //合并到图上
        $img->compositeImage($base_image, \Imagick::COMPOSITE_OVER, $xDeviation, $yDeviation);
        if ($this->margin > 0){
            $color=new \ImagickPixel();
            $color->setColor("rgb(255,255,255)");
            $img->borderImage($color,$this->margin,$this->margin);
        }
        $result['img'] = $img->getImageBlob();
        $result['type'] = $img->getImageFormat();
        $result['base64_image'] = 'data:image/' . strtolower($result['type'] ) . ';base64,' . chunk_split(base64_encode( $result['img']));
        $base_image->destroy();
        $maxtriImg->destroy();
        $img->destroy();
        echo "<img src='".$result['base64_image']."' width='500' height='500'>";
    }

    private function makeThumbByImagick($img, $thumb_width = 0, $thumb_height = 0, $path = "", $bgcolor = ""){
        $im = new \Imagick();
        $new_im = clone $im;
        $im->readImage($img);
        $im->setCompression(\Imagick::COMPRESSION_JPEG);
        $im->setCompressionQuality(IMAGETYPE_COUNT); //设置图片品质
        $srcImage = $im->getImageGeometry(); //获取源图片宽高

        //图片等比例缩放宽和高设置,根据宽度设置等比缩放
        $scale_org = $srcImage['width'] / $srcImage['height'];
        if ($srcImage['width'] / $thumb_width > $srcImage['height'] / $thumb_height) {
            $newX = $thumb_width;
            $newY = $thumb_width / $scale_org;
        } else {
            /* 原始图片比较高，则以高度为准 */
            $newX = $thumb_height * $scale_org;
            $newY = $thumb_height;
        }

        $im->thumbnailImage($newX, $newY);  //按照比例进行缩放
        // 按照缩略图大小创建一个有颜色的图片
        $new_im->newImage($thumb_width, $thumb_height, $bgcolor, 'jpg');
        //合并图片
        $new_im->compositeImage($im, \Imagick::COMPOSITE_OVER, ($thumb_width - $newX) / 2, ($thumb_height - $newY) / 2);

        /* 创建当月目录 */
        if (empty($path)) {
            $dir =  public_path($this->data_dir . '/');
        } else {
            $dir =  public_path($this->data_dir . '/' . $path . '/');
        }

        /* 如果目标目录不存在，则创建它 */
        if (!file_exists($dir)) {
            if (!make_dir($dir)) {
                /* 创建目录失败 */
                return false;
            }
        }

        /* 如果文件名为空，生成不重名随机文件名 */
        $filename = $dir. 'qrcode';
        $filename = $filename . ".jpg"; //jpg图片
        //生成JPG图片;
        $new_im->writeImage($filename);
        //清空图片内存
        $im->clear();
        $im->destroy();

        //确认文件是否生成
        if (file_exists($filename)) {
            return $new_im;
        } else {
            return false;
        }
    }

    public function socketClient(){
        return view('QrCode.index');
    }
}
