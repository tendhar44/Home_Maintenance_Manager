<?php


class EventHandler {

	// pop up a alert box with the pass in message
	public function alertMsg($msg){        
		echo '<script language="javascript">';
		echo 'alert("'. $msg .'")';
		echo '</script>';
	} 


    //input name='imgSelector' for all instance that upload image is required
    //only upload/move image to a location and not database
	public function uploadImage($imgFiles){

		if($imageFiles === NULL){
			$this->alertMsg("No image files was selected");
			return false;
		}

		$target_dir = "/Home_Maintenance_Manager/public/img/";
		$target_file = $target_dir . basename($imgFiles["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
		$check = getimagesize($imgFiles["tmp_name"]);
		if($check !== false) {
			$this->alert("File is an image - " . $check["mime"] . ".");
			$uploadOk = 1;
		} else {
			$this->alert("File is not an image.");
			$uploadOk = 0;
		}

	// Check if file already exists
		if (file_exists($target_file)) {
			$this->alert("Sorry, file already exists.");
			$uploadOk = 0;
		}
	// Check file size
		if ($imgFiles["size"] > 500000) {
			$this->alert("Sorry, your file is too large.");
			$uploadOk = 0;
		}
	// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			$this->alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
			$uploadOk = 0;
		}
			// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$this->alert("Sorry, your file was not uploaded.");
			return false;
			// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($imgFiles["tmp_name"], $target_file)) {
				$this->alert("The file ". basename( $imgFiles["name"]). " has been uploaded.");
				return true;
			} else {
				$this->alert("Sorry, there was an error uploading your file.");
				return false;
			}
		}
	}
}


?>