<?php 
function has_max_length($value,$max)//length if block
{
	return strlen($value) <= $max;
}
function validate_max_lengths($fields_max_length)//function for length
{
	global $errors;
	foreach($fields_max_length as $field => $max)
	{
		$value=trim($_POST[$field]);
		if(!has_max_length($value,$max))
		{
			$errors[$field]=ucfirst($field) . "is to long";
		}
	}
}
function has_min_length($value,$min)//min length if checking
{
	return strlen($value)<$min;
}
function validate_min_lengths($fields_min_length)//min length function
{
	global $errors;
	foreach ($fields_min_length as $field => $min) 
	{
		$value=trim($_POST[$field]);
		if(has_min_length($value,$min))
		{
			$errors[$field]=ucfirst($field) . "  is to short";
		}
	}
}
function has_presence($value)//not empty block
{
	return isset($value) && $value!=="";
}
function all_prestnt($name_fields_presence)//function for not empty
{
	global $errors;
	foreach ($name_fields_presence as $field) 
	{
		$value=trim($_POST[$field]);
		if(!has_presence($value))
		{
			$errors[$field]=ucfirst($field) . " cannot be blank ";
		}
	}
}
function form_errors($errors=array())//errors printing
{
	$output="";
	if(!empty($errors))
	{
		$output="<div class=\"error\">";
		$output .="Please fix the following errors:";
		$output .="<ul>";
		foreach($errors as $key=>$error)
		{
			$output .="<li>{$error}</li>";
		}
		$output .="</ul>";
		$output .="</div>";
	}
	return $output;
}
function all_regular($name_regular)//regula format function
{
	global $errors;
	foreach ($name_regular as $fields) 
	{
		$value=trim($_POST[$fields]);
		if (!preg_match("/^[a-zA-Z ]*$/",$value)) 
		{
			$errors[$fields] =ucfirst($fields) . " can have only letters "; 
		}
	}
}

?>

