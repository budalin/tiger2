<?php
require('header.php');
$item_per_page = 5;
if (isset($_GET['status'])) {
	//print_r($_GET);
	if ($_GET['status'] == "active") {
		$statusId = mysql_real_escape_string($_GET['id']);
		$statusSql = "UPDATE tbl_company_name SET `status` = 0 WHERE `idCompanyName` = $statusId";
		$statusQry = mysql_query($statusSql);
		
	}elseif ($_GET['status'] == "deactive") {
		$statusId = mysql_real_escape_string($_GET['id']);
		$statusSql = "UPDATE tbl_company_name SET `status`= 1 WHERE `idCompanyName`= $statusId";
		$statusQry = mysql_query($statusSql);
	}
}
?>


<div id="content-table-inner">
	<div id="table-content">	
		<form id="mainform" method="POST">
			<table id="product-table" width="100%" cellspacing="0" cellpadding="0" border="0">
				<thead>
					<th class="table-header-check"></th>
					<th class="table-header-repeat line-left minwidth-1"><a href="">Company Name</a></th>
					<th class="table-header-repeat line-left minwidth-1"><a href="">Country Name</a></th>
					<th class="table-header-repeat line-left minwidth-1"><a href="">Status</a></th>
					<th class="table-header-repeat line-left minwidth-1"><a href="">Action</a></th>
				</thead>
				<tbody>
					<?php
						$sql = "SELECT * FROM tbl_company_name LIMIT 0,20";
						$qry = mysql_query($sql);
						while ($result = mysql_fetch_array($qry)) {
					?>
					<tr class="<?php echo (is_int($result['idCompanyName']/2)?'alternate-row':''); ?>">
					<td align="center"><?php echo $result['idCompanyName']; ?></td>
					<td align="center"><?php echo $result['companyName']; ?></td>    
					<td align="center"><?php echo $result['companyCountry']; ?></td>
					<td align="center">
						<a class="<?php echo ($result['status'] == 1)?'icon-5 info-tooltip':'icon-2 info-tooltip'; ?>" 
						href="?status=<?php echo ($result['status'] == 1)?'active':'deactive'; ?>&amp;id=<?php echo $result['idCompanyName']; ?>"></a>
					</td>
					<td class="options-width">
						<a class="icon-1 info-tooltip" href="add_company_list.php?type=edit&amp;
						id=<?php echo $result['idCompanyName']; ?>"></a>
						<a class="icon-2 info-tooltip" href=""></a>
					</td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</form>

	</div>
	<table id="paging-table" cellspacing="0" cellpadding="0" border="0">
			<tbody><tr>
			<td>
				<a href="" class="page-far-left"></a>
				<a href="" class="page-left"></a>
				<div id="page-info">Page <strong>1</strong> / 15</div>
				<a href="" class="page-right"></a>
				<a href="" class="page-far-right"></a>
			</td>
			<td>
			<select class="styledselect_pages">
				<option value="">Number of rows</option>
				<option value="">1</option>
				<option value="">2</option>
				<option value="">3</option>
			</select>
			</td>
			</tr>
			</tbody>
	</table>
</div>
