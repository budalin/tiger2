<?php
require('header.php');
$item_per_page = 5;
$success = '';
if(isset($_GET['edit'])){
	$success = "Successfully edited.";
}elseif(isset($_GET['new'])){
	$success = "Successfully saved.";
}

if (isset($_GET['status'])) {
	//print_r($_GET);
	if($_GET['status'] == "delete"){
		$deleteId = mysql_real_escape_string($_GET['id']);
		$deleteSql = "DELETE FROM tbl_cars_brand WHERE `idCarsBrand` = $deleteId";
		$deleteQry = mysql_query($deleteSql);
	}elseif ($_GET['status'] == "active") {
		$statusId = mysql_real_escape_string($_GET['id']);
		$statusSql = "UPDATE tbl_cars_brand SET `status` = 0 WHERE `idCarsBrand` = $statusId";
		$statusQry = mysql_query($statusSql);
		
	}elseif ($_GET['status'] == "deactive") {
		$statusId = mysql_real_escape_string($_GET['id']);
		$statusSql = "UPDATE tbl_cars_brand SET `status`= 1 WHERE `idCarsBrand`= $statusId";
		$statusQry = mysql_query($statusSql);
		
	}
}

if(isset($_REQUEST["keyword"]))
		{
			
			$where_string="WHERE brandinfo.brandType LIKE '%$_REQUEST[keyword]%' ";
		}else
			$where_string="";
	
		$limit = 5;
		$adjacents = 3;
		$tbl_name="tbl_cars_brand";
		$targetpage="list_brand_info.php?";
		if(isset($_REQUEST["keyword"]))	{
			$targetpage.="keyword=$_REQUEST[keyword]&amp;";
		}
		
		$optsql= "SELECT COUNT(*) as num FROM tbl_cars_brand AS brandinfo INNER JOIN tbl_company_name as companyname ON brandinfo.idCompanyName= companyname.idCompanyName $where_string";
		$mypagin = pagin($limit, $adjacents, $tbl_name, $targetpage,$where_string,$optsql);

?>
<script type="text/javascript">
$(document).ready(function() 
    { 
       
		$("#product-table").tablesorter({
		sortList: [[0,0], [1,0]],
		headers: { 
            // assign the secound column (we start counting zero) 
            0: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
			3: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
			4: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },   
		        
        } 
		
		}
		
		); 
	
		
		
    } 
); 
</script>

<div id="content-table-inner">
	<center><span><?php echo $success; ?></span></center>
	<div id="table-content">	
		<form id="mainform" method="POST">
			<input type="text" name="keyword" value="">
			<input type="submit" name="search" value="Search" >
			<table id="product-table" class="tablesorter" width="100%" cellspacing="0" cellpadding="0" border="0">
				<thead>
					<th class="table-header-check">#</th>
					<th class="table-header-repeat line-left minwidth-1">BrandType</th>
					<th class="table-header-repeat line-left minwidth-1">CompanyName</th>
					<th class="table-header-repeat line-left minwidth-1">Status</th>
					<th class="table-header-repeat line-left minwidth-1">Action</th>
				</thead>
				<tbody>
					<?php
						$sql="SELECT brandinfo.*,companyinfo.companyName FROM tbl_cars_brand as brandinfo JOIN tbl_company_name as companyinfo ON brandinfo.idCompanyName=companyinfo.idCompanyName $where_string  LIMIT $mypagin[start] ,$limit";
						$qry = mysql_query($sql);
						echo $sql;
						while ($result = mysql_fetch_array($qry)) {
							
					?>
					<tr class="">
					<td align="center"><?php echo $result['idCarsBrand']; ?></td>
					<td align="center"><?php echo $result['brandType']; ?></td>
					<td align="center"><?php echo $result['companyName']; ?></td>    
					
					<td align="center">
						<a class="<?php echo ($result['status'] == 1)?'icon-3 info-tooltip':'icon-5 info-tooltip'; ?>" 
						href="?status=<?php echo ($result['status'] == 1)?'active':'deactive'; ?>&amp;id=<?php echo $result['idCarsBrand']; ?>"></a>
					</td>
					<td class="options-width">
						<a class="icon-1 info-tooltip" href="add_brand_info.php?status=edit&amp;
						id=<?php echo $result['idCarsBrand']; ?>"></a>
						<a class="icon-2 info-tooltip" href="?status=delete&amp;id=<?php echo $result['idCarsBrand'] ?>" onclick="return confirm ('Are you sure you want to delete?');"></a>
					</td>
					</tr>
					<?php
						}
												
					?>
				</tbody>
			</table>
			<?php echo $mypagin['pagination']; ?>
		</form>

</div>
<?php
	require('footer.php');
?>