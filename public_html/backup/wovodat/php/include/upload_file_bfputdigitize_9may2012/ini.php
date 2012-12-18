<?php

/**********************************

This script was used for uploading data contained in an �initialization� XML file.
This was used during the initialization phase of the project for uploading data to the �cc� table, but as of May 2011, it is not used anymore.

**********************************/

// Check extension: .xml
if ($ori_file_ext!="xml") {
	// Report error
	$error_code=4;
	$error_message="The extension of file you tried to upload does not match the selected file type ($file_type)";
	if (!report_error($ori_file_name, $file_name, $ul_file_name, $error_code, $error_message, $current_time_iso, $cc_id_load, $local_error)) {
		$_SESSION['errors']=array();
		$_SESSION['errors'][0]=array();
		$_SESSION['errors'][0]['code']=1506;
		$_SESSION['errors'][0]['message']=$local_error." [upload_file_check -> report_error(";
		$_SESSION['l_errors']=1;
		
		// Redirect to system error page
		header('Location: '.$url_root.'system_error.php');
		exit();
	}
}

// If user is not a developer
if ($_SESSION['permissions']['access']!=0) {
	// Check size of file
	if ($ul_file_size > 500000) {
		// Include file functions
		require_once "php/funcs/file_funcs.php";
		
		// Record file upload in DB
		if (!file_record($ori_file_name, "TBP", $file_type, $current_time, $cc_id_load, $record_error)) {
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1151;
			$_SESSION['errors'][0]['message']=$record_error." [ini.php -> file_record($file_name, TBP, $file_type)]";
			$_SESSION['l_errors']=1;
			header('Location: '.$url_root.'system_error.php');
			exit();
		}
		
		// File is larger than 500 kb - move to "to_be_processed"
		$move_ul_file_name=$incoming_dir."/to_be_processed/".$file_name;
		if (!rename($ul_file_name, $move_ul_file_name)) {
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1151;
			$_SESSION['errors'][0]['message']="ini.php -> rename(ul_file_name=".$ul_file_name.", move_ul_file_name=".$move_ul_file_name.")]";
			$_SESSION['l_errors']=1;
			header('Location: '.$url_root.'system_error.php');
			exit();
		}
		
		// Inform user
		$_SESSION['upload']['message']="File ".$ori_file_name." is too large to be processed immediately, thus we will process it later. We will contact you by email once it is done. Thank you for your understanding.";
		header('Location: '.$url_root.'upload_success.php');
		exit();
	}
}

// Set unlimited capacity and time for processing
ini_set("memory_limit","-1");
set_time_limit(0);

// Initialization functions
require_once "php/funcs/ini_funcs.php";

if ($file_type=="ini_csv_cc_no_ul") {
	$upload_to_db=FALSE;
}
else {
	$upload_to_db=TRUE;
}

// Upload data to the database
$errors=array();
$l_errors=0;
if (!ini_upload($ul_file_name, $cc_id_load, $upload_to_db, $errors, $l_errors)) {
	// An error occured during data upload
	
	// Security check
	if ($l_errors==0) {
		// Report error
		$error_code=1234;
		$error_message="ini_upload returned FALSE but no error was found [ini.php -> ini_upload(ul_file_name=$ul_file_name) / $file_type]";
		if (!report_error($ori_file_name, $file_name, $ul_file_name, $error_code, $error_message, $current_time_iso, $cc_id_load, $local_error)) {
			$_SESSION['errors']=array();
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1506;
			$_SESSION['errors'][0]['message']=$local_error." [ini.php -> report_error(file_name=$file_name, error_message=$error_message)]";
			$_SESSION['l_errors']=1;
			
			// Redirect to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		}
	}
	
	// Save errors
	$_SESSION['errors']=$errors;
	$_SESSION['l_errors']=$l_errors;
	
	// Report error
	$error_code=$errors[0]['code'];
	$error_message="($file_type) ".$errors[0]['message'];
	if (!report_error($ori_file_name, $file_name, $ul_file_name, $error_code, $error_message, $current_time_iso, $cc_id_load, $local_error)) {
		$_SESSION['errors']=array();
		$_SESSION['errors'][0]=array();
		$_SESSION['errors'][0]['code']=1506;
		$_SESSION['errors'][0]['message']=$local_error." [ini.php -> report_error(file_name=$file_name, error_message=$error_message, file_type= $file_type)]";
		$_SESSION['l_errors']=1;
		
		// Redirect to system error page
		header('Location: '.$url_root.'system_error.php');
		exit();
	}
}

// Upload successful!

// Record in upload history table
if ($file_type=="ini_no_ul") {
	// Remove file
	unlink($ul_file_name);
}
else {
	// Record in upload history table
	if (!file_record($ori_file_name, "P", $file_type, $current_time_iso, $cc_id_load, $record_error)) {
		$_SESSION['errors'][0]=array();
		$_SESSION['errors'][0]['code']=1151;
		$_SESSION['errors'][0]['message']=$record_error." [ini.php -> file_record(ori_file_name=$ori_file_name, P)]";
		$_SESSION['l_errors']=1;
		header('Location: '.$url_root.'system_error.php');
		exit();
	}
	
	// Move file to "processed" directory
	$move_ul_file_name=$incoming_dir."/processed/original/".$file_name;
	if (!rename($ul_file_name, $move_ul_file_name)) {
		$_SESSION['errors'][0]=array();
		$_SESSION['errors'][0]['code']=1151;
		$_SESSION['errors'][0]['message']="wovoml.php -> rename(ul_file_name=".$ul_file_name.", move_ul_file_name=".$move_ul_file_name.")]";
		$_SESSION['l_errors']=1;
		header('Location: '.$url_root.'system_error.php');
		exit();
	}
}

?>