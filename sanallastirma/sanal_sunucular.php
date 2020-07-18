<?php
include 'db/mssql_baglan.php';

$sql_mssql="SELECT 
       vm.[NAME],
       vm.[IP_ADDRESS] 
	 ,dsname 
      ,[MEM_SIZE_MB]
		,[NUM_VCPU]
      ,vm.[BOOT_TIME]
     ,vm.[POWER_STATE]
      ,[GUEST_OS]
      ,vci.GUEST_FULL_NAME
      ,[GUEST_FAMILY]
      ,vm.[DNS_NAME]   
      ,[VMMWARE_TOOL]
      ,[NUM_NIC]
      ,[NUM_DISK]
      ,D.disk_size
      ,vm.[ANNOTATION]
  FROM [VIM_VCDB].[dbo].[VPXV_VMS] as vm 
  left join (SELECT      DISTINCT VM_ID,
         STUFF(
               (SELECT    ', '+  LTRIM(RTRIM (NAME) ) 
               FROM      [VIM_VCDB].[dbo].[VPXV_VM_DATASTORE] B
               left join dbo.VPXV_DATASTORE c on B.DS_ID=c.ID
               WHERE      B.VM_ID = A.VM_ID
               FOR XML PATH('')), 1, 1, '') AS dsname

FROM      [VIM_VCDB].[dbo].[VPXV_VM_DATASTORE] A) as K on K.VM_ID=vm.VMID
left join (SELECT      DISTINCT VM_ID,
         STUFF(
               (SELECT    ', '+  LTRIM(RTRIM (cast(HARDWARE_DEVICE_CAPACITY_IN/1024/1024 as CHAR))+' GB' ) 
               FROM     [VIM_VCDB].[dbo].[VPX_VIRTUAL_DISK] B
               WHERE      B.VM_ID = A.VM_ID
               FOR XML PATH('')), 1, 1, '') AS disk_size

FROM     [VIM_VCDB].[dbo].[VPX_VIRTUAL_DISK] A) as D on D.VM_ID=vm.VMID

left join [VPX_VM_CONFIG_INFO] as vci on vci.ID=vm.VMID
where vm.IS_TEMPLATE=0
  order by   vm.[NAME]";
$result_1 = odbc_exec($link_mssql, $sql_mssql) ; 
$satir = odbc_fetch_row($result_1); 
   
?>
<div id="sanal_sunucu">
<p class="baslik_sanal_sunucu">Sanal Sunucular (VCenter)
<!--<a href="raporlar/sunucu_rapor_xls.php?t=<?php echo $id;?>" target="_self" title="Excel Export"><img width="18px" height="16px" src="images/xls.png"/></a>-->
</p>
<table  class="sanal_sunucu">
<thead>
<tr>
<th style='font-size:10px'>~</th>
<th style='font-size:10px'>Name</th>
<th style='font-size:10px'>IP</th>
<!--<th style='font-size:10px'>DS Pool</th>-->
<th style='font-size:10px'>Memory</th>
<th style='font-size:10px'>VCPU</th>
<th style='font-size:10px'>Power</th>
<th style='font-size:10px'>OS</th>
<!--<th style='font-size:10px'>DNS NAME</th>-->
<th style='font-size:10px'>VmWare Tool</th>
<th style='font-size:10px'>Notlar</th>
<th style='font-size:10px'>Num Of Disk</th>
<th style='font-size:10px'>Disk sizes</th>
</tr>
</thead>
<!--			<td  style=' background-color:$bg;width:75px;vertical-align: top; size:10px'>".$row["dsname"]."</td>
				<td  style='background-color:$bg; width:85px;vertical-align: top'>".$row["DNS_NAME"]."</td>
-->
<?php 
$sira=1;
$bg="#F5F5F5";

 if ( $satir == true ) { 
        $result_1 = odbc_exec($link_mssql, $sql_mssql) ; 
        while ( $row = odbc_fetch_array($result_1) ) {
        	$color="#000";
        	$vtcolor="#000"; 
        	$title="";
        	if($row["POWER_STATE"]=='Off')
        	{
        		$color="gray";
        		$title="Sunucu Kapalı";
        	}
        	if ($row["VMMWARE_TOOL"]!="OK")
        	{	
        		
        		$vtcolor="red";
        	}
        	echo "<tbody><tr>
				<td  style='background-color:$bg;  color:$color; width:2px; vertical-align: top; cursor:pointer; font-size:10px' title='$title'>".$sira."</td>
				<td  style=' background-color:$bg; color:$color;width:130px;vertical-align: top;font-size:11px' title='$title'>".$row["NAME"]."</td>
				<td  style='background-color:$bg; color:$color;width:75px;vertical-align: top;font-size:10px' title='$title'>".$row["IP_ADDRESS"]."</td>
				<td  style='background-color:$bg; color:$color;width:300px;vertical-align: top;font-size:10px' title='$title'>".$row["ANNOTATION"]."</td>
				<td  style=' background-color:$bg;color:$color;width:35px;vertical-align: top;font-size:10px' title='$title'>".$row["MEM_SIZE_MB"]." MB</td>
				<td  style=' background-color:$bg;color:$color;width:30px;vertical-align: top;font-size:10px' title='$title'>".$row["NUM_VCPU"]."</td>
				<td  style='background-color:$bg; color:$color;width:26px;vertical-align: top;font-size:10px' title='$title'>".$row["POWER_STATE"]." </td>
				<td  style='background-color:$bg; color:$color;width:145px;vertical-align: top;font-size:10px' title='$title'>".$row["GUEST_FULL_NAME"]."</td>
				<td  style='background-color:$bg; color:$vtcolor;width:75px;vertical-align: top;font-size:10px' title='$title'>".$row["VMMWARE_TOOL"]."</td>
				<td  style='background-color:$bg; color:$color;width:50px;vertical-align: top;font-size:10px' title='$title'>".$row["NUM_DISK"]."</td>
				<td  style='background-color:$bg; color:$color;width:150px;vertical-align: top;font-size:10px' title='$title'>".$row["disk_size"]."</td>
				
				</tr></tbody>";
        $sira=$sira+1;
	if($bg=="#F5F5F5")
	{
		$bg="#FFF";
	}
	else{
		$bg="#F5F5F5";
	}
        }  
   

	
	
}
?>

</table>
</div>


<?php 
include 'db/ase_baglanma.php';