<?php

// vvv Set variables
$ms_sn_ss_key="ss";
$ms_sn_ss_name="SeismicStation";

// ^^^ Get code
$code=xml_get_att($ms_sn_ss_obj, "CODE");

// -- CHECK DATA --

// ^^^ Get owners
if (!v1_get_owners($ms_sn_ss_obj, $error)) {
	$errors[$l_errors]=$error;
	$l_errors++;
	return FALSE;
}

// vvv Set owners
if (!v1_set_owners($ms_sn_ss_obj)) {
	// Missing information
	$errors[$l_errors]=array();
	$errors[$l_errors]['code']=1;
	$errors[$l_errors]['message']="&lt;".$ms_sn_ss_name." code=\"".$code."\"&gt; is missing information: please specify owner";
	$l_errors++;
	return FALSE;
}

// ^^^ Get times
$ms_sn_ss_stime=xml_get_ele($ms_sn_ss_obj, "STARTTIME");
$ms_sn_ss_etime=xml_get_ele($ms_sn_ss_obj, "ENDTIME");

// ### Check time order
if (!empty($ms_sn_ss_stime) && !empty($ms_sn_ss_etime)) {
	if (strcmp($ms_sn_ss_stime, $ms_sn_ss_etime)>0) {
		$errors[$l_errors]=array();
		$errors[$l_errors]['code']=2;
		$errors[$l_errors]['message']="In &lt;".$ms_sn_ss_name." code=\"".$code."\"&gt;, start time (".$ms_sn_ss_stime.") should be earlier than end time (".$ms_sn_ss_etime.")";
		$l_errors++;
		return FALSE;
	}
}

// ### Check time inclusion
// Parent start time < this start time
if (!empty($ms_sn_stime) && !empty($ms_sn_ss_stime)) {
	if (strcmp($ms_sn_stime, $ms_sn_ss_stime)>0) {
		$errors[$l_errors]=array();
		$errors[$l_errors]['code']=2;
		$errors[$l_errors]['message']="In &lt;".$ms_sn_ss_name." code=\"".$code."\"&gt;, start time (".$ms_sn_ss_stime.") should be later than ".$ms_sn_name." start time (".$ms_sn_stime.")";
		$l_errors++;
		return FALSE;
	}
}
// Parent start time < this end time
if (!empty($ms_sn_stime) && !empty($ms_sn_ss_etime)) {
	if (strcmp($ms_sn_stime, $ms_sn_ss_etime)>0) {
		$errors[$l_errors]=array();
		$errors[$l_errors]['code']=2;
		$errors[$l_errors]['message']="In &lt;".$ms_sn_ss_name." code=\"".$code."\"&gt;, end time (".$ms_sn_ss_etime.") should be later than ".$ms_sn_name." start time (".$ms_sn_stime.")";
		$l_errors++;
		return FALSE;
	}
}
// This start time < parent end time
if (!empty($ms_sn_ss_stime) && !empty($ms_sn_etime)) {
	if (strcmp($ms_sn_ss_stime, $ms_sn_etime)>0) {
		$errors[$l_errors]=array();
		$errors[$l_errors]['code']=2;
		$errors[$l_errors]['message']="In &lt;".$ms_sn_ss_name." code=\"".$code."\"&gt;, start time (".$ms_sn_ss_stime.") should be earlier than ".$ms_sn_name." end time (".$ms_sn_etime.")";
		$l_errors++;
		return FALSE;
	}
}
// This end time < parent end time
if (!empty($ms_sn_ss_etime) && !empty($ms_sn_etime)) {
	if (strcmp($ms_sn_ss_etime, $ms_sn_etime)>0) {
		$errors[$l_errors]=array();
		$errors[$l_errors]['code']=2;
		$errors[$l_errors]['message']="In &lt;".$ms_sn_ss_name." code=\"".$code."\"&gt;, end time (".$ms_sn_ss_etime.") should be earlier than ".$ms_sn_name." end time (".$ms_sn_etime.")";
		$l_errors++;
		return FALSE;
	}
}

// ^^^ Get publish date
v1_get_pubdate($ms_sn_ss_obj);

// vvv Set publish date
$data_time=array($ms_sn_ss_stime, $ms_sn_ss_etime);
v1_set_pubdate($data_time, $current_time, $ms_sn_ss_obj);

// -- CHECK DUPLICATION --

// ### Check duplication
$final_owners=$ms_sn_ss_obj['results']['owners'];
if (!v1_check_dupli_timeframe($ms_sn_ss_name, $ms_sn_ss_key, $code, $ms_sn_ss_stime, $ms_sn_ss_etime, $final_owners, $dupli_error)) {
	// Duplication found
	$errors[$l_errors]=array();
	$errors[$l_errors]['code']=7;
	$errors[$l_errors]['message']=$dupli_error;
	$l_errors++;
	return FALSE;
}

// -- RECORD OBJECT --

// ^^^ Get ID (for underlying elements)
$ms_sn_ss_id=v1_get_id_ms("ss", $code, $ms_sn_ss_stime, $final_owners);
if ($ms_sn_ss_id==NULL) {
	// Get XML ID
	$ms_sn_ss_id="@".$xml_id_cnt;
}

// vvv Record object
$data=array();
$data['sn_id']=$ms_sn_id;
$data['owners']=$final_owners;
$data['stime']=$ms_sn_ss_stime;
$data['etime']=$ms_sn_ss_etime;
v1_record_obj($ms_sn_ss_key, $code, $data);

// -- CHECK DATABASE --

// ### Check existing data in database
if (!v1_check_db_timeframe($ms_sn_ss_name, $ms_sn_ss_key, $code, $ms_sn_ss_stime, $ms_sn_ss_etime, $final_owners, $check_db_error)) {
	// Duplication found
	$errors[$l_errors]=array();
	$errors[$l_errors]['code']=8;
	$errors[$l_errors]['message']=$check_db_error;
	$l_errors++;
	return FALSE;
}

// -- CHECK CHILDREN --

// ### Check children
foreach ($ms_sn_ss_obj['value'] as &$ms_sn_ss_ele) {
	switch ($ms_sn_ss_ele['tag']) {
		case "SEISMICINSTRUMENT":
			$ms_sn_ss_si_obj=&$ms_sn_ss_ele;
			include "ms_sn_ss_si.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
	}
}

// -- PREPARE DISPLAY --

// Increment data count (for display)
if (!isset($data_list[$ms_sn_ss_key])) {
	$data_list[$ms_sn_ss_key]=array();
	$data_list[$ms_sn_ss_key]['name']="Seismic station";
	$data_list[$ms_sn_ss_key]['number']=0;
	$data_list[$ms_sn_ss_key]['sets']=array();
}
$data_list[$ms_sn_ss_key]['number']++;

// -- POP OUT GENERAL INFO --

// Pop general informations
array_shift($gen_owners);
array_shift($gen_pubdates);

?>