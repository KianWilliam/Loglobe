<?php
/**
 * @package Module Loglobe for Joomla! 5.x
 * @version $Id: mod_loglobe.php 1.2.1 2024-07-21 23:26:33Z $
 * @author KWProductions Co.
 * @copyright (C) 2024- KWProductions Co.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of loglobe.
    loglobe is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    loglobe is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with loglobe.  If not, see <http://www.gnu.org/licenses/>. 
**/ 

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Filesystem\Folder;

HTMLHelper::_("jquery.framework");

$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
//$wa->registerAndUseStyle('globestyle', Uri::Base().'modules/mod_globegallery/tmpl/globestyle.css');
$modId = 'mod-loglobe' . $module->id;
$swidth = $params->get("spherewidth");
$sheight = $params->get("sphereheight");
var_dump("haha".$swidth);
$perspective = $params->get("perspective");
$perspectivechange = $params->get("perspectivechange");
$imgnums = $params->get("imgnums");
var_dump($imgnums);

$transitiontype= $params->get("transitiontype");
$rotationtime = $params->get("rotationtime");
$bordercolor = $params->get("bordercolor");
$imagefolder =  	$params->get("imagefolder");
$bordersize = 	$params->get("bordersize");
$buttbkcol = 	$params->get("buttonbkcolor");
$butttxtcol = 	$params->get("buttontxtcolor");



if(Folder::exists(JPATH_ROOT.'\\images\\'.$imagefolder))
{
	$images = Folder::files(JPATH_ROOT.'\\images\\'.$imagefolder);
	
	$arrimg = [];
    foreach($images as $image)
	{
		$arrimg [] = Uri::Base()."images/".$imagefolder."/".$image;
	
	}
	$images = $arrimg;
	
	
	$globecontent="
	
	var swidth;
	swidth =".$swidth.";	
	//console.log(canvaswidth);
	var sheight;
	sheight =".$sheight.";	
	var perspective;
	perspective =".$perspective.";	
	var perspectivechange;
	perspective =".$perspectivechange.";	
	var transitiontype;
	transitiontype =".$transitiontype.";	
	var rotationtime;
	rotationtime =".$rotationtime.";	
	var bordercolor;
	bordercolor =".$bordercolor.";
	var bordersize;
	 bordersize = ".$bordersize.";
	 
	
	 var myimages ;
	 var images = [];
	 
	 myimages = ".json_encode($images).";
	 for(let i=0; i<myimages.length; i++)
	{
	  images[i]=myimages[i];
	  
	 }
	 
	";
	
//	$wa->addInlineScript($globecontent);
//	$wa->registerAndUseScript('globescript', Uri::Base().'modules/mod_globegallery/tmpl/globescript.js');
    }
	else
		echo "<h1>Set your images folder first in the backend of your website!</h1>";

	?>
<div id="loglobecontainer">	
<style type="text/css">
#scene {
  perspective: <?php echo $perspective; ?>px;
  transform-style: preserve-3d;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  transition: perspective 1s <?php echo $transitiontype; ?>;
  pointer-events: none;
  z-index: 0;
}
#scene * {
  transform-style: preserve-3d;
-webkit-transform-style: preserve-3d;

  position: absolute;
}

#sphere {
	
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  width:<?php echo ($swidth*2); ?>px;
  height:<?php echo $sheight; ?>px;
  animation: rotate-around <?php echo $rotationtime; ?>s linear infinite;
  <!--
  backface-visibility:hidden;
  -webkit-backface-visibility:hidden;
  -->
}
#loglobecontainer #scene #sphere:hover
{
	animation-play-state:paused;
	-webkit-animation-play-state:paused;
	pointer:hand;
}
@keyframes rotate-around {
	<!--
  0% {
    transform: rotateX(-20deg) rotateY(0deg);
  }
  10% {
    transform: rotateX(-20deg) rotateY(36deg);
  }
  50% {
    transform: rotateX(-70deg) rotateY(180deg);
  }
  60% {
    transform: rotateX(-70deg) rotateY(216deg);
  }
  100% {
    transform: rotateX(-20deg) rotateY(360deg);
  }
  -->
   0% {
    transform:  rotateY(0deg);
  }
  10% {
    transform:  rotateY(36deg);
  }
  50% {
    transform:  rotateY(180deg);
  }
  60% {
    transform:  rotateY(216deg);
  }
  100% {
    transform:  rotateY(360deg);
  }
}
#sphere .longitudes
 {
  display: flex;
  justify-content: center;
  align-items: center;
}
#sphere .longitude
 {
  border-radius: 50%;
  border: <?php echo $bordersize; ?>px solid;
  aspect-ratio: 1/1;
   width:<?php echo $swidth; ?>px;
  height:<?php echo $sheight; ?>px;
}
#sphere .longitude {
  border-color: <?php echo $bordercolor; ?>;  
}

#sphere .longitude:nth-child(1) {
  transform: translateX(<?php echo $swidth/2; ?>px)  rotateY(0deg);
  background-image:url(<?php echo $images[0]; ?>);
  background-size:100% 100%;
  background-position:0% 0%;
  
}
#sphere .longitude:nth-child(2) {
	
    transform:translateX(<?php echo (-1)*($swidth)/2; ?>px)   rotateY(180deg);

 background-image:url(<?php echo $images[1]; ?>);
  background-size:100% 100%;
  background-position:0% 0%;
}
#sphere .longitude:nth-child(3) {
	
   transform:  rotateY(-90deg) translateX(<?php echo (-1)*$swidth/2; ?>px) ;

   background-image:url(<?php echo $images[2]; ?>);
  background-size:100% 100%;
  background-position:0% 0%;
  
}

#sphere .longitude:nth-child(4) {
  transform:   rotateY(90deg)  translateX(<?php echo (-1)*($swidth)/2; ?>px);
    background-image:url(<?php echo $images[3]; ?>);
  background-size:100% 100%;
  background-position:0% 0%;
  
}
#sphere .longitude:nth-child(5) {
  transform: translateX(<?php echo $swidth; ?>px)  rotateY(72deg);
  background-image:url(<?php echo $images[2]; ?>);
  background-size:100% 100%;
  background-position:0% 0%;
}

#sphere .longitude:nth-child(6) {
  transform: translateX(<?php echo $swidth; ?>px)    rotateY(108deg);
    background-image:url(<?php echo $images[2]; ?>);
  background-size:100% 100%;
  background-position:0% 0%;
}
#sphere .longitude:nth-child(7) {
  transform: translateX(<?php echo $swidth; ?>px)  rotateY(109deg);
   background-image:url(<?php echo $images[3]; ?>);
  background-size:100% 100%;
  background-position:0% 0%;
}

#sphere .longitude:nth-child(8) {
  transform: translateX(<?php echo $swidth; ?>px)   rotateY(143deg);
    background-image:url(<?php echo $images[3]; ?>);
  background-size:100% 100%;
  background-position:0% 0%;
}
#sphere .longitude:nth-child(9) {
  transform: translateX(<?php echo $swidth; ?>px)   ?>px) rotateY(144deg);
  background-image:url(<?php echo $images[4]; ?>);
  background-size:100% 100%;
  background-position:0% 0%;
}

#sphere .longitude:nth-child(10) {
  transform: translateX(<?php echo $swidth; ?>px)   rotateY(179deg);
    background-image:url(<?php echo $images[4]; ?>);
  background-size:100% 100%;
  background-position:0% 0%;
}
label {
  position: fixed;
  margin: 15px;
  display: inline-block;
  background-color: #444;
  box-shadow: 0px 0px 10px #111a;
  padding: 8px 16px;
  border-radius: 4px;
  font-size: 18px;
  z-index: 10;
  opacity: 0.8;
}
label:hover {
  cursor: pointer;
  opacity: 1;
}

.longitudeb
{
	background-color:#000;
}

input {
  
}
/*hover better*/

input:checked ~ #scene {
  perspective: <?php echo $perspectivechange; ?>px;
}
input:not(:checked) ~ #scene {
  perspective: <?php echo $perspective; ?>px;
}
</style>
<input type="checkbox" id="toggler">
<label for="toggler">
  Toggle perspective
</label>
<div id="scene">
  <div id="sphere">
    <div class="longitudes">

    <div class="longitude"></div>
	

	
      <div class="longitude"></div>
    <div class="longitude"></div>
	  

	
      <div class="longitude"></div>
  <!--   <div class="longitude"></div>
	  
<!--
	  
      <div class="longitude"></div>
      <div class="longitude"></div>
	  
<!--
	 
      <div class="longitude"></div>
	  <div class="longitude"></div>
	  
	    <div class="longitude"></div>
	  
	 -->
	  
    </div>
	 </div>
</div>
	<form>
		<input type="button" class="btn" name="alpha" id="alpha" value="Stop The Globe" />

	</form>
</div>
	
	<script type="text/javascript" src="<?php echo Uri::Base() ?>modules/mod_loglobe/tmpl/loglobescript.js"></script>

	    <script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#alpha').css({color:"<?php echo $butttxtcol; ?>",backgroundColor:"<?php echo $buttbkcol; ?>"});
			var counter=2; //lea
			
			jQuery('#alpha').click(function(){
				if(counterb%2==0)
				{
					
					jQuery('#alpha').val("Start The Globe");
				}
				else
				{
					
					 jQuery('#alpha').val("Stop The Globe");


				}
				counter++;
				
				
			});
		});
	
		</script>