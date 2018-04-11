<?php


class EventHandler {

	// pop up a alert box with the pass in message
	public function alertMsg($msg){        
		echo '<script language="javascript">';
		echo 'alert("'. $msg .'")';
		echo '</script>';
	} 

	//code reference from from php.net
	//use to rearrange file array for easier looping
	function reArrayFiles(&$file_post) {

		$file_ary = array();
		$file_count = count($file_post['name']);
		$file_keys = array_keys($file_post);

		for ($i=0; $i<$file_count; $i++) {
			foreach ($file_keys as $key) {
				$file_ary[$i][$key] = $file_post[$key][$i];
			}
		}
		return $file_ary;
	}



	public function getImage($objectId, $objectType, $conn){

		// var_dump($objectId);
		// var_dump($objectType);

		$stmt = "
		SELECT i.imageId, i.imageFileName, i.alternateText 
		FROM Images i
		INNER JOIN ImageObjectBridge io on i.imageId = io.imageId 
		WHERE io.objectId = '$objectId' and io.objectType = '$objectType'
		";

		$imgData = $conn->query($stmt);

		// var_dump($imgData);

		if(!$imgData || mysqli_num_rows($imgData) == 0){
			return null;
		}

		$counter = 0;
		$imgs;

		// var_dump($imgData);

		while ($row = $imgData->fetch_assoc()) {
	      //creating a session for listed property
			$imgs[$counter] = 
			array (
				'id' => $row['imageId'],
				'name' => $row['imageFileName'],
				'altText' => $row['alternateText'],
			);
			$counter++;
		}
		// var_dump($imgs);
		return $imgs;
	}


	public function getImageAutoIncrement($connection, $table){
		$stmt = "
		SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'home_main_db' AND TABLE_NAME = '$table'
		";

		$result = $connection->query($stmt);
		if ($result && mysql_fetch_row($result) == 1){	
			$row = $result->fetch_assoc();		
			return $row['AUTO_INCREMENT'];
		}
		return -1;
	}

	public function uploadImageToDatabase($imgName, $conn){
		$stmt = "INSERT INTO Images (imageFileName) VALUES ('$imgName')";
		if($conn->query($stmt)){
			// echo "success";
			return $conn->insert_id;
		}
		// echo "failed";
		return null;
	}

	public function createImageBridge($imgId, $objectId, $objectType, $conn){
		$stmt = "INSERT INTO ImageObjectBridge (imageId, objectId, objectType) VALUES ('$imgId', '$objectId', '$objectType')";
		return $conn->query($stmt);
	}

	public function removeImage($id, $conn){
		$stmt = "DELETE FROM Images WHERE imageId = '$id'";
		if($conn->query($stmt){
			return true;
		}
		return false;
	}

	public function removeImageBridge($id, $conn){
		$stmt = "DELETE FROM ImageObjectBridge WHERE imageId = '$id'";
		if($conn->query($stmt){
			return true;
		}
		return false;
	}

	public function deleteImage($imgId, $conn){
		if($this->removeImageBridge($imgId, $conn) && $this->removeImage($imgId, $conn)){
			return true;
		}
		return false;
	}

    //input name='imgSelector' for all instance that upload image is required
    //only upload/move image to a location and not database
	public function uploadImage($imgFiles, $objectId, $objectType, $conn){

		// var_dump($imgFiles);
		if($imgFiles === NULL){
			$this->alertMsg("No image files was selected");
			return false;
		}
		$target_dir = $_SERVER['DOCUMENT_ROOT']."/Home_Maintenance_Manager/public/img/";
		// var_dump($target_dir);
		foreach($imgFiles as $img){

			$prefix = $uniqueId = time().mt_rand(0,100);
			$imgName = $prefix . "_". basename($img["name"]);
			$target_file = $target_dir . $imgName;
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// var_dump($img["tmp_name"]);

			// Check if image file is a actual image or fake image
			$check = getimagesize($img["tmp_name"]);
			if($check !== false) {
			// $this->alert("File is an image - " . $check["mime"] . ".");
				$uploadOk = 1;
			} else {
			// $this->alert("File is not an image.");
				$uploadOk = 0;
			}

			// Check if file already exists
			if (file_exists($target_file)) {
			// $this->alert("Sorry, file already exists.");
				$uploadOk = 0;
			}
			// Check file size
			if ($img["size"] > 1000000) {
			// $this->alert("Sorry, your file is too large.");
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			// $this->alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
				$uploadOk = 0;
			}

			// Check if $uploadOk is good
			if ($uploadOk == 1) {			
			// if everything is ok, try to upload file
				if (move_uploaded_file($img["tmp_name"], $target_file)) {
					$last_id = $this->uploadImageToDatabase($imgName, $conn);
					var_dump($last_id);
					if ($last_id != null) {    					
						if($this->createImageBridge($last_id, $objectId, $objectType, $conn)){
							continue;// continue to next loop
						}else{
							// clean database by removing image if create bridge failed
							$this->alertMsg("failed to create image bridge");
							$this->removeImage($last_id, $conn);
							unlink($target_file);// delete moved img
						}
					}else{
						$this->alertMsg("failed to upload image to database");	
					}
				}
			}
		}
		return true;
	}
}


?>