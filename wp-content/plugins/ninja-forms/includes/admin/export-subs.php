<?php
if(isset($_REQUEST['ninja_forms_export_subs_to_csv']) AND $_REQUEST['ninja_forms_export_subs_to_csv'] != ''){
	add_action('admin_init', 'ninja_forms_subs_bulk_export');
}

function ninja_forms_subs_bulk_export(){
	if(isset($_REQUEST['sub_id']) AND $_REQUEST['sub_id'] != ''){
		$sub_ids = array($_REQUEST['sub_id']);
		ninja_forms_export_subs_to_csv($sub_ids);
	}
}

function ninja_forms_export_subs_to_csv($sub_ids = ''){
	global $ninja_forms_fields;
	$plugin_settings = get_option("ninja_forms_settings");
	if(isset($plugin_settings['date_format'])){
		$date_format = $plugin_settings['date_format'];
	}else{
		$date_format = 'm/d/Y';
	}
	//Create a $label_array that contains all of the field labels.
	//Get the Form ID.
	if(isset($_REQUEST['form_id'])){
		$form_id = $_REQUEST['form_id'];
	}
	//Get the fields attached to the Form ID
	$field_results = ninja_forms_get_fields_by_form_id($form_id);
	//Set the label array to a blank
	$label_array = array();
	$value_array = array();
	$sub_id_array = array();
	
	$label_array[0][] = "Date";
	if(is_array($field_results) AND !empty($field_results)){
		foreach($field_results as $field){
			$field_type = $field['type'];
			$field_id = $field['id'];
			$process_field = $ninja_forms_fields[$field_type]['process_field'];
			if(isset($field['data']['label'])){
				$label = $field['data']['label'];
			}else{
				$label = '';
			}
			if($process_field){
				$label_array[0][$field_id] = $label;
			}
		}
	}

	if(is_array($sub_ids) AND !empty($sub_ids)){
		$x = 0;
		foreach($sub_ids as $id){
			$sub_row = ninja_forms_get_sub_by_id($id);
			$sub_id_array[$x] = $id;
			$date_updated = date($date_format, strtotime($sub_row['date_updated']));
			$value_array[$x][] = $date_updated;
			if(is_array($sub_row['data']) AND !empty($sub_row['data'])){
				foreach( $label_array[0] as $field_id => $label ){
					if( $field_id != 0 ){
						$found = false;
						foreach( $sub_row['data'] as $data ){
							$data['user_value'] = ninja_forms_stripslashes_deep( $data['user_value'] );
							if( $data['field_id'] == $field_id ){
								if( is_array( $data['user_value'] ) ){
									$user_value = implode_r( ',', $data['user_value'] );
								}else{
									$user_value = $data['user_value'];
								}
								$found = true;
							}
						}
						if( !$found ){
							$user_value = '';
						}
						$value_array[$x][] = $user_value;
					}
				}
			}
			$x++;				
		}
	}

	$value_array = ninja_forms_stripslashes_deep( $value_array );
	$value_array = apply_filters( 'ninja_forms_export_subs_value_array', $value_array, $sub_id_array );
	$label_array = ninja_forms_stripslashes_deep( $label_array );
	$label_array = apply_filters( 'ninja_forms_export_subs_label_array', $label_array, $sub_id_array );

	$array = array($label_array, $value_array);
	$today = date($date_format);
	$filename = 'ninja_forms_subs_'.$today.'.csv';

	header("Content-type: application/csv");
	header("Content-Disposition: attachment; filename=".$filename);
	header("Pragma: no-cache");
	header("Expires: 0");
	echo str_putcsv($array);

	die();

}

function implode_r ($glue, $pieces){ 
 $out = ""; 
 foreach ($pieces as $piece) 
  if (is_array ($piece)) $out .= implode_r ($glue, $piece); // recurse 
  else                  $out .= $glue.$piece; 
   
 return $out; 
 } 