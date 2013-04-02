// For validate add_info_car 
function validate_info_car(){
	var form = document.carForm;
	
	if(form.brandtype.value==0 || form.brandtype.value=='0'){
		alert("Please Choose Brand Type.");
		form.brandtype.focus();
		form.brandtype.style.border="1px solid red";
		return false;
	}
	
	if(form.VIN.value=='' || form.VIN.value==null){
		alert("Please Type VIN.");
		form.VIN.focus();
		form.VIN.style.border="1px solid red";
		return false;
	}
	
	if(form.produceyear.value=='' || form.produceyear.value==null){
		alert("Please Type Produec Year/ Model.");
		form.produceyear.focus();
		form.produceyear.style.border="1px solid red";
		return false;
	}
	
	if(form.price.value=='' || form.price.value==null){
		alert("Please Type Price.");
		form.price.focus();
		form.price.style.border="1px solid red";
		return false;
	}
	
	if(form.selling.value=='0' || form.selling.value==0){
		alert("Please Choose Selling Status.");
		form.selling.focus();
		form.selling.style.border="1px solid red";
		return false;
	}
	
	if(form.usage.value=='0' || form.usage.value==0){
		alert("Please Choose Usage Status.");
		form.usage.focus();
		form.usage.style.border="1px solid red";
		return false;
	}
	
	form.submit();				
	return true; 
	
}

function validate_edit_info_car(){
	var form = document.carForm;	
	
	if(form.brandtype.value==0 || form.brandtype.value=='0'){
		alert("Please Choose Brand Type.");
		form.brandtype.focus();
		form.brandtype.style.border="1px solid red";
		return false;
	}
	
	if(form.VIN.value=='' || form.VIN.value==null){
		alert("Please Type VIN.");
		form.VIN.focus();
		form.VIN.style.border="1px solid red";
		return false;
	}
	
	if(form.produceyear.value=='' || form.produceyear.value==null){
		alert("Please Type Produec Year/ Model.");
		form.produceyear.focus();
		form.produceyear.style.border="1px solid red";
		return false;
	}
	
	if(form.price.value=='' || form.price.value==null){
		alert("Please Type Price.");
		form.price.focus();
		form.price.style.border="1px solid red";
		return false;
	}
	
	if(form.selling.value=='0' || form.selling.value==0){
		alert("Please Choose Selling Status.");
		form.selling.focus();
		form.selling.style.border="1px solid red";
		return false;
	}
	
	if(form.usage.value=='0' || form.usage.value==0){
		alert("Please Choose Usage Status.");
		form.usage.focus();
		form.usage.style.border="1px solid red";
		return false;
	}
	form.idcar.value=id;
	form.submit();				
	return true; 
	
}


function produceyear_numbersonly(e)
 {
	var key;
	var keychar;
	if(window.event)
		key=window.event.keyCode;		
	else if(e)
		key=e.which;
	else
		return true;
	keychar=String.fromCharCode(key);
	if((key==null)||(key==0)||(key==8)||(key==9)||(key==13)||(key==27))
		return true;
	else if(("0123456789/").indexOf(keychar)>-1){
		return true;
	}
	return false;					
 } 
 
function price_numbersonly(e)
 {
	var key;
	var keychar;
	if(window.event)
		key=window.event.keyCode;		
	else if(e)
		key=e.which;
	else
		return true;
	keychar=String.fromCharCode(key);
	if((key==null)||(key==0)||(key==8)||(key==9)||(key==13)||(key==27))
		return true;
	else if(("0123456789.").indexOf(keychar)>-1){
		return true;
	}
	return false;					
 }  

 // For validate add_company_name
function validate_company_name(){
	var form = document.companyForm;

	if(form.companyname.value=='' || form.companyname.value==null){
		alert("Please Type Company name");
		form.companyname.focus();
		form.companyname.style.border="1px solid red";
		return false;
	}
	
	if(form.country_name.value==0 || form.country_name.value=='0'){
		alert("Please Choose Country Name");
		form.country_name.focus();
		form.country_name.style.border="1px solid red";
		return false;
	}
	
		
	form.submit();				
	return true; 
	
}  

function validate_brand_name(){
	var form = document.brandForm;

	if(form.brandtype.value=='' || form.brandtype.value==null){
		alert("Please Type Brand Type");
		form.brandtype.focus();
		form.brandtype.style.border ="1px solid red";
		return false;
	}
	
	if(form.companyname.value==0 || form.companyname.value=='0'){
		alert("Please Choose Company name");
		form.companyname.focus();
		form.companyname.style.border="1px solid red";
		return false;
	}

	

}   

function checkPopUp(){
	var form = document.uploadForm;
	
	if(form.updimg.value=='' || form.updimg.value==null){
		alert("Please Choose Image File to upload.");
		form.updimg.focus();
		form.updimg.style.border="1px solid red";
		return false;
	}
	
	form.submit();				
	return true; 
}    
