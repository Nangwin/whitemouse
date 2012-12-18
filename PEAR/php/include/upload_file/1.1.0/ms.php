<?php

// Upload children
foreach ($ms_obj['value'] as &$ms_ele) {
	switch ($ms_ele['tag']) {
		case "AIRPLANE":
			$ms_cs_obj=&$ms_ele;
			include "ms_cs.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
		case "DEFORMATIONNETWORK":
			$ms_dn_obj=&$ms_ele;
			include "ms_dn.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
		case "DEFORMATIONSTATIONS":
			$ms_ds_obj=&$ms_ele;
			include "ms_ds.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
		case "DEFORMATIONINSTRUMENTS":
			$ms_di_obj=&$ms_ele;
			include "ms_di.php";
			if (!empty($errors)) {
				return FALSE;
			}
		case "GASNETWORK":
			$ms_gn_obj=&$ms_ele;
			include "ms_gn.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
		case "GASSTATIONS":
			$ms_gs_obj=&$ms_ele;
			include "ms_gs.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
		case "GASINSTRUMENTS":
			$ms_gi_obj=&$ms_ele;
			include "ms_gi.php";
			if (!empty($errors)) {
				return FALSE;
			}
		case "HYDROLOGICNETWORK":
			$ms_hn_obj=&$ms_ele;
			include "ms_hn.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
		case "HYDROLOGICSTATIONS":
			$ms_hs_obj=&$ms_ele;
			include "ms_hs.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
		case "HYDROLOGICINSTRUMENTS":
			$ms_hi_obj=&$ms_ele;
			include "ms_hi.php";
			if (!empty($errors)) {
				return FALSE;
			}
		case "FIELDSNETWORK":
			$ms_fn_obj=&$ms_ele;
			include "ms_fn.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
		case "FIELDSSTATIONS":
			$ms_fs_obj=&$ms_ele;
			include "ms_fs.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
		case "FIELDSINSTRUMENTS":
			$ms_fi_obj=&$ms_ele;
			include "ms_fi.php";
			if (!empty($errors)) {
				return FALSE;
			}
		case "THERMALNETWORK":
			$ms_tn_obj=&$ms_ele;
			include "ms_tn.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
		case "THERMALSTATIONS":
			$ms_ts_obj=&$ms_ele;
			include "ms_ts.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
		case "THERMALINSTRUMENTS":
			$ms_ti_obj=&$ms_ele;
			include "ms_ti.php";
			if (!empty($errors)) {
				return FALSE;
			}
		case "SEISMICNETWORK":
			$ms_sn_obj=&$ms_ele;
			include "ms_sn.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
		case "SEISMICSTATIONS":
			$ms_ss_obj=&$ms_ele;
			include "ms_ss.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
		case "SEISMICINSTRUMENTS":
			$ms_si_obj=&$ms_ele;
			include "ms_si.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
		case "SEISMICCOMPONENTS":
			$ms_sc_obj=&$ms_ele;
			include "ms_sc.php";
			if (!empty($errors)) {
				return FALSE;
			}
			break;
	}
}

?>