<?php

// Database functions
require_once("php/funcs/db_funcs.php");

// XML functions
require_once("php/funcs/xml_funcs.php");

// WOVOML 1.* functions
require_once("php/funcs/v1_funcs.php");

// Get code
$code=xml_get_att($ms_hn_obj, "CODE");

// Get owners
$owners=$ms_hn_obj['results']['owners'];

// Get start time
$stime=xml_get_ele($ms_hn_obj, "STARTTIME");

// Get volcanoes
$vd_ids=$ms_hn_obj['results']['vd_ids'];
$vd_ids_cnt=count($vd_ids);

// INSERT or UPDATE?
$id=v1_get_id_cn_stime("hn", $code, $stime, $owners);

// If ID is NULL, INSERT
if ($id==NULL) {
	
	// Prepare variables
	$insert_table="cn";
	$field_name=array();
	$field_name[0]="cn_code";
	$field_name[1]="cn_name";
	$field_name[2]="cn_type";
	$field_name[3]="cn_area";
	$field_name[4]="cn_stime";
	$field_name[5]="cn_stime_unc";
	$field_name[6]="cn_etime";
	$field_name[7]="cn_etime_unc";
	$field_name[8]="cn_desc";
	$field_name[9]="cn_utc";
	$field_name[10]="cn_com";
	$field_name[11]="cc_id";
	$field_name[12]="cc_id2";
	$field_name[13]="cc_id3";
	$field_name[14]="cn_pubdate";
	$field_name[15]="cc_id_load";
	$field_name[16]="cn_loaddate";
	$field_name[17]="cb_ids";
	$field_value=array();
	$field_value[0]=$code;
	$field_value[1]=xml_get_ele($ms_hn_obj, "NAME");
	$field_value[2]="Hydrologic";
	$field_value[3]=xml_get_ele($ms_hn_obj, "AREA");
	$field_value[4]=$stime;
	$field_value[5]=xml_get_ele($ms_hn_obj, "STARTTIMEUNC");
	$field_value[6]=xml_get_ele($ms_hn_obj, "ENDTIME");
	$field_value[7]=xml_get_ele($ms_hn_obj, "ENDTIMEUNC");
	$field_value[8]=xml_get_ele($ms_hn_obj, "DESCRIPTION");
	$field_value[9]=xml_get_ele($ms_hn_obj, "DIFFUTC");
	$field_value[10]=xml_get_ele($ms_hn_obj, "COMMENTS");
	$field_value[11]=$ms_hn_obj['results']['owners'][0]['id'];
	$field_value[12]=$ms_hn_obj['results']['owners'][1]['id'];
	$field_value[13]=$ms_hn_obj['results']['owners'][2]['id'];
	$field_value[14]=$ms_hn_obj['results']['pubdate'];
	$field_value[15]=$cc_id_load;
	$field_value[16]=$current_time;
	$field_value[17]=$cb_ids;
	if ($vd_ids_cnt==1) {
		$field_name[18]="vd_id";
		$field_value[18]=$vd_ids[0];
	}
	
	// INSERT values into database and write UNDO file
	if (!v1_insert($undo_file_pointer, $insert_table, $field_name, $field_value, $upload_to_db, $last_insert_id, $error)) {
		$errors[$l_errors]=$error;
		$l_errors++;
		return FALSE;
	}
	
	// Store ID
	$ms_hn_obj['id']=$last_insert_id;
	array_push($db_ids, $last_insert_id);
}
// Else, UPDATE
else {
	
	// Prepare variables
	$update_table="cn";
	$field_name=array();
	$field_name[0]="cn_pubdate";
	$field_name[1]="cn_name";
	$field_name[2]="vd_id";
	$field_name[3]="cn_area";
	$field_name[4]="cn_desc";
	$field_name[5]="cn_stime_unc";
	$field_name[6]="cn_etime";
	$field_name[7]="cn_etime_unc";
	$field_name[8]="cn_utc";
	$field_name[9]="cn_com";
	$field_name[10]="cc_id";
	$field_name[11]="cc_id2";
	$field_name[12]="cc_id3";
	$field_name[13]="cb_ids";
	$field_value=array();
	$field_value[0]=$ms_hn_obj['results']['pubdate'];
	$field_value[1]=xml_get_ele($ms_hn_obj, "NAME");
	if ($vd_ids_cnt==1) {
		$field_value[2]=$vd_ids[0];
	}
	else {
		$field_value[2]="0";
	}
	$field_value[3]=xml_get_ele($ms_hn_obj, "AREA");
	$field_value[4]=xml_get_ele($ms_hn_obj, "DESCRIPTION");
	$field_value[5]=xml_get_ele($ms_hn_obj, "STARTTIMEUNC");
	$field_value[6]=xml_get_ele($ms_hn_obj, "ENDTIME");
	$field_value[7]=xml_get_ele($ms_hn_obj, "ENDTIMEUNC");
	$field_value[8]=xml_get_ele($ms_hn_obj, "DIFFUTC");
	$field_value[9]=xml_get_ele($ms_hn_obj, "COMMENTS");
	$field_value[10]=$ms_hn_obj['results']['owners'][0]['id'];
	$field_value[11]=$ms_hn_obj['results']['owners'][1]['id'];
	$field_value[12]=$ms_hn_obj['results']['owners'][2]['id'];
	$field_value[13]=$cb_ids;
	$where_field_name=array();
	$where_field_name[0]="cn_id";
	$where_field_value=array();
	$where_field_value[0]=$id;
	
	// UPDATE values in database and write UNDO file
	if (!v1_update($undo_file_pointer, $update_table, $field_name, $field_value, $where_field_name, $where_field_value, $upload_to_db, $error)) {
		$errors[$l_errors]=$error;
		$l_errors++;
		return FALSE;
	}
	
	// Store ID
	$ms_hn_obj['id']=$id;
	array_push($db_ids, $id);
	
	// DELETE data in jj_volnet
	$delete_table="jj_volnet";
	$field_name=array();
	$field_name[0]="jj_net_flag";
	$field_name[1]="jj_net_id";
	$field_name[2]="vd_id";
	$field_name[3]="cc_id_load";
	$field_name[4]="jj_volnet_loaddate";
	$where_field_name=array();
	$where_field_name[0]="jj_net_flag";
	$where_field_name[1]="jj_net_id";
	$where_field_value=array();
	$where_field_value[0]="C";
	$where_field_value[1]=$id;
	$logical=array();
	$logical[0]="AND";
	if (!v1_delete($undo_file_pointer, $delete_table, $field_name, $where_field_name, $where_field_value, $logical, $upload_to_db, $error)) {
		$errors[$l_errors]=$error;
		$l_errors++;
		return FALSE;
	}
}

// Volcanoes
if ($vd_ids_cnt>1) {
	foreach ($vd_ids as $vd_id) {
		// INSERT into jj_volnet
		$field_name=array();
		$field_name[0]="jj_net_flag";
		$field_name[1]="jj_net_id";
		$field_name[2]="vd_id";
		$field_name[3]="cc_id_load";
		$field_name[4]="jj_volnet_loaddate";
		$field_value=array();
		$field_value[0]="C";
		$field_value[1]=$ms_hn_obj['id'];
		$field_value[2]=$vd_id;
		$field_value[3]=$cc_id_load;
		$field_value[4]=$current_time;
		if (!v1_insert($undo_file_pointer, "jj_volnet", $field_name, $field_value, $upload_to_db, $last_insert_id, $error)) {
			$errors[$l_errors]=$error;
			$l_errors++;
			return FALSE;
		}
	}
}

// Upload children
foreach ($ms_hn_obj['value'] as &$ms_hn_ele) {
	switch ($ms_hn_ele['tag']) {
		case "HYDROLOGICSTATION":
			$ms_hn_hs_obj=&$ms_hn_ele;
			include "ms_hn_hs.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
	}
}

?>