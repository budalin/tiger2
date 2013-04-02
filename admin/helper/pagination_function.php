<?php
function pagin($limit,$adjacents,$tbl_name,$targetpage,$where=null,$optsql=''){
	$pagination = '';
	if($optsql==''){
			$query = "SELECT COUNT(*) as num FROM $tbl_name $where";
	}
	else{
		$query = $optsql;
	}
		
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages["num"];
	if(isset($_GET["p_a_g_e"]))	{ 
		$page=$_GET["p_a_g_e"];  
		$start = ($page - 1) * $limit; 
	}else{ 
		$page=1; $start = 0; 
	}if ($page == 0) $page = 1; 
		$prev = $page - 1;  
		$next = $page + 1;  
		$lastpage = ceil($total_pages/$limit);  
		$lpm1 = $lastpage - 1;  
	if($lastpage > 1) {  
		$pagination .= "<div id=\"pagination\">"; 
		if ($page > 1)  $pagination.= "<a href=\"$targetpage p_a_g_e=$prev \" >previous</a>";
		 else $pagination.= "<span class=\"disabled\">previous</span>";   
		 if ($lastpage < 7 + ($adjacents * 2)) {  
			 	for ($counter = 1; $counter <= $lastpage; $counter++) { 
			 		if ($counter == $page) $pagination.= "<span class=\"current\">$counter</span>"; 
			 		else $pagination.= "<a href=\"$targetpage p_a_g_e=$counter\">$counter</a>";  
			 	} 
		 	} elseif($lastpage > 5 + ($adjacents * 2)) { 
		 		if($page < 1 + ($adjacents * 2))  { 
		 			for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) { 
		 				if ($counter == $page) $pagination.= "<span class=\"current\">$counter</span>"; 
		 				else $pagination.= "<a href=\"$targetpage p_a_g_e=$counter\">$counter</a>"; 
		 			} $pagination.= "..."; $pagination.= "<a href=\"$targetpage p_a_g_e=$lpm1\">$lpm1</a>"; 
		 			$pagination.= "<a href=\"$targetpage p_a_g_e=$lastpage\">$lastpage</a>";  
		 		} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) { 
		 			$pagination.= "<a href=\"$targetpage p_a_g_e=1\">1</a>"; $pagination.= "<a href=\"$targetpage p_a_g_e=2\">2</a>"; $pagination.= "..."; for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) { if ($counter == $page) $pagination.= "<span class=\"current\">$counter</span>"; else $pagination.= "<a href=\"$targetpage p_a_g_e=$counter\">$counter</a>";  } $pagination.= "..."; $pagination.= "<a href=\"$targetpage p_a_g_e=$lpm1\">$lpm1</a>"; $pagination.= "<a href=\"$targetpage p_a_g_e=$lastpage\">$lastpage</a>";  } else { $pagination.= "<a href=\"$targetpage p_a_g_e=1\">1</a>"; $pagination.= "<a href=\"$targetpage p_a_g_e=2\">2</a>"; $pagination.= "..."; for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) { if ($counter == $page) $pagination.= "<span class=\"current\">$counter</span>"; else $pagination.= "<a href=\"$targetpage p_a_g_e=$counter\">$counter</a>";  } } }  if ($page < $counter - 1)  $pagination.= "<a href=\"$targetpage p_a_g_e=$next\">next</a>"; else $pagination.= "<span class=\"disabled\">next</span>"; $pagination.= "</div>\n";  } $returnArray = array ( 'start' => $start,'pagination'=>$pagination); return $returnArray; }

	function xss_clean($data)
	{
		// Fix &entity\n;
		$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
		$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
		$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
		$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

		// Remove any attribute starting with "on" or xmlns
		$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
		// Remove javascript: and vbscript: protocols
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

		// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

		// Remove namespaced elements (we do not need them)
		$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

		do
		{
			// Remove really unwanted tags
			$old_data = $data;
			$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
		}
		while ($old_data !== $data);

		// we are done...
		return $data;
	}

	
?>