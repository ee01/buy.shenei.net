<?php
/**
 * 文件名：image.han.php
 * 版本号：1.0
 * 最后修改时间：20010年05月18日
 * 作者：狐狸<foxis@qq.com>
 * 功能描述：图像操作类
 */






class ImageHandler
{
		var $type;
		var $width;
		var $height;
		var $resize_width;
		var $resize_height;
		var $cut;
		var $srcimg;
		var $dstimg;
		var $im;


	function ImageHandler()
	{
			}


	function resizeimage($img, $img2, $wid, $hei,$c)
	{
			$this->srcimg = $img;
			$this->dstimg = $img2;
			$this->resize_width = $wid;
			$this->resize_height = $hei;
			$this->cut = $c;
						$this->type = substr(strrchr($this->srcimg,"."),1);
						$gd=$this->initi_img();
			if($gd===false)return true;
						$this->width = imagesx($this->im);
			$this->height = imagesy($this->im);
						$this->newimg();
			ImageDestroy ($this->im);
			Return true;
	}

	function newimg()
	{
						$resize_ratio = ($this->resize_width)/($this->resize_height);
						$ratio = ($this->width)/($this->height);
			if(($this->cut)=="1")
						{
					if($ratio>=$resize_ratio)
										{
							$newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
							imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width,$this->resize_height, (($this->height)*$resize_ratio), $this->height);
							ImageJpeg ($newimg,$this->dstimg);
					}
					if($ratio<$resize_ratio)
										{
							$newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
							imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, $this->resize_height, $this->width, (($this->width)/$resize_ratio));
							ImageJpeg ($newimg,$this->dstimg);
					}
			}
			else
						{
					if($ratio>=$resize_ratio)
					{
							$newimg = imagecreatetruecolor($this->resize_width,($this->resize_width)/$ratio);
							imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, ($this->resize_width)/$ratio, $this->width, $this->height);
							ImageJpeg ($newimg,$this->dstimg);
					}
					if($ratio<$resize_ratio)
					{
							$newimg = imagecreatetruecolor(($this->resize_height)*$ratio,$this->resize_height);
							imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, ($this->resize_height)*$ratio, $this->resize_height, $this->width, $this->height);
							ImageJpeg ($newimg,$this->dstimg);
					}
			}
	}
		function initi_img()
	{
			if($this->type=="jpg")
			{
				if(function_exists('imagecreatefromjpeg')==false)return false;
					$this->im = imagecreatefromjpeg($this->srcimg);
			}
			if($this->type=="gif")
			{
				if(function_exists('imagecreatefromgif')==false)return false;
					$this->im = imagecreatefromgif($this->srcimg);
			}
			if($this->type=="png")
			{
				if(function_exists('imagecreatefrompng')==false)return false;
					$this->im = imagecreatefrompng($this->srcimg);
			}
			return true;
	}
} ?>

