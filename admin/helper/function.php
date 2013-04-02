<?php
include 'dbconnection.php';
$con = dbconnection();

function create_brandType($label,$name,$require,$option,$value){

?>
	<div class="field">
				<label><?php echo $label ;?></label>
				<div >
				
				<select name="<?php echo $name; ?>">
					<option value="0"><?php echo $option ;?></option>					
					<?php 
					
					 $rows = get_brandType();
					  for($i=0; $i<count($rows);$i++)
					  { 
					  if($value==$rows[$i]['idCarsBrand'])
						{
							$select ="selected";
						}
						else{
							$select ="";
						}						
						
					  ?>					  	
						<option value="<?php echo $value!=''|| $value!=null  ?  $value:$rows[$i]['idCarsBrand'] ;?>" <?php echo $select;?> ><?php echo $rows[$i]['brandType']; ?></option>
						
						
					<?php  }
					?>
				</select>
				<?php
				if($require=="yes"){ ?>
					&nbsp;<span style="color:red;font-weight:bold;">*</span>
			<?php	}
				?>
				</div>
	</div>
<?php } 

function create_textbox($label,$name,$require,$value,$numberonly){
?>
		<div class="field">			
				<label><?php echo $label; ?></label>
				<div>
					<input type="text" class="inp-form" name="<?php echo $name; ?>" value="<?php echo $value; ?>" <?php echo $numberonly; ?>/>
					<?php
				if($require =="yes"){ ?>
					&nbsp;<span style="color:red;font-weight:bold;">*</span>
			<?php	}
				?>
				</div>
			</div>
<?php }

function create_pricetextbox($label,$p_name,$c_name,$p_require,$c_require,$c_option,$p_value,$c_value,$numberonly){
?>
	<div class="field">
				<label><?php echo $label;?></label>
				<div>				
					<input type="text" class="inp-form" name="<?php echo $p_name; ?>" value="<?php echo $p_value; ?>" <?php echo $numberonly;?>/>
					<?php
				if($p_require =="yes"){ ?>
					&nbsp;<span style="color:red;font-weight:bold;">*</span>
			<?php	} 
				?>
				
					<select  class="styledselect_form_1" name="<?php echo $c_name; ?>">
			<?php 
				
				foreach($c_option->children() as $resoption)
		{
		
				if($c_value==$resoption)
				{
					$select ="selected";
				}
				else{
					$select ="";
				}
		 ?>
		
					<!--<option value="<?php echo $resoption ?>"><?php echo $resoption;  ?></option>-->
					<option value="<?php echo $c_value!=''|| $c_value!=null  ? $c_value:$resoption  ; ?>" <?php echo $select;?>><?php echo $resoption;  ?></option>
		<?php } ?>			
					</select>
		<?php
				if($c_require =="yes"){ ?>
					&nbsp;<span style="color:red;font-weight:bold;">*</span>
			<?php	}
				?>
				</div>
			</div>
<?php }

function create_selectbox($label,$name,$require,$f_option,$option,$value){
	
	?>	
	<div class="field">
				<label><?php echo $label; ?></label>
				<div>
				<select name="<?php echo $name; ?>">
				 
				<?php 
				echo $f_option;
				foreach($option->children() as $resoption)
		{
				if($value==$resoption)
				{
					$select ="selected";
				}
				else{
					$select ="";
				}
		 ?>		   
					
					<option value="<?php echo $value!='' || $value!=null ? $value: $resoption ;?>" <?php echo $select;?>><?php echo $resoption;  ?></option>
		<?php } ?>
					
					
				</select>
				<?php
				if($require =="yes"){ ?>
					&nbsp;<span style="color:red;font-weight:bold;">*</span>
			<?php	}
				?>
				</div>
	</div>
	<?php
}

function create_regDate($label,$name,$id,$require,$value){
?>
	<div class="field">			
				<label><?php echo $label; ?></label>
				<div>
					<input type="text" class="inp-form" name="<?php echo $name; ?>" id="<?php echo $id;?>" value="<?php echo $value; ?>" readonly />
					<input type="button" name="btncal" id="btncal" value="...." onclick="showCalendar('<?php echo $name ;?>','dd-mm-y')">
					<?php
				if($require =="yes"){ ?>
					&nbsp;<span style="color:red;font-weight:bold;">*</span>
			<?php	}
				?>
				</div>
	</div>
<?php }

function create_featurebox(){
	
}


function create_description($label,$name,$require,$value){
?>
	<div class="field full-width">
				<label><?php echo $label ;?></label>
				<div>
				<textarea rows="7" cols="50" name="<?php echo $name;?>"><?php echo $value;?></textarea>
				<?php
				if($require =="yes"){ ?>
					&nbsp;<span style="color:red;font-weight:bold;">*</span>
			<?php	}
				?>
				</div>
			</div>
<?php			
}

function get_brandType(){
	global $con;
	$sql = "SELECT * FROM tbl_cars_brand ORDER BY brandType ASC";	
	$result=mysql_query($sql,$con);	
	while ($row = mysql_fetch_assoc($result)){
		$rows[]=$row;
	}
	return $rows;
}

?>