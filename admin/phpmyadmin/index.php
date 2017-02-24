<?

// Do not use same db user as you using in app
// create a new user and set prevelization 
//$host = "localhost";
//$user = "codeigni_mxpSQL";
//$password = "MymxpSQL";
//$db = "codeigni_maxpins";

$base_url = 'http://192.168.2.5/maxpins/admin/';

$host = "localhost";
$user = "root";
$password = "Abcd1234";
$db = "maxpins";

$link = mysql_connect($host,$user,$password);
mysql_select_db($db,$link) or die(mysql_error());

?>

<script type="text/javascript">

function show_table()

{

	sql.show_table1.value="yes";

	sql.t1.value="select * from "+sql.table_name.value;
	
	//if (document.getElementById('sqlq').length > 0){
	//document.getElementById('sqlq').value = sql.t1.value
	//}
	//sql.submit();

}


</script>

<form name="sql" action="" method="post" id="sql" >

<input type="hidden" name="show_table1">

<div class="col-md-12">
	<div class="portlet-body1">
	               
		<table cellpadding="0" class="table table-striped " cellspacing="0" border="0" align="center">
		
			<tr>
		
				<td width="13%" height="135">Enter Query:</td>
		
				<td width="55%"><textarea name="t1" rows="7" id="sql_textarea"  class="form-control" ><?=stripslashes($_POST['t1'])?></textarea></td>
		
				<td width="32%">
		
					<table cellpadding="0" cellspacing="0" border="0" width="80%" align="center">
		
						<tr>
		
					<td align="center"><b>Tables</b></td>
		
				</tr>
		
						<tr>
		
					<td align="center">
		
								<select name="table_name" class="form-control" onChange="show_table();">
		
									<option value="">Select One</option>
		
									<? 
		
					    $sql_show_all="show tables";
		
					    $rs_show_all=mysql_query($sql_show_all);
		
					    while($rec_show_all=mysql_fetch_array($rs_show_all)){
		
					    ?>
		
						<option value="<?=$rec_show_all[0]?>" <?=($rec_show_all[0] == $_POST['table_name'])?'SELECTED':'';?>><?=$rec_show_all[0]?></option><?
		
					    }
		
					    mysql_free_result($rs_show_all);
		
					    ?>
		
								</select>
		
								
							</td>
		
						</tr>
		
					</table>
		
				</td>
		
			</tr>
		
			<tr>
		
			<td></td>
		
			<td align="left" height="50">
				<input type="button" class="btn blue" onclick="submitForm()" value="Submit" name="Submit"></td>
		
			</tr>
		
		</table>
	</div>
</div>

</form>

<br />

<?

if(isset($_POST['t1']))
{
	$str_query	= trim(strtolower(stripslashes($_POST['t1'])));
	
	$arr_check_str	= array("delete", "alter", "drop", "truncate", "create", "update");
	$arr_replace_str= array("", "", "", "", "", "");
	
	$previous_length= strlen(trim(strtolower(stripslashes($_POST['t1']))));
	
	$current_length	= strlen(str_replace($arr_check_str, $arr_replace_str, $str_query));
	
	if($previous_length > $current_length)
	{
		echo "<font color='red'><b>You don't have permission to run this query</b></font>";
		exit();

	}
	
	$arr=explode(";",stripslashes($_POST['t1']));

	for($i=0;$i<count($arr);$i++)

	{

		$rs=mysql_query($arr[$i]);

	}

if($_POST['table_name'] != '' && $_POST['chk'] == 1){

$newSql = "SHOW CREATE TABLE  " . $_POST['table_name'] . "";

$newRs = mysql_query($newSql) or die( str_replace("user 'codeigni_mxpSQL'@'localhost", mysql_error()));

$newRec = mysql_fetch_array($newRs);

echo  str_replace('`','',stripslashes($newRec[1])) . "<br><br>" ;

}



if($rs)

{ 

if ($rs>1)	show_table($rs);

else up_del($rs);

}

else

{ echo "<b>Please write a proper Query.</b>";

echo "<br><br><b>Error : ".str_replace("to user 'codeigni_mxpSQL'@'localhost'",'', mysql_error())."</b>";

}

}

function show_table($rs)

{

$kk=mysql_num_fields($rs);

?>

<div class="col-md-12">
<div class="portlet-body">
	<form action="<?php echo $base_url ?>sqlquery/export" target="_blank" method="post">
		<textarea style="display: none;"  id="sqlq" name="sql" ></textarea>
		<?php $feilds = ''; for( $i=0;$i<$kk;$i++) $feilds .= "'".mysql_field_name($rs, $i)."',";?>
		<input type="hidden" name="fields" value="<?php echo rtrim($feilds,',') ?>" />
		
		<input type="submit" class="btn purple" onclick="submitExport()" name="export" value="Export" />
	</form>
<div class="table-scrollable">
	
<table  class="table table-bordered table-striped table-condensed flip-content">



<tr bgcolor="#99FF99" >

<?	for( $i=0;$i<$kk;$i++) echo "<td><b>".mysql_field_name($rs, $i)."</b></td>";	?>



</tr><tr></tr>

<? if (mysql_num_rows($rs)>0)

{

$i=0;

while($rec=mysql_fetch_array($rs))

{

echo "<tr>";

for($i=0;$i<$kk;$i++)

{

echo "<td valign='top'>".stripslashes($rec[$i])."&nbsp;</td>";

}

echo "</tr>";

}

} ?>

</table>
</div>
</div>
</div>
<?

}

 

function up_del($rs)

{

	echo "<b> Number Of Affected Rows==". mysql_affected_rows()."</b>";

}