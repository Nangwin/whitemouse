<?php

// Database functions
require_once("php/funcs/db_funcs.php");

// XML functions
require_once("php/funcs/xml_funcs.php");

// WOVOML 1.* functions
require_once("php/funcs/v1_funcs.php");

// Get code
$code=xml_get_att($da_dd_tlv_tlv_obj, "CODE");

// Get owners
$owners=$da_dd_tlv_tlv_obj['results']['owners'];

// Prepare link to ds_id
if (substr($da_dd_tlv_tlv_obj['results']['ds_id'], 0, 1)=="@") {
	$ds_id=$db_ids[substr($da_dd_tlv_tlv_obj['results']['ds_id'], 1)];
}
else {
	$ds_id=$da_dd_tlv_tlv_obj['results']['ds_id'];
}

// Prepare link to di_tlt_id
if (substr($da_dd_tlv_tlv_obj['results']['di_tlt_id'], 0, 1)=="@") {
	$di_tlt_id=$db_ids[substr($da_dd_tlv_tlv_obj['results']['di_tlt_id'], 1)];
}
else {
	$di_tlt_id=$da_dd_tlv_tlv_obj['results']['di_tlt_id'];
}

// INSERT or UPDATE?
$id=v1_get_id("dd_tlv", $code, $owners);

// If ID is NULL, INSERT
if ($id==NULL) {
	
	// Prepare variables
	$insert_table="dd_tlv";
	$field_name=array();
	$field_name[0]="dd_tlv_code";
	$field_name[1]="dd_tlv_stime";
	$field_name[2]="dd_tlv_stime_unc";
	$field_name[3]="dd_tlv_etime";
	$field_name[4]="dd_tlv_etime_unc";
	$field_name[5]="dd_tlv_mag";
	$field_name[6]="dd_tlv_magerr";
	$field_name[7]="dd_tlv_azi";
	$field_name[8]="dd_tlv_azierr";
	$field_name[9]="dd_tlv_com";
	$field_name[10]="ds_id";
	$field_name[11]="di_tlt_id";
	$field_name[12]="cc_id";
	$field_name[13]="cc_id2";
	$field_name[14]="cc_id3";
	$field_name[15]="dd_tlv_pubdate";
	$field_name[16]="cc_id_load";
	$field_name[17]="dd_tlv_loaddate";
	$field_name[18]="cb_ids";
	$field_value=array();
	$field_value[0]=$code;
	$field_value[1]=xml_get_ele($da_dd_tlv_tlv_obj, "STARTTIME");
	$field_value[2]=xml_get_ele($da_dd_tlv_tlv_obj, "STARTTIMEUNC");
	$field_value[3]=xml_get_ele($da_dd_tlv_tlv_obj, "ENDTIME");
	$field_value[4]=xml_get_ele($da_dd_tlv_tlv_obj, "ENDTIMEUNC");
	$field_value[5]=xml_get_ele($da_dd_tlv_tlv_obj, "MAGNITUDE");
	$field_value[6]=xml_get_ele($da_dd_tlv_tlv_obj, "MAGNITUDEUNC");
	$field_value[7]=xml_get_ele($da_dd_tlv_tlv_obj, "AZIMUTH");
	$field_value[8]=xml_get_ele($da_dd_tlv_tlv_obj, "AZIMUTHUNC");
	$field_value[9]=xml_get_ele($da_dd_tlv_tlv_obj, "COMMENTS");
	$field_value[10]=$ds_id;
	$field_value[11]=$di_tlt_id;
	$field_value[12]=$da_dd_tlv_tlv_obj['results']['owners'][0]['id'];
	$field_value[13]=$da_dd_tlv_tlv_obj['results']['owners'][1]['id'];
	$field_value[14]=$da_dd_tlv_tlv_obj['results']['owners'][2]['id'];
	$field_value[15]=$da_dd_tlv_tlv_obj['results']['pubdate'];
	$field_value[16]=$cc_id_load;
	$field_value[17]=$current_time;
	$field_value[18]=$cb_ids;
	
	// INSERT values into database and write UNDO file
	if (!v1_insert($undo_file_pointer, $insert_table, $field_name, $field_value, $upload_to_db, $last_insert_id, $error)) {
		$errors[$l_errors]=$error;
		$l_errors++;
		return FALSE;
	}
	
	// Store ID
	$da_dd_tlv_tlv_obj['id']=$last_insert_id;
	array_push($db_ids, $last_insert_id);
}
// Else, UPDATE
else {
	
	// Prepare variables
	$update_table="dd_tlv";
	$field_name=array();
	$field_name[0]="dd_tlv_pubdate";
	$field_name[1]="dd_tlv_stime";
	$field_name[2]="dd_tlv_stime_unc";
	$field_name[3]="dd_tlv_etime";
	$field_name[4]="dd_tlv_etime_unc";
	$field_name[5]="dd_tlv_mag";
	$field_name[6]="dd_tlv_magerr";
	$field_name[7]="dd_tlv_azi";
	$field_name[8]="dd_tlv_azierr";
	$field_name[9]="dd_tlv_com";
	$field_name[10]="ds_id";
	$field_name[11]="di_tlt_id";
	$field_name[12]="cc_id";
	$field_name[13]="cc_id2";
	$field_name[14]="cc_id3";
	$field_name[15]="cb_ids";
	$field_value=array();
	$field_value[0]=$da_dd_tlv_tlv_obj['results']['pubdate'];
	$field_value[1]=xml_get_ele($da_dd_tlv_tlv_obj, "STARTTIME");
	$field_value[2]=xml_get_ele($da_dd_tlv_tlv_obj, "STARTTIMEUNC");
	$field_value[3]=xml_get_ele($da_dd_tlv_tlv_obj, "ENDTIME");
	$field_value[4]=xml_get_ele($da_dd_tlv_tlv_obj, "ENDTIMEUNC");
	$field_value[5]=xml_get_ele($da_dd_tlv_tlv_obj, "MAGNITUDE");
	$field_value[6]=xml_get_ele($da_dd_tlv_tlv_obj, "MAGNITUDEUNC");
	$field_value[7]=xml_get_ele($da_dd_tlv_tlv_obj, "AZIMUTH");
	$field_value[8]=xml_get_ele($da_dd_tlv_tlv_obj, "AZIMUTHUNC");
	$field_value[9]=xml_get_ele($da_dd_tlv_tlv_obj, "COMMENTS");
	$field_value[10]=$ds_id;
	$field_value[11]=$di_tlt_id;
	$field_value[12]=$da_dd_tlv_tlv_obj['results']['owners'][0]['id'];
	$field_value[13]=$da_dd_tlv_tlv_obj['results']['owners'][1]['id'];
	$field_value[14]=$da_dd_tlv_tlv_obj['results']['owners'][2]['id'];
	$field_value[15]=$cb_ids;
	$where_field_name=array();
	$where_field_name[0]="dd_tlv_id";
	$where_field_value=array();
	$where_field_value[0]=$id;
	
	// UPDATE values in database and write UNDO file
	if (!v1_update($undo_file_pointer, $update_table, $field_name, $field_value, $where_field_name, $where_field_value, $upload_to_db, $error)) {
		$errors[$l_errors]=$error;
		$l_errors++;
		return FALSE;
	}
	
	// Store ID
	$da_dd_tlv_tlv_obj['id']=$id;
	array_push($db_ids, $id);
}

?>