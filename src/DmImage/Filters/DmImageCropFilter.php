<?php

require_once dirname(__FILE__).'/DmImageFilter.php';

class DmImageCropFilter extends DmImageFilter
{
	
	public $width = 0;
	
	public $height = 0;
	
	public function __construct($width,$height)
	{
		$this->width  = $width;
		$this->height = $height;
	}
	
	public function execute(DmImage $image)
	{
		
		$w = $this->width;
		$h = $this->height;
		$x = (int)(($image->getWidth()  - $w) * 0.5);
		$y = (int)(($image->getHeight() - $h) * 0.5);
		
		$resampledResource = imagecreatetruecolor($w, $h);
		//背景色設定(透過を有効化)
		imagesavealpha($resampledResource,true);
//		imagealphablending($imageResource, false);
		$colorId = DmColor::argb(0)->imagecolorallocatealpha($resampledResource);
//		imagefilledrectangle($imageResource, 0, 0, $width-1, $height-1, $colorId);
		imagefill($resampledResource, 0, 0, $colorId);
		
		imagecopyresampled(
			$resampledResource,
			$image->getImageResource(),
			0,0,$x,$y,
			$image->getWidth(),
			$image->getHeight(),
			$image->getWidth(),
			$image->getHeight()
		);
		
		return $resampledResource;
		
	}
	
}
