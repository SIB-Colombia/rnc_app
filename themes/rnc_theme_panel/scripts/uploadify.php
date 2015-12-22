<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = DIRECTORY_SEPARATOR.'temp_rnc'; // Relative to the root

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	
	$aux_name	= rand(10, 999);
        $targetFile = rtrim($targetPath,DIRECTORY_SEPARATOR) .DIRECTORY_SEPARATOR. $_POST['randWord'].'_'.$_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('txt','xls','csv', 'xlsx'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	
	if(move_uploaded_file($tempFile,$targetFile)){
		echo '1';
	}else {
		echo 'Error Upload file';
	}
	/*if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}*/
}
?>
