<?php

$servpath=".";
require_once($servpath."/f2genfunc/func_xmlparse.php"); // class xml parser 
require_once($servpath."/f2genfunc/funcgen_printarray.php"); 


if($conv=="SeismicNetwork") 
	$datatype="sn";
if($conv=="SeismicStation") 
	$datatype="ss";
if($conv=="SeismicInstrument") 
	$datatype="si";
if($conv=="SeismicComponent") 
	$datatype="si_cmp";
if($conv=="DeformationNetwork" || $conv=="GasNetwork" || $conv=="HydrologicNetwork" || $conv=="ThermalNetwork" || $conv=="FieldsNetwork") 
	$datatype="cn";
if($conv=="DeformationStation")
	$datatype="ds";
if($conv=="DeformationInstrument_General")
	$datatype="di_gen";
if($conv == 'DeformationInstrument_Tilt/Strain')	
	$datatype="di_tlt";
if($conv=="HydrologicStation") 
	$datatype="hs";
if($conv=="HydrologicInstrument")
	$datatype="hi";
if($conv=="GasStation") 
	$datatype="gs";
if($conv=="GasInstrument")
	$datatype="gi";
if($conv=="ThermalStation") 
	$datatype="ts";
if($conv=="ThermalInstrument") 
	$datatype="ti";
if($conv=="FieldsStation")
	$datatype="fs";
if($conv=="FieldsInstrument") 
	$datatype="fi";
	

$filetag="wovodat2wovoml11.xml";
$datafile=file_get_contents($filetag);
$params=xml2ary_1($datafile); 
$tag=$params;

$table_ini=$datatype;
$monitorcode=$datatype."_code";
$newfileheader=array();
	

foreach($tag as $k => $v){
	if(is_array($v)){
		foreach($v as $k1 => $v1){
			if(is_array($v1)){
				if($k1==$table_ini){
					foreach($v1 as $k2 => $v2){
						$newfileheader[$k2]=$v2;
}	}	}	}	}	}


for($i=1;$i<$count;$i++){ 
	for($j=0;$j<sizeof($fileheader[0]);$j++){
		$a[]=$fileheader[0][$j];
		$b[]=$fileheader[$i][$j];
	}
	$fileheaderarray[]=array_combine($a,$b);
}


for($i=0; $i < count($fileheaderarray);$i++){
	
	$code[]= $fileheaderarray[$i][$monitorcode];         
	
	if($fileheaderarray[$i]['cc_id2'] != '' && $fileheaderarray[$i]['cc_id2'] != 'NULL'){
		$owner2=$fileheaderarray[$i]['cc_id2'];     
		$owner2="owner2=\"$owner2\"";
	}	
	if($fileheaderarray[$i]['cc_id3'] != '' && $fileheaderarray[$i]['cc_id3'] != 'NULL'){
		$owner3=$fileheaderarray[$i]['cc_id3'];     
		$owner3="owner3=\"$owner3\"";
	}
	
	if($conv =='GasInstrument' || $conv =='ThermalInstrument') {
		if($fileheaderarray[$i]['cs_id'] != '' && $fileheaderarray[$i]['cs_id'] != 'NULL'){
			$cs_code[]=$fileheaderarray[$i]['cs_id'];     
		}else{
			$cs_code[]="";
		}
	}
	
}

//------------------------------------------------------- 


if($conv == 'SeismicNetwork' || $conv == 'DeformationNetwork' || $conv == 'GasNetwork' || $conv == 'HydrologicNetwork' || $conv == 'ThermalNetwork' || $conv == 'FieldsNetwork'){

$header = <<<HTMLBLOCK
<?xml version="1.0" encoding="UTF-8" ?> 
<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
version="1.1.0" xsi:schemaLocation="http://www.wovodat.org/WOVOdatV1.xsd">
<MonitoringSystems>
HTMLBLOCK;


$footer = <<<'FOOT'
</MonitoringSystems>
</wovoml>
FOOT;

$rowprefix = <<<HTMLBLOCK
<Volcanoes>
	<volcanoCode>$volcode</volcanoCode>
</Volcanoes>
HTMLBLOCK;

	for($j=0;$j<sizeof($code);$j++){
		if((isset($owner2)) && (isset($owner3))){
			$rowhead[$j+1]= "$conv code=\"$code[$j]\" owner1=\"$observ\" $owner2 $owner3";
		}else if(isset($owner2)){
			$rowhead[$j+1]= "$conv code=\"$code[$j]\" owner1=\"$observ\" $owner2";	
		}else if(isset($owner3)){
			$rowhead[$j+1]= "$conv code=\"$code[$j]\" owner1=\"$observ\" $owner3";	
		}else{
			$rowhead[$j+1]= "$conv code=\"$code[$j]\" owner1=\"$observ\"";	
		}	
		
	}
$rowfoot = "$conv";
}
else if($conv == 'SeismicStation' || $conv == 'DeformationStation' || $conv == 'GasStation' || $conv == 'HydrologicStation' || $conv == 'ThermalStation' || $conv == 'FieldsStation'){

$staparent=$conv."s";

$header = <<<HTMLBLOCK
<?xml version="1.0" encoding="UTF-8" ?>
<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
version="1.1.0" xsi:schemaLocation="http://www.wovodat.org/WOVOdatV1.xsd">
<MonitoringSystems>
<$staparent network="$network" owner1="$observ">
HTMLBLOCK;


$footer = <<<FOOT
</$staparent>
</MonitoringSystems>
</wovoml>
FOOT;

$rowprefix = "";

	for($j=0;$j<sizeof($code);$j++){

		if((isset($owner2)) && (isset($owner3))){
			$rowhead[$j+1]= "$conv code=\"$code[$j]\" network=\"$network\" owner1=\"$observ\" $owner2 $owner3";
		}else if(isset($owner2)){
			$rowhead[$j+1]= "$conv code=\"$code[$j]\" network=\"$network\" owner1=\"$observ\" $owner2";
		}else if(isset($owner3)){
			$rowhead[$j+1]= "$conv code=\"$code[$j]\" network=\"$network\" owner1=\"$observ\" $owner3";		
		}else{
			$rowhead[$j+1]= "$conv code=\"$code[$j]\" network=\"$network\" owner1=\"$observ\"";		
		}
	}

$rowfoot = "$conv";
}
else if($conv == 'SeismicInstrument' || $conv == 'DeformationInstrument_General' || $conv == 'DeformationInstrument_Tilt/Strain' || $conv =='GasInstrument' || $conv == 'HydrologicInstrument' || $conv == 'ThermalInstrument' || $conv == 'FieldsInstrument' ){


if($conv == 'DeformationInstrument_General' || $conv == 'DeformationInstrument_Tilt/Strain'){
	$instrparent= "DeformationInstruments";
	$conv="DeformationInstrument";
}else{
	$instrparent=$conv."s";
}	


$header = <<<HTMLBLOCK
<?xml version="1.0" encoding="UTF-8" ?>
<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
version="1.1.0" xsi:schemaLocation="http://www.wovodat.org/WOVOdatV1.xsd">
<MonitoringSystems>
<$instrparent station="$station" owner1="$observ">
HTMLBLOCK;


$footer = <<<FOOT
</$instrparent>
</MonitoringSystems>
</wovoml>
FOOT;

$rowprefix = "";
		
	
for($j=0;$j<sizeof($code);$j++){

	if($conv =='GasInstrument' || $conv =='ThermalInstrument') {
		if($cs_code[$j] == ''){
			if((isset($owner2)) && (isset($owner3))){
				$rowhead[$j+1]= "$conv code=\"$code[$j]\" station=\"$station\" owner1=\"$observ\" $owner2 $owner3";
			}else if(isset($owner2)){
				$rowhead[$j+1]= "$conv code=\"$code[$j]\" station=\"$station\" owner1=\"$observ\" $owner2";	
			}else if(isset($owner3)){
				$rowhead[$j+1]= "$conv code=\"$code[$j]\" station=\"$station\" owner1=\"$observ\" $owner3";		
			}else{
				$rowhead[$j+1]= "$conv code=\"$code[$j]\" station=\"$station\" owner1=\"$observ\"";	
			}		
		}else{
		
			if((isset($owner2)) && (isset($owner3))){
				$rowhead[$j+1]= "$conv code=\"$code[$j]\" airplane=\"$cs_code[$j]\" owner1=\"$observ\" $owner2 $owner3";
			}else if(isset($owner2)){
				$rowhead[$j+1]= "$conv code=\"$code[$j]\" airplane=\"$cs_code[$j]\" owner1=\"$observ\" $owner2";
			}else if(isset($owner3)){
				$rowhead[$j+1]= "$conv code=\"$code[$j]\" airplane=\"$cs_code[$j]\" owner1=\"$observ\" $owner3";	
			}else{
				$rowhead[$j+1]= "$conv code=\"$code[$j]\" airplane=\"$cs_code[$j]\" owner1=\"$observ\"";
			}		
		}
	}else{
		if((isset($owner2)) && (isset($owner3))){
			$rowhead[$j+1]= "$conv code=\"$code[$j]\" station=\"$station\" owner1=\"$observ\" $owner2 $owner3";
		}else if(isset($owner2)){
			$rowhead[$j+1]= "$conv code=\"$code[$j]\" station=\"$station\" owner1=\"$observ\" $owner2";	
		}else if(isset($owner3)){
			$rowhead[$j+1]= "$conv code=\"$code[$j]\" station=\"$station\" owner1=\"$observ\" $owner3";		
		}else{
			$rowhead[$j+1]= "$conv code=\"$code[$j]\" station=\"$station\" owner1=\"$observ\"";	
		}
	}
}

$rowfoot = "$conv";
}

else if($conv == 'SeismicComponent'){

$header = <<<HTMLBLOCK
<?xml version="1.0" encoding="UTF-8" ?>
<wovoml xmlns="http://www.wovodat.org" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
version="1.1.0" xsi:schemaLocation="http://www.wovodat.org/WOVOdatV1.xsd">
<MonitoringSystems>
<SeismicComponents instrument="$instrument" owner1="$observ">
HTMLBLOCK;

$footer = <<<'FOOT'
</SeismicComponents>
</MonitoringSystems>
</wovoml>
FOOT;

$rowprefix = "";

for($j=0;$j<sizeof($code);$j++){

		if((isset($owner2)) && (isset($owner3))){
			$rowhead[$j+1]= "SeismicComponent code=\"$code[$j]\" instrument=\"$instrument\" owner1=\"$observ\" $owner2 $owner3";
		}else if(isset($owner2)){
			$rowhead[$j+1]= "SeismicComponent code=\"$code[$j]\" instrument=\"$instrument\" owner1=\"$observ\" $owner2";
		}else if(isset($owner3)){
			$rowhead[$j+1]= "SeismicComponent code=\"$code[$j]\" instrument=\"$instrument\" owner1=\"$observ\" $owner3";		
		}else{
			$rowhead[$j+1]= "SeismicComponent code=\"$code[$j]\" instrument=\"$instrument\" owner1=\"$observ\"";	
		}
}

$rowfoot = "SeismicComponent";

}

?>