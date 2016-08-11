<?php


    $characters = $_POST['characters'];
    //$character = "Si alguien llama a tu puerta, amiga mía, Y algo en tu sangre late y no reposa Y en su tallo de agua temblorosa El surtidor florece su alegría. Si alguien llama a tu puerta y todavía Te queda tiempo para ser hermosa, Si aún existe la arteria de la rosa Para tomarle el pulso a la poesía. Si alguien llama a tu puerta una mañana, Sonora de palomas y campanas Y aún crees en el dolor de la alegría; Si aún la vida es verdad y el beso existe, Si alguien llama a tu puerta y estás triste Abre que es el amor, amiga mía.";
    $fontsize	= $_POST['fontsize'];
    //$fontsize	= 10;
    $img_type   = $_POST['color'];
    //$img_type   = "color";
    $bgcolor	= $_POST['bgcolor'];
    //$bgcolor	= "#CCC";

?>
<html>
  <meta charset="UTF-8">
    <title>Output Imagen</title>

  <style>
    body{
		 background:<?=$bgcolor;?>;
		 font-size: <?=$fontsize;?>px;
  	}
  	.bold{
  		color: red;
  		font-size: 15px;
  		font-weight: bold;
  	}
  </style>
  <body>
<?php
	$imagesize = "150";
	$index = 0;
	$path = "images/";
	$allowedExts  = array("jpg", "jpeg", "gif", "png");
	$allowedTypes = array("image/gif", "image/jpeg", "image/jpg", "image/pjpeg","image/png");

  $extension = end(explode(".", $_FILES["image"]["name"]));

	$newfilename = time().".".$extension;


	$filename = $_FILES["image"]["name"];
	$filetmp  = $_FILES["image"]["tmp_name"];
	$filetype = $_FILES["image"]["type"];
	$filesize = $_FILES["image"]["size"];

	$filesize = number_format(( $filesize / 1024 ) / 1024 , 2);

	if(!$_FILES["image"]["error"]){
		if (in_array($filetype,$allowedTypes) && in_array($extension, $allowedExts))
		{
			if(($filesize < 2)) // check if file size less than 2 mb
				move_uploaded_file($filetmp,"images/" . $newfilename);
			else{
				echo '<span class="bold">Image is too big</span>';
				exit;
			}
		}else{
			echo '<span class="bold">Invalid image, Supported formats jpeg, png, gif</span>';
			exit;
		}
	}
	$thumb = "thumb_".$newfilename;
	imagecreatethumbnail($path.$newfilename,$path.$thumb,$imagesize /6 ,$imagesize /6);

	//$thumb = thumbnail_box(imagecreatefromjpeg($path.$newfilename),$path.$thumb, 210, 150);
	//imagedestroy($i);

	if(!file_exists($path.$thumb)) {
		echo "File not found";
		exit;
	}

	$im = imagecreatefrompng($path.$thumb);
	if(!$im) echo "Cant open image";
	$w = imagesx($im);
	$h = imagesy($im);
	for( $i = 0; $i < $h; $i++ ) {
		for( $j = 0; $j < $w; $j++ ) {
			//if($j%2 == 0) continue;
			$rgb = imagecolorat($im, $j, $i);
			$a = ($rgb >> 24) & 0xFF;
			$r = ($rgb >> 16) & 0xFF;
			$g = ($rgb >> 8) & 0xFF;
			$b = $rgb & 0xFF;

			$pixel = $characters[$index];

			if($img_type == "gray"){
				$gray = round(($r + $g + $b) / 3);
				//if($gray > 0x7F) $gray = 0xFF;
				//$gray =  0x00;
				echo "<span style='color:rgb($gray,$gray,$gray);'>".htmlentities($pixel)."</span>";
			}else{
				echo "<span style='color:rgb($r,$g,$b);'>".htmlentities($pixel)."</span>";
			}

			//echo "<div style='background:rgb($r,$g,$b);float:left;width:1px; height:1px;'>@</div>";
			$index++;
			if($index >= count(str_split($characters)))
				$index = 0;
		}
		echo "<br>";
	}
	//unlink($path.$thumb);
	unlink($path.$newfilename);

	function imagecreatethumbnail($file,$output,$max_width = 150,$max_height = 150)
	{
			extract($_POST);
			$img = imagecreatefromstring(file_get_contents($file));
			list($width, $height, $type, $attr) = getimagesize($file);
			if($height > $max_height || $width > $max_width)
			{
					if($width > $height)
					{
							$thumb_width = $max_width;
							$thumb_height = ceil(($height * $thumb_width)/$width);
					}
					else
					{
							$thumb_height = $max_height;
							$thumb_width = ceil(($width * $thumb_height)/$height);
					}
			} else {
					$thumb_width = $width;
					$thumb_height = $height;
			}
			$thumb_width = $thumb_width + ($thumb_width * ($fontsize / 6) );
			imagesavealpha($img,true);
			$thumb = imagecreatetruecolor($thumb_width,$thumb_height);
			imagesavealpha($thumb,true);
			imagealphablending($thumb,false);
			imagecopyresampled($thumb,$img,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
			$return = imagepng($thumb,$output);
			imagedestroy($img);
			imagedestroy($thumb);
			return $return;
	}


?>
</body>
</html>
