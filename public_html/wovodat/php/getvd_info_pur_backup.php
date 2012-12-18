<?php
include 'php/include/db_connect_view.php';/*connect to database*/
$vd_id = $_REQUEST['vd_id'];
$vd_name = $_REQUEST['vd_name'];
$staplot = $_REQUEST['staplot'];
$divnum = $_REQUEST['divnum'];
$qty=100;

$splitname=explode("_", $vd_name);
$vdcavw=$splitname[1];
$vd_nam=$splitname[0];

if ($_REQUEST['filter']) {
	$qty = $_REQUEST['qty'];
	$startDate_d=$_REQUEST['date_ss_d'];
	$startDate_m=$_REQUEST['date_ss_m'];
	$startDate_y=$_REQUEST['date_ss_y'];
	$endDate_d=$_REQUEST['date_se_d'];
	$endDate_m=$_REQUEST['date_se_m'];
	$endDate_y=$_REQUEST['date_se_y'];
	$dr_start = $_REQUEST['dr_start'];
	$dr_end = $_REQUEST['dr_end'];
	$eqtype = $_REQUEST['eqtype'];

	$dates = " and c.sd_evn_time BETWEEN '$startDate_y-$startDate_m-$startDate_d' AND '$endDate_y-$endDate_m-$endDate_d' ";
}
if ($dr_start && $dr_end){$depth = " and c.sd_evn_edep BETWEEN '$dr_start' AND '$dr_end' ";}
if ($eqtype){$quaketype = " and sd_evn_eqtype = '$eqtype' ";}

				$statusHis='Historical'; 
				$statusHol='Holocene'; 
				$statusHol2='Holocene?'; 
				$statusUnc='Uncertain';
				$statusNot='Not a Volcano';
				$unn="Unnamed";
				$statusUr='Uranium-series'; 
				$statusAnt='Anthropology'; 
				$statusRad='Radiocarbon'; 
				$typeSubm='Submarine volcano';
	
$result = mysql_query("SELECT vd_inf_cavw, vd_inf_slat, vd_inf_slon, vd_inf_selev FROM vd_inf WHERE vd_id = '$vd_id'") or die(mysql_error());

$vd_info_obj = mysql_fetch_object($result);
    $vd_info_cavw1=$vd_info_obj->vd_inf_cavw;
		$vd_info_slat1= $vd_info_obj->vd_inf_slat;
    $vd_info_slon1=$vd_info_obj->vd_inf_slon;  
    $vd_info_selev1=$vd_info_obj->vd_inf_selev;  
    echo"vd_id:".$vd_id;
    echo"<br/>";
    echo"name:".$vd_nam;
    echo"<br/>";
    echo"cavw:".$vd_info_cavw1;
    echo"<br/>";
    echo "slat:".$vd_info_slat1;
    echo "<br/>";
    echo "slon:".$vd_info_slon1;
    echo "<br/>";
    echo "elev:".$vd_info_selev1;
?>

<script type="text/javascript">
if(document.getElementById){
	 $(document).ready(function createMap(divId,showStations){
		var slat=<?php echo $vd_info_slat1 ?>;
		var slon=<?php echo $vd_info_slon1 ?>;
		var myLatlng = new google.maps.LatLng(slat,slon);
		var myOptions={
			zoom: 9,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.SATELLITE,
			scaleControl:true,
			mapTypeControl:false,
			streetViewControl: false,
			};
		var map = new google.maps.Map(document.getElementById(<?php echo"\"bigmap".$divnum."\"";?>), myOptions);
		var marker = new google.maps.Marker({
			position: myLatlng,
			map:map,
			});
			
		<?php
		$vd_name=addslashes($vd_name);
		echo "var markerContent='Current Vocano: ".$vd_name."<br/>Cavw:$vd_info_cavw1 <br/> Lat: $vd_info_slat1 <br/> Lon: $vd_info_slon1';";
		?>
		
		var infoWindow = new google.maps.InfoWindow({
			content: markerContent,
			});
		google.maps.event.addListener(marker,'click',function(){
			infoWindow.open(map,marker);
			});
			
			var point=new google.maps.LatLng(slat,slon);
			var newIcon=new google.maps.MarkerImage('../img/pin_ds_s.png',new google.maps.Size(15,23),new google.maps.Point(0,0),new google.maps.Point(7.5,11.5));

			if(<?php echo ""+$staplot;?> >=1){
				<?php
					$ctr = 0;
					$ct = 0;
					session_start();
					$_SESSION['ss_obj']=array();
					$ss_obj=&$_SESSION['ss_obj'];
					$_SESSION['ds_obj']=array();
					$ds_obj=&$_SESSION['ds_obj'];
					$_SESSION['gs_obj']=array();
					$gs_obj=&$_SESSION['gs_obj'];
					$_SESSION['hs_obj']=array();
					$hs_obj=&$_SESSION['hs_obj'];	
					$_SESSION['fs_obj']=array();
					$fs_obj=&$_SESSION['fs_obj'];
					$_SESSION['ts_obj']=array();
					$ts_obj=&$_SESSION['ts_obj'];

					$_SESSION['ss9_obj']=array();
					$ss9_obj=&$_SESSION['ss9_obj'];
					$_SESSION['ds9_obj']=array();
					$ds9_obj=&$_SESSION['ds9_obj'];
					$_SESSION['gs9_obj']=array();
					$gs9_obj=&$_SESSION['gs9_obj'];
					$_SESSION['hs9_obj']=array();
					$hs9_obj=&$_SESSION['hs9_obj'];	
					$_SESSION['fs9_obj']=array();
					$fs9_obj=&$_SESSION['fs9_obj'];
					$_SESSION['ts9_obj']=array();
					$ts9_obj=&$_SESSION['ts9_obj'];
					
					$nss_sta=&$_SESSION['nss_sta'];
					$nds_sta=&$_SESSION['nds_sta'];			
					$ngs_sta=&$_SESSION['ngs_sta'];			
					$nhs_sta=&$_SESSION['nhs_sta'];			
					$nts_sta=&$_SESSION['nts_sta'];
					?>
			
			if(<?php echo ""+$staplot;?>==9){
					var marker = createMarker(point,'<div><?php echo "Current Volcano: " .$vd_name. "<br>Lat: $vd_info_obj->vd_inf_slat<br>Lon: 	$vd_info_obj->vd_inf_slon"; ?><\/div>');
					<?php
					
						
						//seismic stations:Green markers
						echo "var newIcon=new google.maps.MarkerImage('../img/pin_ss_s.png',new google.maps.Size(15,23),new google.maps.Point(0,0),new google.maps.Point(7.5,11.5));";
						$getStations = mysql_query("(select c.sn_id, c.ss_code, c.ss_lat, c.ss_lon, c.ss_stime, c.ss_etime FROM sn a, ss c WHERE a.vd_id = '$vd_id' and a.sn_id = c.sn_id) UNION (select c.sn_id, c.ss_code, c.ss_lat, c.ss_lon, c.ss_stime, c.ss_etime FROM jj_volnet a, ss c, cc d, vd_inf e  WHERE a.vd_id = '$vd_id' and a.vd_id =e.vd_id and a.jj_net_flag = 'S' and a.jj_net_id = c.sn_id and c.cc_id=d.cc_id and (sqrt(power(e.vd_inf_slat - c.ss_lat, 2) + power(e.vd_inf_slon - c.ss_lon, 2))*100)<=30 order by c.ss_code)") or die(mysql_error());
						while ($getStation_obj = mysql_fetch_object($getStations))
						{
							echo "var point = new google.maps.LatLng($getStation_obj->ss_lat,$getStation_obj->ss_lon);";
							echo "var marker$ct=new google.maps.Marker({position:point,map:map,icon:newIcon,});";
							$ct++;
							array_push($ss9_obj, $getStation_obj);
						}
						
					// Deformation stations: PURPLE markers
						echo "var newIcon=new google.maps.MarkerImage('../img/pin_ds_s.png',new google.maps.Size(15,23),new google.maps.Point(0,0),new google.maps.Point(7.5,11.5));";
						$getStations = mysql_query("select c.cn_id, c.ds_code, c.ds_nlat, c.ds_nlon, c.ds_stime, c.ds_etime FROM cn a, ds c WHERE a.vd_id = '$vd_id' and a.cn_id = c.cn_id order by c.ds_code") or die(mysql_error());
						if (! mysql_num_rows($getStations))
						$getStations = mysql_query("select c.cn_id, c.ds_code, c.ds_nlat, c.ds_nlon, c.ds_stime, c.ds_etime FROM jj_volnet a, ds c,vd_inf d WHERE a.vd_id = '$vd_id' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.ds_nlat, 2) + power(d.vd_inf_slon - c.ds_nlon, 2))*100)<20 ORDER BY c.ds_code") or die(mysql_error());
						while ($getStation_obj = mysql_fetch_object($getStations))
						{
							echo "point = new google.maps.LatLng($getStation_obj->ds_nlat,$getStation_obj->ds_nlon);";
							echo "var marker$ct=new google.maps.Marker({position:point,map:map,icon:newIcon,});";
							$ct++;
							array_push($ds9_obj, $getStation_obj);
						}
						
						// Hydrologic stations: BLUE markers
						echo "var newIcon=new google.maps.MarkerImage('../img/pin_hs_s.png',new google.maps.Size(15,23),new google.maps.Point(0,0),new google.maps.Point(7.5,11.5));";
						$getStations = mysql_query("select c.cn_id, c.hs_code, c.hs_lat, c.hs_lon, c.hs_stime, c.hs_etime FROM cn a, hs c WHERE a.vd_id = '$vd_id' and a.cn_id = c.cn_id") or die(mysql_error());
						if (! mysql_num_rows($getStations))
						$getStations = mysql_query("select c.cn_id, c.hs_code, c.hs_lat, c.hs_lon, c.hs_stime, c.hs_etime f FROM jj_volnet a, hs c,vd_inf d WHERE a.vd_id = '$vd_id' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.hs_lat, 2) + power(d.vd_inf_slon - c.hs_lon, 2))*100)<30 ORDER BY c.hs_code") or die(mysql_error());	
						while ($getStation_obj = mysql_fetch_object($getStations))
						{
							echo "point = new google.maps.LatLng($getStation_obj->hs_lat,$getStation_obj->hs_lon);";
							echo "var marker$ct=new google.maps.Marker({position:point,map:map,icon:newIcon,});";
							$ct++;
							array_push($hs9_obj, $getStation_obj);
						}
						
						
						//Thermal stations: ORANGE markers
						echo "var newIcon=new google.maps.MarkerImage('../img/pin_ts_s.png',new google.maps.Size(15,23),new google.maps.Point(0,0),new google.maps.Point(7.5,11.5));";
						$getStations = mysql_query("select c.cn_id, c.ts_code, c.ts_lat, c.ts_lon, c.ts_stime, c.ts_etime FROM cn a, ts c WHERE a.vd_id = '$vd_id' and a.cn_id = c.cn_id") or die(mysql_error());
						if (! mysql_num_rows($getStations))
						$getStations = mysql_query("select c.cn_id, c.ts_code, c.ts_lat, c.ts_lon, c.ts_stime, c.ts_etime FROM jj_volnet a, ts c,vd_inf d WHERE a.vd_id = '$vd_id' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.ts_lat, 2) + power(d.vd_inf_slon - c.ts_lon, 2))*100)<20 ORDER BY c.ts_code") or die(mysql_error());	
						while ($getStation_obj = mysql_fetch_object($getStations))
						{
							echo "point = new google.maps.LatLng($getStation_obj->ts_lat,$getStation_obj->ts_lon);";
							echo "var marker$ct=new google.maps.Marker({position:point,map:map,icon:newIcon,});";
							$ct++;
							array_push($ts9_obj, $getStation_obj);
						}
						
						
						// Gas stations: YELLOW markers
						echo "var newIcon=new google.maps.MarkerImage('../img/pin_gs_s.png',new google.maps.Size(15,23),new google.maps.Point(0,0),new google.maps.Point(7.5,11.5));";
						$getStations = mysql_query("select c.cn_id, c.gs_code, c.gs_lat, c.gs_lon, c.gs_stime, c.gs_etime FROM cn a, gs c WHERE a.vd_id = '$vd_id' and a.cn_id = c.cn_id") or die(mysql_error());
						if (! mysql_num_rows($getStations))
						$getStations = mysql_query("select c.cn_id, c.gs_code, c.gs_lat, c.gs_lon, c.gs_stime, c.gs_etime FROM jj_volnet a, gs c,vd_inf d WHERE a.vd_id = '$vd_id' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.gs_lat, 2) + power(d.vd_inf_slon - c.gs_lon, 2))*100)<20 ORDER BY c.gs_code") or die(mysql_error());	
						while ($getStation_obj = mysql_fetch_object($getStations))
						{
							echo "point = new google.maps.LatLng($getStation_obj->gs_lat,$getStation_obj->gs_lon);";
							echo "var marker$ct=new google.maps.Marker({position:point,map:map,icon:newIcon,});";
							$ct++;
							array_push($gs9_obj, $getStation_obj);
						}
						
						
						//Fields stations: CYAN markers
						echo "var newIcon=new google.maps.MarkerImage('../img/pin_fs_s.png',new google.maps.Size(15,23),new google.maps.Point(0,0),new google.maps.Point(7.5,11.5));";
						$getStations = mysql_query("select c.cn_id, c.fs_id, c.fs_lat, c.fs_lon, c.fs_code, c.fs_stime, c.fs_etime FROM cn a, fs c WHERE a.vd_id = '$vd_id' and a.cn_id = c.cn_id") or die(mysql_error());
						if (! mysql_num_rows($getStations))
						$getStations = mysql_query("select c.cn_id, c.fs_id, c.fs_lat, c.fs_lon, c.fs_code, c.fs_stime, c.fs_etime FROM jj_volnet a, fs c,vd_inf d WHERE a.vd_id = '$vd_id' and a.vd_id=d.vd_id   and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and (sqrt(power(d.vd_inf_slat - c.fs_lat, 2) + power(d.vd_inf_slon - c.fs_lon, 2))*100)<20 ORDER BY c.fs_code") or die(mysql_error());	
						while ($getStation_obj = mysql_fetch_object($getStations))
						{
							echo "point = new google.maps.LatLng($getStation_obj->fs_lat,$getStation_obj->fs_lon);";
							echo "var marker$ct=new google.maps.Marker({position:point,map:map,icon:newIcon,});";
							$ct++;
							array_push($fs9_obj, $getStation_obj);
						}
						
						
					?>
				}
				if(<?php echo ""+$staplot;?><9)	
				{
					<?php
					
						//Seismic stations: GREEN markers
						if (($staplot==1))
						{
							echo "var newIcon=new google.maps.MarkerImage('../img/pin_ss_s.png',new google.maps.Size(15,23),new google.maps.Point(0,0),new google.maps.Point(7.5,11.5));";
							$getStations = mysql_query("(select b.sn_id, b.sn_code, c.ss_id, c.ss_code, c.ss_lat, c.ss_lon, c.ss_stime, c.ss_etime, d.cc_code FROM sn b, ss c, cc d WHERE b.vd_id = '$vd_id' and b.sn_id = c.sn_id and c.cc_id=d.cc_id order by c.ss_code) UNION (select b.sn_id, b.sn_code, c.ss_id, c.ss_code, c.ss_lat, c.ss_lon, c.ss_stime, c.ss_etime, d.cc_code FROM jj_volnet a, sn b, ss c, cc d, vd_inf e  WHERE a.vd_id = '$vd_id' and a.vd_id =e.vd_id and a.jj_net_flag = 'S' and a.jj_net_id = b.sn_id and a.jj_net_id = c.sn_id and c.cc_id=d.cc_id and (sqrt(power(e.vd_inf_slat - c.ss_lat, 2) + power(e.vd_inf_slon - c.ss_lon, 2))*100)<=20 order by c.ss_code) ") or die(mysql_error());
							$nss_sta=mysql_num_rows($getStations);
							$output .= "<br>Seismic Stations : " . $nss_sta;			
							while ($getStation_obj = mysql_fetch_object($getStations))
							{
								$stas_nama=htmlentities($getStation_obj->ss_code, ENT_COMPAT, "	cp1252");
								echo "var point = new google.maps.LatLng($getStation_obj->ss_lat,$getStation_obj->ss_lon);";
								echo "var marker$ctr = new google.maps.Marker({position:point,map:map,icon: newIcon,});
								
								var texthtml=\"$stas_nama\";
								var tooltipOptions={marker:marker$ctr,content:texthtml,cssClass:'tooltip',};
								var tooltip$ctr= new Tooltip(tooltipOptions);
								marker$ctr.tooltip=tooltip$ctr;
								marker$ctr.tooltip.setMap(map);";
								$ctr++;
								array_push($ss_obj, $getStation_obj);
							}
				
						}
						
						// Deformation stations: PURPLE markers
						if (($staplot==2))
						{
							echo "var newIcon=new google.maps.MarkerImage('../img/pin_ds_s.png',new google.maps.Size(15,23),new google.maps.Point(0,0),new google.maps.Point(7.5,11.5));";
													
								
							$getStations = mysql_query("(select c.cn_id, a.cn_code, c.ds_id, c.ds_code, c.ds_nlat, c.ds_nlon, c.ds_stime, c.ds_etime, d.cc_code FROM cn a, ds c, cc d WHERE a.vd_id = '$vd_id' and a.cn_id = c.cn_id and c.cc_id=d.cc_id order by c.ds_code) UNION (select c.cn_id, b.cn_code, c.ds_id, c.ds_code, c.ds_nlat, c.ds_nlon, c.ds_stime, c.ds_etime, d.cc_code FROM jj_volnet a, cn b, ds c, cc d, vd_inf e	WHERE a.vd_id='$vd_id' and a.vd_id=e.vd_id and a.jj_net_flag = 'C' and a.jj_net_id=c.cn_id and a.jj_net_id=b.cn_id and c.cc_id=d.cc_id and (sqrt(power(e.vd_inf_slat - c.ds_nlat, 2) + power(e.vd_inf_slon - c.ds_nlon, 2))*100)<20	ORDER BY c.ds_code)") or die(mysql_error());

							$nds_sta=mysql_num_rows($getStations);
							$output .= "<br>Deformation Sta : " . $nds_sta;			
							while ($getStation_obj = mysql_fetch_object($getStations))
							{
								$stas_nama=htmlentities($getStation_obj->ds_code, ENT_COMPAT, "	cp1252");
								echo "var point = new google.maps.LatLng($getStation_obj->ds_nlat,$getStation_obj->ds_nlon);";
								echo "var marker$ctr = new google.maps.Marker({position:point,map:map,icon: newIcon,});
								var texthtml=\"$stas_nama\";
								var tooltipOptions={marker:marker$ctr,content:texthtml,cssClass:'tooltip',};
								var tooltip$ctr= new Tooltip(tooltipOptions);
								marker$ctr.tooltip=tooltip$ctr;
								marker$ctr.tooltip.setMap(map);";
								$ctr++;
								array_push($ds_obj, $getStation_obj);
							}
						}
						
						
						// Hydrologic stations: BLUE markers
						if (($staplot==3) || ($staplot==9))
						{
							echo "var newIcon=new google.maps.MarkerImage('../img/pin_hs_s.png',new google.maps.Size(15,23),new google.maps.Point(0,0),new google.maps.Point(15,23));";
							$getStations = mysql_query("(select c.cn_id, a.cn_code, c.hs_id, c.hs_code, c.hs_lat, c.hs_lon, c.hs_stime, c.hs_etime, d.cc_code FROM cn a, hs c, cc d WHERE a.vd_id = '$vd_id' and a.cn_id = c.cn_id and c.cc_id=d.cc_id) UNION (select c.cn_id, b.cn_code, c.hs_id, c.hs_code, c.hs_lat, c.hs_lon, c.hs_stime, c.hs_etime, d.cc_code FROM jj_volnet a, cn b, hs c, cc d WHERE a.vd_id = '$vd_id' and a.jj_net_flag = 'C' and a.jj_net_id=b.cn_id and a.jj_net_id = c.cn_id and c.cc_id=d.cc_id)") or die(mysql_error());
							$nss_sta=mysql_num_rows($getStations);
							$output .= "<br>Hydrologic stations : " . $nss_sta;			
							while ($getStation_obj = mysql_fetch_object($getStations))
							{
								$stas_nama=htmlentities($getStation_obj->hs_code, ENT_COMPAT, "	cp1252");
								echo "point = new google.maps.LatLng($getStation_obj->hs_lat,$getStation_obj->hs_lon);";
								echo "var marker$ctr = new google.maps.Marker({position:point,map:map,icon: newIcon});
								var texthtml=\"$stas_nama\";
								var tooltipOptions={marker:marker$ctr,content:texthtml,cssClass:'tooltip',};
								var tooltip$ctr= new Tooltip(tooltipOptions);
								marker$ctr.tooltip=tooltip$ctr;
								marker$ctr.tooltip.setMap(map);";
								$ctr++;
								array_push($hs_obj, $getStation_obj);
							}		
							
						}
						// Thermal stations: ORANGE markers
						if(($staplot==4))
						{
							echo "var newIcon=new google.maps.MarkerImage('../img/pin_ts_s.png',new google.maps.Size(15,23),new google.maps.Point(0,0),new google.maps.Point(15,23));";
							$getStations = mysql_query("select c.cn_id, c.ts_code, c.ts_lat, c.ts_lon, c.ts_code, c.ts_stime, c.ts_etime, d.cc_code FROM cn a, ts c, cc d WHERE a.vd_id = '$vd_id' and a.cn_id = c.cn_id and c.cc_id=d.cc_id") or die(mysql_error());
							if (! mysql_num_rows($getStations))
							$getStations = mysql_query("select c.cn_id, c.ts_code, c.ts_lat, c.ts_lon, c.ts_stime, c.ts_etime, d.cc_code FROM jj_volnet a, ts c, cc d WHERE a.vd_id = '$vd_id' and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and c.cc_id=d.cc_id") or die(mysql_error());
							$output .= "<br>Thermal Stations : " . mysql_num_rows($getStations);
							$nts_sta=mysql_num_rows($getStations);
							while ($getStation_obj = mysql_fetch_object($getStations))
							{
								$stas_nama=htmlentities($getStation_obj->ts_code, ENT_COMPAT, "	cp1252");
								echo "varpoint = new google.maps.LatLng($getStation_obj->ts_lat,$getStation_obj->ts_lon);";
								echo "var marker$ctr = new google.maps.Marker({position:point,map:map,icon: newIcon});
								var texthtml=\"$stas_nama\";
								var tooltipOptions={marker:marker$ctr,content:texthtml,cssClass:'tooltip',};
								var tooltip$ctr= new Tooltip(tooltipOptions);
								marker$ctr.tooltip=tooltip$ctr;
								marker$ctr.tooltip.setMap(map);";
								$ctr++;
								array_push($ts_obj, $getStation_obj);		
							}
						}
						// Gas stations: YELLOW markers
						if (($staplot==5))
						{
							echo "var newIcon=new google.maps.MarkerImage('../img/pin_gs_s.png',new google.maps.Size(15,23),new google.maps.Point(0,0),new google.maps.Point(15,23));";
							$getStations = mysql_query("select c.cn_id, c.gs_code, c.gs_lat, c.gs_lon, c.gs_stime, c.gs_etime, d.cc_code FROM cn a, gs c, cc d WHERE a.vd_id = '$vd_id' and a.cn_id = c.cn_id and c.cc_id=d.cc_id") or die(mysql_error());
							if (! mysql_num_rows($getStations))
							$getStations = mysql_query("select c.cn_id, c.gs_code, c.gs_lat, c.gs_lon, c.gs_stime, c.gs_etime, d.cc_code FROM jj_volnet a, gs c, cc d WHERE a.vd_id = '$vd_id' and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and c.cc_id=d.cc_id") or die(mysql_error());
							$output .= "<br>Gas Stations : " . mysql_num_rows($getStations);
							$ngs_sta=mysql_num_rows($getStations);
							while ($getStation_obj = mysql_fetch_object($getStations))
							{
								$stas_nama=htmlentities($getStation_obj->gs_code, ENT_COMPAT, "	cp1252");
								echo "point = new google.maps.LatLng($getStation_obj->gs_lat,$getStation_obj->gs_lon);";
								echo "var marker$ctr = new google.maps.Marker({position:point,map:map,icon: newIcon});
								var texthtml=\"$stas_nama\";
								var tooltipOptions={marker:marker$ctr,content:texthtml,cssClass:'tooltip',};
								var tooltip$ctr= new Tooltip(tooltipOptions);
								marker$ctr.tooltip=tooltip$ctr;
								marker$ctr.tooltip.setMap(map);";
								$ctr++;
								array_push($gs_obj, $getStation_obj);	
							}
						}	
						// Fields stations: CYAN markers
						if (($staplot==6))
						{
							echo "var newIcon=new google.maps.MarkerImage('../img/pin_fs_s.png',new google.maps.Size(15,23),new google.maps.Point(0,0),new google.maps.Point(15,23));";
							$getStations = mysql_query("select c.cn_id, c.fs_code, c.fs_lat, c.fs_lon, c.fs_stime, c.fs_etime, d.cc_code FROM cn a, fs c, cc d WHERE a.vd_id = '$vd_id' and a.cn_id = c.cn_id and c.cc_id=d.cc_id ") or die(mysql_error());
							if (! mysql_num_rows($getStations))
							$getStations = mysql_query("select c.cn_id, c.fs_code, c.fs_lat, c.fs_lon, c.fs_stime, c.fs_etime, d.cc_code 		FROM jj_volnet a, fs c, cc d 		WHERE a.vd_id = '$vd_id' and a.jj_net_flag = 'C' and a.jj_net_id = c.cn_id and c.cc_id=d.cc_id ") or die(mysql_error());
							$output .= "<br>Fields Stations : " . mysql_num_rows($getStations);
							while ($getStation_obj = mysql_fetch_object($getStations))
							{
								$stas_nama=htmlentities($getStation_obj->fs_code, ENT_COMPAT, "	cp1252");
								echo "point = new google.maps.LatLng($getStation_obj->fs_lat,$getStation_obj->fs_lon);";
								echo "var marker$ctr = new google.maps.Marker({position:point,map:map,icon: newIcon,});
								var texthtml=\"$stas_nama\";
								var tooltipOptions={marker:marker$ctr,content:texthtml,cssClass:'tooltip',};
								var tooltip$ctr= new Tooltip(tooltipOptions);
								marker$ctr.tooltip=tooltip$ctr;
								marker$ctr.tooltip.setMap(map);";
								$ctr++;
								array_push($gs_obj, $getStation_obj);
							}
						}
						
						
						// Earthquakes
						if ($staplot==7)
						{
							$getVd_inf = mysql_query("select vd_inf_slat, vd_inf_slon WHERE vd_id = '$vd_id'");
							if($getVd_inf) $vd_inf = mysql_fetch_object($getVd_inf);
							$getQuakes = mysql_query("select sd_evn_elat, sd_evn_elon, sd_evn_edep, sd_evn_pmag, sd_evn_time, sd_evn_eqtype	FROM sd_evn WHERE abs($vd_info_obj->vd_inf_slat - sd_evn_elat) + abs($vd_info_obj->vd_inf_slon - sd_evn_elon)<=0.2 ORDER BY (sd_evn_time) DESC limit $qty") or die(mysql_error());
							$output .= "<br>Seismic Events : " . mysql_num_rows($getQuakes);
							$count1 = 1;
							$clear = "";
							while ($getQuake_obj = mysql_fetch_object($getQuakes))
							{
								if ($getQuake_obj->sd_evn_edep <= 2.5) $color = "\"../img/pin_ge.png\""; // Green
								else if ($getQuake_obj->sd_evn_edep >2.5 && $getQuake_obj->sd_evn_edep <= 5) $color = "\"../img/pin_ye.png\""; // YELLOW
								else if ($getQuake_obj->sd_evn_edep >5 && $getQuake_obj->sd_evn_edep <= 10) $color = "\"../img/pin_re.png\""; // Red
								else if ($getQuake_obj->sd_evn_edep >10 && $getQuake_obj->sd_evn_edep <= 50) $color = "\"../img/pin_be.png\""; // BLUE
								else $color = "\"../img/pin_dbe.png\""; // DARK BLUE
								$mag = round(($getQuake_obj->sd_evn_pmag)*3);
								if ($mag < 4) $mag = 4;
								
								$md5 = md5($getQuake_obj->sd_evn_elon . $getQuake_obj->sd_evn_elon);
								$md5 = substr($md5, 0, 25);
							
								echo "point = new google.maps.LatLng($getQuake_obj->sd_evn_elat,$getQuake_obj->sd_evn_elon);
									newIcon=new google.maps.MarkerImage($color,new google.maps.Size($mag,$mag),null,null);";
								$clear .= "window.str$md5 = '';\n";
								echo "if (window.str$md5 === undefined) { str$md5 = '$count1. Time: $getQuake_obj->sd_evn_time\\nDepth:$getQuake_obj->sd_evn_edep , Mag:$getQuake_obj->sd_evn_pmag\\nType:$getQuake_obj->sd_evn_eqtype ,Netw: $getQuake_obj->sn_code'; }
										else { str$md5 += '\\n$count1. Time:$getQuake_obj->sd_evn_time\\nDepth: $getQuake_obj->sd_evn_edep , Mag:$getQuake_obj->sd_evn_pmag\\nType: $getQuake_obj->sd_evn_eqtype ,Netw: $getQuake_obj->sn_code'; }
										st2$md5 = str$md5;
										marker$md5 = new google.maps.Marker({position:point,map:map,icon: newIcon});
										var textContent='<textarea rows=\"3\" cols=\"30\" readonly>' + st2$md5 + '</textarea>';
										var infoWindow$md5=new google.maps.InfoWindow({
											content:textContent,
											});
										google.maps.event.addListener(marker$md5, 'click', function(){
											infoWindow$md5.open(map,marker$md5);
											});
											";
											$count1++;
											
							}
						}
					?>
				}
				<?php 	echo $clear; ?>
				marker.setMap(null);
				map.setMapTypeId(google.maps.MapTypeId.TERRAIN);
				
			}else{
				var latval=<?php echo $vd_info_obj->vd_inf_slat ?>;
				if(isNaN(latval)) parseFloat(latval); 
				var latf = latval.toFixed(2);
				var lonval=<?php echo $vd_info_obj->vd_inf_slon ?>;
				if(isNaN(lonval)) parseFloat(lonval); 				
				var lonf = lonval.toFixed(2);
				var elevs=<?php echo $vd_info_obj->vd_inf_selev ?>;
				if(isNaN(elevs)) parseFloat(elevs); 				
				var elef = elevs.toFixed(0);
				
				var remark="<div> Volcano: <?php echo addslashes($vd_nam)."<br/>Cavw: ".$vdcavw ?>" +"<br/>LatLon: " + latf + ", " + lonf + ", " + elef +"</div>";
				var marker = createMarker(point,remark);
				
			}
			
		<?php
			include 'php/include/db_connect_view.php';
				$count=0;
				
				$neighbors = mysql_query("select a.vd_id, b.vd_name, a.vd_inf_slat, a.vd_inf_slon, (pow(a.vd_inf_slat - $vd_info_obj->vd_inf_slat, 2) + pow(a.vd_inf_slon - $vd_info_obj->vd_inf_slon, 2)) as `distance` FROM vd_inf a, vd b WHERE a.vd_id != '$vd_id' AND a.vd_id = b.vd_id and SUBSTR(b.vd_name,1,7)!='$unn' and a.vd_inf_status!='$statusUnc' and a.vd_inf_status!='$statusNot' and a.vd_inf_status!='$statusUr' and a.vd_inf_type!='$typeSubm' ORDER BY `distance` ASC limit 10") or die(mysql_error());				
				
				while($neighbor_obj=mysql_fetch_object($neighbors))
				{
				/*echo "slatnb:".$neighbor_obj['vd_inf_slat']." slonnd:".$neighbor_obj['vd_inf_slon']."<br/>";*/
				$slat1=number_format($neighbor_obj->vd_inf_slat,2,'.','');
				$slon1=number_format($neighbor_obj->vd_inf_slon,2,'.','');
				$vd_name_n=addslashes($neighbor_obj->vd_name);
					if($count<9)
					{
						echo "var newIcon='../img/pin.png';
						var point=new google.maps.LatLng($slat1,$slon1);
						var marker$count=new google.maps.Marker({
						position:point,
						map:map,
						icon:newIcon,
						});
						var texthtml=\"<span style='white-space: nowarp;'> $vd_name_n<\/span><p style='white-space: nowarp;'>$slat1,$slon1</p>\";
						var tooltipOptions={marker:marker$count,content:texthtml,cssClass:'tooltip',};
						var tooltip$count= new Tooltip(tooltipOptions);
						tooltip$count.setMap(map);
						google.maps.event.addListener(marker$count,'click',function(){
						$('#vd_name$divnum').val('$neighbor_obj->vd_id');
						setupMaps(0,'$divnum');
						});
						";
						$count++;
					}
				}
				
		?>
		
		function createMarker(point, html) {
			var marker = new google.maps.Marker({position:point,map:map,});
			var infoWindow=new google.maps.InfoWindow({
					content: html,
				});
			google.maps.event.addListener(marker, "click", function() {
				infoWindow.open(map,marker);
			});
			return marker;
		}	
		});
}

</script>
<?php  
mysql_close($link);
?>
