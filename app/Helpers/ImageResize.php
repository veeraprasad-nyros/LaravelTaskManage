<?php 

// GD Version 2.1.1-dev and PHP Version 5.5.9-1ubuntu4.18 
// This class have five static methods
// 1. customCropImage($imageUrl, $toDirPath ,$width, $height)
// 2. eventImage($imageUrl, $toDirPath)
// 3. backgroundImage($imageUrl, $toDirPath)
// 4. thumbsImageCenter($imageUrl, $toDirPath, $width, $height)
// 5. createThumbFromUrlWH($ImageUrl, $toDirPath, $thumbWidth, $thumbHeight)
// where $ImageUrl like 
//    'http://www.planwallpaper.com/static/images/Winter-Tiger-Wild-Cat-Images.jpg'
//    'org/screen2.png'
// $toDirPath is the abosolute or relative path to the directory to save image
// eventImage method, it produce 600x250 resolution image when larger.
// backgroundImage method is similar to the eventImage method
// eventImage,thumbsImageCenter and backgroundImage methods produce the thumb image form center of actual image
// createThumbFromUrlWH method produce the thumb image form actual image.
// all methods place produced image into $toDirPath with same name.
namespace App\Helpers;
use Imagick;
class ImageResize
{	
	static function customCropImage($imageUrl, $toDirPath ,$width, $height)
	{
		/* Read the image */
		//$ImageUrl = "http://www.planwallpaper.com/static/images/Winter-Tiger-Wild-Cat-Images.jpg";
        
        	if(! @getimagesize($imageUrl) )
        	{
        		return json_encode(0);
        	}
	        $a = getimagesize($imageUrl);
		    $image_type = $a[2];
		     
		    if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
		    {
		        $im = new imagick( $imageUrl );
				/* create the thumbnail */
				$im->cropThumbnailImage( $width, $height );
				/* Write to a file */
				$fname = substr(strrchr($imageUrl, "/"), 1);

				$im->writeImage( $toDirPath.$fname );

				return json_encode(1);
		    }
		    else
		    {
		    	return json_encode(0);
		    }
	   
	}

	static function eventImage($imageUrl, $toDirPath)
	{
		if(! @getimagesize($imageUrl) )
        {
        	return json_encode(0);
        }
		list($width, $height) = getimagesize($imageUrl);
		if( $width > 600)
		{
		  $width = 600;	
		}
		if( $height > 250)
		{
			$height = 250;
		}
		
		return ImageResize::customCropImage($imageUrl, $toDirPath ,$width, $height);
	}

	static function backgroundImage($imageUrl, $toDirPath)
	{
		if(! @getimagesize($imageUrl) )
        {
        	return json_encode(0);
        }
		list($width, $height) = getimagesize($imageUrl);
		if( $width > 600)
		{
		  $width = 600;	
		}
		if( $height > 250)
		{
			$height = 250;
		}
		
		return ImageResize::customCropImage($imageUrl, $toDirPath ,$width, $height);
	}

	static function thumbsImageCenter($imageUrl, $toDirPath, $width, $height)
	{
		if(! @getimagesize($imageUrl) )
        {
        	return json_encode(0);
        }
		return ImageResize::customCropImage($imageUrl, $toDirPath ,$width, $height);
	}

	static function createThumbActual($imageUrl, $toDirPath, $width, $height) 
	{
		$ImageUrl = $imageUrl;
		$thumbWidth = $width;
		$thumbHeight = $height;
		if(! @getimagesize($ImageUrl) )
        {
           return json_encode(0);
        }
		// $pathToImage = $toDirPath;
		// echo $pathToImage;

		$pathToImage = substr($ImageUrl, 0, strrpos($ImageUrl, "/") + 1);
		$fname = substr(strrchr($ImageUrl, "/"), 1);
		
	    $info = pathinfo($pathToImage . $fname);
	   
        // load image and get image size
        switch (strtolower($info['extension'])) 
        {
 		    case "jpg":
		        $img = imagecreatefromjpeg( "{$pathToImage}{$fname}" );
  		        break;
		    case "png":
		        $img = imagecreatefrompng( "{$pathToImage}{$fname}" );
		        break;
		    case "gif":
		        $img = imagecreatefromgif( "{$pathToImage}{$fname}" );
		        break;
		}


	    $width = imagesx( $img );
	    $height = imagesy( $img );

	    // calculate thumbnail size
	    $new_width = $thumbWidth;
	    $new_height = $thumbHeight;

	    // create a new temporary image
	    $tmp_img = imagecreatetruecolor( $new_width, $new_height );

	    // copy and resize old image into new image 
	    imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

	    // save thumbnail into a file

	    switch (strtolower($info['extension'])) 
	    {
		    case "jpg":
		        imagejpeg( $tmp_img, "{$toDirPath}{$fname}" );
		        break;
		    case "png":
		        imagepng( $tmp_img, "{$toDirPath}{$fname}" );
		        break;
		    case "gif":
		        imagegif( $tmp_img, "{$toDirPath}{$fname}" );
		        break;
		}

		return json_encode(1);
	}

}

