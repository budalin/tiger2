<?php

if ((($_FILES["updimg"]["type"] == "image/gif")|| ($_FILES["updimg"]["type"] == "image/jpeg")
	|| ($_FILES["updimg"]["type"] == "image/pjpeg")))
{
	if ($_FILES["updimg"]["error"] > 0)
	{
		echo "Return Code: " . $_FILES["updimg"]["error"] . "<br />";
	}
	else
	{
		echo "Upload: " . $_FILES["updimg"]["name"] . "<br />";
		echo "Type: " . $_FILES["updimg"]["type"] . "<br />";
		echo "Size: " . ($_FILES["updimg"]["size"] / 1024) . " Kb<br />";
		echo "Temp file: " . $_FILES["updimg"]["tmp_name"] . "<br />";
		if (file_exists("upload/" . $_FILES["updimg"]["name"]))
			{
				echo $_FILES["updimg"]["name"] . " already exists. ";
			}
		else
			{
				move_uploaded_file($_FILES["updimg"]["tmp_name"],
				"upload/" . $_FILES["updimg"]["name"]);
				echo "Stored in: " . "upload/" . $_FILES["updimg"]["name"];
			}
	}
}
else
{
	echo "Invalid file";
}
?>
<form name="uploadForm" id="uploadForm" method="POST" action="popup.php">
	<div id="popup_bg">
	<div id="pop-up"><!-- pop up div starts -->
		<a  id="close" class="pop" onclick="hidePopup()"></a>
		<div class="button"><input type="file" value="Select Photo" name="updimg"/><input type="submit" value="Upload" onclick="checkPopUp();"/><input class="delete" type="button" value="Delete Selected Picture(s)" /></div>
		
		
		
		
</form>		
		<!--<div id="img">
			<img src="images/2013-Ford-Fusion-Energi-plug-in-hybrid-sedan-green-car-of-the-year.jpg" alt="" />
			<input type="checkbox" id="cbox" checked="uncheck"/>
		</div>
		<div id="img">
			<img src="images/2013-Ford-Fusion-Energi-plug-in-hybrid-sedan-green-car-of-the-year.jpg" alt="" />
			<input type="checkbox" id="cbox"/>
		</div>
		<div id="img">
			<img src="images/2013-Ford-Fusion-Energi-plug-in-hybrid-sedan-green-car-of-the-year.jpg" alt="" />
			<input type="checkbox" id="cbox"/>
		</div>
		<div id="img">
			<img src="images/2013-Ford-Fusion-Energi-plug-in-hybrid-sedan-green-car-of-the-year.jpg" alt="" />
			<input type="checkbox" id="cbox"/>
		</div>
		<div id="img">
			<img src="images/2013-Ford-Fusion-Energi-plug-in-hybrid-sedan-green-car-of-the-year.jpg" alt="" />
			<input type="checkbox" id="cbox"/>
		</div>
		<div id="img">
			<img src="images/2013-Ford-Fusion-Energi-plug-in-hybrid-sedan-green-car-of-the-year.jpg" alt="" />
			<input type="checkbox" id="cbox"/>
		</div>
		<div id="img">
			<img src="images/2013-Ford-Fusion-Energi-plug-in-hybrid-sedan-green-car-of-the-year.jpg" alt="" />
			<input type="checkbox" id="cbox"/>
		</div>
		<div id="img">
			<img src="images/2013-Ford-Fusion-Energi-plug-in-hybrid-sedan-green-car-of-the-year.jpg" alt="" />
			<input type="checkbox" id="cbox"/>
		</div>
		<div id="img">
			<img src="images/2013-Ford-Fusion-Energi-plug-in-hybrid-sedan-green-car-of-the-year.jpg" alt="" />
			<input type="checkbox" id="cbox"/>
		</div>-->
		<div class="clear"></div>
	</div><!-- end of pop up div -->
</div>

