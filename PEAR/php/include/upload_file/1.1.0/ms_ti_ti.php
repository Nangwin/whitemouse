<?php

// Database functions
require_once("php/funcs/db_funcs.php");

// XML functions
require_once("php/funcs/xml_funcs.php");

// WOVOML 1.* functions
require_once("php/funcs/v1_funcs.php");

// Get code
$code=xml_get_att($ms_ti_ti_obj, "CODE");

// Get owners
$owners=$ms_ti_ti_obj['results']['owners'];

// Get start time
$stime=xml_get_ele($ms_ti_ti_obj, "STARTTIME");

// Prepare link to ts_id
if (substr($ms_ti_ti_obj['results']['ts_id'], 0, 1)=="@") {
	$ts_id=$db_ids[substr($ms_ti_ti_obj['results']['ts_id'], 1)];
}
else {
	$ts_id=$ms_ti_ti_obj['results']['ts_id'];
}

// Prepare link to cs_id
if (substr($ms_ti_ti_obj['results']['cs_id'], 0, 1)=="@") {
	$cs_id=$db_ids[substr($ms_ti_ti_obj['results']['cs_id'], 1)];
}
else {
	$cs_id=$ms_ti_ti_obj['results']['cs_id'];
}

// INSERT or UPDATE?
$id=v1_get_id_ms("ti", $code, $stime, $owners);

// If ID is NULL, INSERT
if ($id==NULL) {
	
	// Prepare variables
	$insert_table="ti";
	$field_name=array();
	$field_name[0]="ti_code";
	$field_name[1]="ti_name";
	$field_name[2]="ti_type";
	$field_name[3]="ti_units";
	$field_name[4]="ti_pres";
	$field_name[5]="ti_stn";
	$field_name[6]="ti_stime";
	$field_name[7]="ti_stime_unc";
	$field_name[8]="ti_etime";
	$field_name[9]="ti_etime_unc";
	$field_name[10]="ti_com";
	$field_name[11]="ts_id";
	$field_name[12]="cc_id";
	$field_name[13]="cc_id2";
	$field_name[14]="cc_id3";
	$field_name[15]="ti_pubdate";
	$field_name[16]="cc_id_load";
	$field_name[17]="ti_loaddate";
	$field_name[18]="cs_id";
	$field_name[19]="cb_ids";
	$field_value=array();
	$field_value[0]=$code;
	$field_value[1]=xml_get_ele($ms_ti_ti_obj, "NAME");
	$field_value[2]=xml_get_ele($ms_ti_ti_obj, "TYPE");
	$field_value[3]=xml_get_ele($ms_ti_ti_obj, "UNITS");
	$field_value[4]=xml_get_ele($ms_ti_ti_obj, "RESOLUTION");
	$field_value[5]=xml_get_ele($ms_ti_ti_obj, "SIGNALTONOISE");
	$field_value[6]=$stime;
	$field_value[7]=xml_get_ele($ms_ti_ti_obj, "STARTTIMEUNC");
	$field_value[8]=xml_get_ele($ms_ti_ti_obj, "ENDTIME");
	$field_value[9]=xml_get_ele($ms_ti_ti_obj, "ENDTIMEUNC");
	$field_value[10]=xml_get_ele($ms_ti_ti_obj, "COMMENTS");
	$field_value[11]=$ts_id;
	$field_value[12]=$ms_ti_ti_obj['results']['owners'][0]['id'];
	$field_value[13]=$ms_ti_ti_obj['results']['owners'][1]['id'];
	$field_value[14]=$ms_ti_ti_obj['results']['owners'][2]['id'];
	$field_value[15]=$ms_ti_ti_obj['results']['pubdate'];
	$field_value[16]=$cc_id_load;
	$field_value[17]=$current_time;
	$field_value[18]=$cs_id;
	$field_value[19]=$cb_ids;
	
	// INSERT values into database and write UNDO file
	if (!v1_insert($undo_file_pointer, $insert_table, $field_name, $field_value, $upload_to_db, $last_insert_id, $error)) {
		$errors[$l_errors]=$error;
		$l_errors++;
		return FALSE;
	}
	
	// Store ID
	$ms_ti_ti_obj['id']=$last_insert_id;
	array_push($db_ids, $last_insert_id);
}
// Else, UPDATE
else {
	
	// Prepare variables
	$update_table="ti";
	$field_name=array();
	$field_name[0]="ti_pubdate";
	$field_name[1]="ti_name";
	$field_name[2]="ti_type";
	$field_name[3]="ti_units";
	$field_name[4]="ti_pres";
	$field_name[5]="ti_stn";
	$field_name[6]="ts_id";
	$field_name[7]="ti_stime_unc";
	$field_name[8]="ti_etime";
	$field_name[9]="ti_etime_unc";
	$field_name[10]="ti_com";
	$field_name[11]="cc_id";
	$field_name[12]="cc_id2";
	$field_name[13]="cc_id3";
	$field_name[14]="cs_id";
	$field_name[15]="cb_ids";
	$field_value=array();
	$field_value[0]=$ms_ti_ti_obj['results']['pubdate'];
	$field_value[1]=xml_get_ele($ms_ti_ti_obj, "NAME");
	$field_value[2]=xml_get_ele($ms_ti_ti_obj, "TYPE");
	$field_value[3]=xml_get_ele($ms_ti_ti_obj, "UNITS");
	$field_value[4]=xml_get_ele($ms_ti_ti_obj, "RESOLUTION");
	$field_value[5]=xml_get_ele($ms_ti_ti_obj, "SIGNALTONOISE");
	$field_value[6]=$ts_id;
	$field_value[7]=xml_get_ele($ms_ti_ti_obj, "STARTTIMEUNC");
	$field_value[8]=xml_get_ele($ms_ti_ti_obj, "ENDTIME");
	$field_value[9]=xml_get_ele($ms_ti_ti_obj, "ENDTIMEUNC");
	$field_value[10]=xml_get_ele($ms_ti_ti_obj, "COMMENTS");
	$field_value[11]=$ms_ti_ti_obj['results']['owners'][0]['id'];
	$field_value[12]=$ms_ti_ti_obj['results']['owners'][1]['id'];
	$field_value[13]=$ms_ti_ti_obj['results']['owners'][2]['id'];
	$field_value[14]=$cs_id;
	$field_value[15]=$cb_ids;
	$where_field_name=array();
	$where_field_name[0]="ti_id";
	$where_field_value=array();
	$where_field_value[0]=$id;
	
	// UPDATE values in database and write UNDO file
	if (!v1_update($undo_file_pointer, $update_table, $field_name, $field_value, $where_field_name, $where_field_value, $upload_to_db, $error)) {
		$errors[$l_errors]=$error;
		$l_errors++;
		return FALSE;
	}
	
	// Store ID
	$ms_ti_ti_obj['id']=$id;
	array_push($db_ids, $id);
}

?>