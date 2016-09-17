<?php 
	print_r($_FILES);
	for($i=0; $i<count($_FILES['file']['name']); $i++){
		if(move_uploaded_file($_FILES['file']['tmp_name'][$i],"uploads/" . $_FILES["file"]["name"][$i])) {
			echo "The file has been uploaded successfully <br />";
		} else{
			echo "There was an error uploading the file, please try again! <br />";
		}
	}
?>