<?php

// Database functions
require_once("php/funcs/db_funcs.php");

// XML functions
require_once("php/funcs/xml_funcs.php");

// WOVOML 1.* functions
require_once("php/funcs/v1_funcs.php");

// Get code
$code=xml_get_att($da_sd_evs_evs_obj, "CODE");

// Get owners
$owners=$da_sd_evs_evs_obj['results']['owners'];

// Prepare link to ss_id
if (substr($da_sd_evs_evs_obj['results']['ss_id'], 0, 1)=="@") {
	$ss_id=$db_ids[substr($da_sd_evs_evs_obj['results']['ss_id'], 1)];
}
else {
	$ss_id=$da_sd_evs_evs_obj['results']['ss_id'];
}

// INSERT or UPDATE?
$id=v1_get_id("sd_evs", $code, $owners);

// If ID is NULL, INSERT
if ($id==NULL) {
	
	// Prepare variables
	$insert_table="sd_evs";
	$field_name=array();
	$field_name[0]="sd_evs_code";
	$field_name[1]="sd_evs_time";
	$field_name[2]="sd_evs_time_ms";
	$field_name[3]="sd_evs_time_unc";
	$field_name[4]="sd_evs_time_unc_ms";
	$field_name[5]="sd_evs_dur";
	$field_name[6]="sd_evs_dur_unc";
	$field_name[7]="sd_evs_picks";
	$field_name[8]="sd_evs_spint";
	$field_name[9]="sd_evs_dist_actven";
	$field_name[10]="sd_evs_maxamptrac";
	$field_name[11]="sd_evs_samp";
	$field_name[12]="ss_id";
	$field_name[13]="cc_id";
	$field_name[14]="cc_id2";
	$field_name[15]="cc_id3";
	$field_name[16]="sd_evs_pubdate";
	$field_name[17]="cc_id_load";
	$field_name[18]="sd_evs_loaddate";
	$field_name[19]="cb_ids";
	$field_value=array();
	$field_value[0]=$code;
	$field_value[1]=$da_sd_evs_evs_obj['results']['sd_evs_time'];
	$field_value[2]=$da_sd_evs_evs_obj['results']['sd_evs_time_ms'];
	$field_value[3]=$da_sd_evs_evs_obj['results']['sd_evs_time_unc'];
	$field_value[4]=$da_sd_evs_evs_obj['results']['sd_evs_time_unc_ms'];
	$field_value[5]=xml_get_ele($da_sd_evs_evs_obj, "DURATION");
	$field_value[6]=xml_get_ele($da_sd_evs_evs_obj, "DURATIONUNC");
	$field_value[7]=xml_get_ele($da_sd_evs_evs_obj, "PICKSDETERMINATION");
	$field_value[8]=xml_get_ele($da_sd_evs_evs_obj, "SPINTERVAL");
	$field_value[9]=xml_get_ele($da_sd_evs_evs_obj, "DISTACTIVEVENT");
	$field_value[10]=xml_get_ele($da_sd_evs_evs_obj, "MAXAMPLITUDE");
	$field_value[11]=xml_get_ele($da_sd_evs_evs_obj, "SAMPLERATE");
	$field_value[12]=$ss_id;
	$field_value[13]=$da_sd_evs_evs_obj['results']['owners'][0]['id'];
	$field_value[14]=$da_sd_evs_evs_obj['results']['owners'][1]['id'];
	$field_value[15]=$da_sd_evs_evs_obj['results']['owners'][2]['id'];
	$field_value[16]=$da_sd_evs_evs_obj['results']['pubdate'];
	$field_value[17]=$cc_id_load;
	$field_value[18]=$current_time;
	$field_value[19]=$cb_ids;
	
	// INSERT values into database and write UNDO file
	if (!v1_insert($undo_file_pointer, $insert_table, $field_name, $field_value, $upload_to_db, $last_insert_id, $error)) {
		$errors[$l_errors]=$error;
		$l_errors++;
		return FALSE;
	}
	
	// Store ID
	$da_sd_evs_evs_obj['id']=$last_insert_id;
	array_push($db_ids, $last_insert_id);
}
// Else, UPDATE
else {
	
	// Prepare variables
	$update_table="sd_evs";
	$field_name=array();
	$field_name[0]="sd_evs_pubdate";
	$field_name[1]="sd_evs_time";
	$field_name[2]="sd_evs_time_ms";
	$field_name[3]="sd_evs_time_unc";
	$field_name[4]="sd_evs_time_unc_ms";
	$field_name[5]="sd_evs_dur";
	$field_name[6]="sd_evs_dur_unc";
	$field_name[7]="sd_evs_picks";
	$field_name[8]="sd_evs_spint";
	$field_name[9]="sd_evs_dist_actven";
	$field_name[10]="sd_evs_maxamptrac";
	$field_name[11]="sd_evs_samp";
	$field_name[12]="ss_id";
	$field_name[13]="cc_id";
	$field_name[14]="cc_id2";
	$field_name[15]="cc_id3";
	$field_name[16]="cb_ids";
	$field_value=array();
	$field_value[0]=$da_sd_evs_evs_obj['results']['pubdate'];
	$field_value[1]=$da_sd_evs_evs_obj['results']['sd_evs_time'];
	$field_value[2]=$da_sd_evs_evs_obj['results']['sd_evs_time_ms'];
	$field_value[3]=$da_sd_evs_evs_obj['results']['sd_evs_time_unc'];
	$field_value[4]=$da_sd_evs_evs_obj['results']['sd_evs_time_unc_ms'];
	$field_value[5]=xml_get_ele($da_sd_evs_evs_obj, "DURATION");
	$field_value[6]=xml_get_ele($da_sd_evs_evs_obj, "DURATIONUNC");
	$field_value[7]=xml_get_ele($da_sd_evs_evs_obj, "PICKSDETERMINATION");
	$field_value[8]=xml_get_ele($da_sd_evs_evs_obj, "SPINTERVAL");
	$field_value[9]=xml_get_ele($da_sd_evs_evs_obj, "DISTACTIVEVENT");
	$field_value[10]=xml_get_ele($da_sd_evs_evs_obj, "MAXAMPLITUDE");
	$field_value[11]=xml_get_ele($da_sd_evs_evs_obj, "SAMPLERATE");
	$field_value[12]=$ss_id;
	$field_value[13]=$da_sd_evs_evs_obj['results']['owners'][0]['id'];
	$field_value[14]=$da_sd_evs_evs_obj['results']['owners'][1]['id'];
	$field_value[15]=$da_sd_evs_evs_obj['results']['owners'][2]['id'];
	$field_value[16]=$cb_ids;
	$where_field_name=array();
	$where_field_name[0]="sd_evs_id";
	$where_field_value=array();
	$where_field_value[0]=$id;
	
	// UPDATE values in database and write UNDO file
	if (!v1_update($undo_file_pointer, $update_table, $field_name, $field_value, $where_field_name, $where_field_value, $upload_to_db, $error)) {
		$errors[$l_errors]=$error;
		$l_errors++;
		return FALSE;
	}
	
	// Store ID
	$da_sd_evs_evs_obj['id']=$id;
	array_push($db_ids, $id);
}

?>