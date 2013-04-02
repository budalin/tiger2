<?php

 include 'header.php';
 $popupstatus=TRUE;
 $page = 1;
 $keyword=$_POST['keyword'];	
 if(isset($_GET['p_a_g_e'])){
 	$page = $_GET['p_a_g_e'];
 }
 
 if(isset($_REQUEST["keyword"]))	{
			$targetpage.="keyword=$_REQUEST[keyword]&amp;";
		} 
 
 
 if (isset($_GET['status'])) {
	
	if($_GET['status'] == "delete"){
		$deleteId = mysql_real_escape_string($_GET['id']);
		$deleteSql = "DELETE FROM tbl_car_info WHERE idCar = $deleteId";
		$deleteQry = mysql_query($deleteSql);
		$sql = "select idCarImg from tbl_car_image WHERE idCar= $deleteId";			
		$idcarimg=mysql_query($sql,$con);		
		while ($delrow = mysql_fetch_assoc($idcarimg)){
			$delrows[]=$delrow;
		}		
		for($i=0;$i<count($delrows);$i++){
			$id = $delrows[$i]['idCarImg'];			
			$sql = "DELETE FROM tbl_car_image WHERE idCarImg=$id";			
			mysql_query($sql);
		}
		$delmsg="Your information is successfully deleted";	
	}
		
	if ($_GET['status'] == "active") {
		$statusId = mysql_real_escape_string($_GET['id']);
		$statusSql = "UPDATE tbl_car_info SET status = 0 WHERE idCar = $statusId";
		$statusQry = mysql_query($statusSql);
		
	}elseif ($_GET['status'] == "deactive") {
		$statusId = mysql_real_escape_string($_GET['id']);
		$statusSql = "UPDATE tbl_car_info SET status= 1 WHERE idCar= $statusId";
		$statusQry = mysql_query($statusSql);
	}
}

	 $where="where carsbrand.brandType like '%$keyword%'";	
  
 		$limit=20;
		$adjacents=3;
		$tbl_name="";
		$targetpage="list_info_car.php?";
		$optsql= "SELECT COUNT(*) as num FROM tbl_car_info AS carinfo INNER JOIN tbl_cars_brand as carsbrand ON carinfo.idCarsBrand= carsbrand.idCarsBrand $where";
		$mypagin=pagin($limit, $adjacents, $tbl_name, $targetpage,$where,$optsql);		
		$sql="SELECT carinfo.*,carsbrand.brandType FROM tbl_car_info AS carinfo INNER JOIN tbl_cars_brand as carsbrand ON carinfo.idCarsBrand= carsbrand.idCarsBrand $where LIMIT $mypagin[start] ,$limit";
//echo "<h1 class='infocar'>".$sql."</h1>";

		$result=mysql_query($sql,$con);
		while ($row = mysql_fetch_assoc($result)){
			$rows[]=$row;
		}	
 
?>
<script>
//sorting for list_info_car.php
$(document).ready(function() 
{ 
       
		$("#product-table").delay(1000).tablesorter({
		sortList: [[0,0], [1,0]],
		headers: { 
            // assign the secound column (we start counting zero) 
            0: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
			1: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
			2: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },   
			
			9: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
			
			10: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }        
           
            
        } }); 
} 

);

function showPopup()
		{
			//alert("pop");
			$("#popup_bg").css("display","block")		
		}
		
function hidePopup(){
			
			$("#popup_bg").css("display","none")	
		}
		
		

</script>
<style type="text/css">
	.pop{
		
		cursor: pointer;
	}
	#popup_bg{
		position: absolute;
		left:0px;
		top:0px;
		width:100%;
		height:2000px;
		background:rgba(0,0,0,0.8);
		z-index:9999;
		display: none;
	}
	#pop-up {
		width: 600px;
		height: auto;
		margin: 0 auto;
		border-radius: 10px;
		background: #fff;
		/*display: none;*/
		margin-top:10px;
		
		box-shadow: 0 0 50px #aaa;
		padding: 30px;
	}
	#img {
		float: left;
		margin: 0 15px 15px 0;
		width: 130px;
		height: 130px;
		display: block;
	}
	#close {
		width: 33px;
		height: 33px;
		display: block;
		background: url(images/close.png) no-repeat;
		margin: -44px 0 0 -42px;
	}
	#cbox {
		margin: -14px 0 0 0;
	}
	.button {
		width: 100%;
		height: 50px;
		padding: 10px 0;
		display: block;
		float: right;
		text-align: right;
	}
	.delete {
		margin: 0 0 0 134px;
	}
	.clear {
		clear: both;
	}
</style>
<div id="content-outer">
<!-- start content -->
<div id="content">
	
<!--  start page-heading -->
	<div id="page-heading">
	<?php
		$savmsg = $_GET['savmsg'];
		/*$delmsg = $_GET['delmsg'];*/
		$updmsg = $_GET['updmsg'];
		
		if($savmsg){
			
			echo "<h1 align='center'>$savmsg</h1>";
		}
		else if($delmsg){
			
			echo "<h1 align='center'>$delmsg</h1>";
		}
		else if($updmsg){
			
			echo "<h1 align='center'>$updmsg</h1>";
		}
		?>
		<h1 class="infocar">Information Car Listing</h1>
		
	</div>
	<!-- end page-heading -->
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
	<td class="topmargin">
		
		<!--  start content-table-inner .........................START -->
		<div id="content-table-inner">			 
				<!--  start product-table ....................... -->
			<form id="listform" action="list_info_car.php" method="POST" name="listform">
				<table border="0" width="100%">
					<tr>
						<td class="cellpadding"><input type="text" name="keyword" value="">
				<input type="button" name="search" value="Search" onclick="document.listform.submit();"></td>
					<td class="cellpadding">
					
				<!--<input type="text" name="keyword" value="">
				<input type="button" name="search" value="Search" onclick="document.mainform.submit();">-->

					</td>
					</tr>
					<tr>
						<td colspan="3">
							
							<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table" class="tablesorter">
							<thead>
							<tr>
							
								<th class="table-header-check"># </th>
								<th class="table-header-repeat line-left headerSortUp">Image Gallery</th>
								<th class="table-header-repeat line-left minwidth-1">Image</th>
								<th class="table-header-repeat line-left minwidth-1">Brand&nbsp;Type	</th>
								<th class="table-header-repeat line-left minwidth-1">VIN</th>
								<th class="table-header-repeat line-left">Produce&nbsp;Year</th>
								<th class="table-header-repeat line-left">Price</th>
								<th class="table-header-repeat line-left">Selling&nbsp;Status</th>
								<!--<th class="table-header-options line-left">Usage Status</th>-->
								<th class="table-header-repeat line-left">Registration&nbsp;Date</th>
								<th class="table-header-repeat line-left">Status</th>
								<th class="table-header-options line-left" style="width:150px;">Options</th>
							</tr>
							</thead>
							<tbody> 
							<?php 
							  for($i=0; $i<count($rows);$i++)
                                {
			                      
								$regDate=explode("-",$rows[$i]['regdate']);
								$datefull=$regDate[2].'-'.$regDate[1].'-'.$regDate[0]; 
								                 
                                $fprice =substr($rows[$i]['price'],0,strrpos($rows[$i]['price'],"."));						
                                $fprice_format= number_format($fprice); ;
                                $lprice =substr($rows[$i]['price'],strrpos($rows[$i]['price'],"."));
										
								$carid = $rows[$i]['idCar'];
								//echo $carid. "<br>";
								$sql="SELECT idCarImg,imgName FROM tbl_car_image WHERE idCar=$carid AND thumbnail='1' ";		
								$result = mysql_query($sql,$con);
								$imgrow = mysql_fetch_row($result);
								
								$findsql="SELECT idCarImg FROM tbl_car_image WHERE idCar=$carid";
								$findresult = mysql_query($findsql,$con);
								$findimgrow = mysql_fetch_row($findresult);
							?>
							<tr>
							
								<td><?php echo ($page-1)*$limit+$i+1; ?></td>								
								<td>
								<?php
								if(isset($findimgrow[0])){ ?>
								<a  href="#" name="editgallery" class="pop" onclick="showPopup();">Eidt Gallery</a>	
							<?php	}
							else{
								?>
								<a  name="creategallery" class="pop" onclick="showPopup()">Create Gallery</a>
						<?php	}
								?>
								
								
								</td>
								<td><?php echo $imgrow[1];?></td>
								<td><?php echo $rows[$i]['brandType'];?></td>
								<td><?php echo $rows[$i]['VIN'];?></td>
								<td><?php echo $rows[$i]['produceYear'];?></td>
								<td><?php echo $fprice_format.$lprice; ; ?>&nbsp;<?php echo $rows[$i]['currency_unit'];?></td>
								<td><?php echo $rows[$i]['sellingStatus'];?></td>
								<!--<td><?php echo $rows[$i]['usagesStatus'];?></td>-->
								<td><?php echo $datefull;?></td>								
								<td align="center">
						<a class="<?php echo ($rows[$i]['status'] == 1)?'icon-3 info-tooltip':'icon-5 info-tooltip'; ?>" 
						href="?status=<?php echo ($rows[$i]['status'] == 1)?'active':'deactive'; ?>&amp;id=<?php echo $rows[$i]['idCar']; ?>"></a>
					</td>
								<td class="options-width">
								<a class="icon-1 info-tooltip" href="edit_info_car.php?status=edit&amp;id=<?php echo  $rows[$i]['idCar']; ?>"></a>
								<a class="icon-2 info-tooltip" title="Delete" href="?status=delete&amp;id=<?php echo $rows[$i]['idCar'];?>" onclick="return confirm ('Are you sure you want to delete?');"></a>
								
								</td>				
							
							 </tr>
                            <?php } //end for loop ?>    
                                
							</tbody>   			
							</table>					
						 </td>					
					  </tr>
					
				 </table>                                  
                       <?php echo $mypagin['pagination']; ?>
                                    
                            
				
				<!--  end product-table................................... --> 
				</form>
			</div>
			<!--  end content-table  -->
		
				
		<div class="clear"></div>		 

</td>
	<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>

		<div style="width:1px;height:1px;overflow:hidden">
		<img src="js/asc.gif" class="hide"/>
		<img src="js/desc.gif" class="hide"/>
		<img src="js/bg.gif" class="hide"/></div>

</div>
</div>

<?php
//include 'popup.php';
 include 'footer.php';
?>