<?php
/**
 * @category        modules
 * @package         einbild
 * @author          WBCE Project
 * @copyright       florian
 * @license			WTFPL
 */

// Fetch config and Initialize
require('../../config.php');

// suppress to print the header, so no new FTAN will be set
// This is only here till we remove singletab 
$admin_header = false;

// Tells script to update when this page was last updated
$update_when_modified = true;

// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

// Check for Valid FTAN
if (!$admin->checkFTAN()) {
	$admin->print_header();
	$admin->print_error($MESSAGE['GENERIC_SECURITY_ACCESS'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

// After check print the header Maybe we too no longer need this.. we will see 
$admin->print_header();

// Include the WB functions file
require_once(WB_PATH.'/framework/functions.php');


$bBackLink = isset($_POST['pagetree']);

// Update the mod_wysiwygs table with the contents
if(isset($_POST['headline'.$section_id])) 
    $headline = $_POST['headline'.$section_id];


if ($_FILES['image'.$section_id]['name']!='') {
	
	$fname = strtolower($_FILES['image'.$section_id]['name']); 
	$path_parts = pathinfo($fname);

	$ffname = $path_parts['filename'];
	$fileext = '.'.$path_parts['extension'];
	$allowed =' .png.gif.jpg.jpeg.svg';
	if (strpos($allowed,$fileext) == false) {
		$admin->print_error($MESSAGE['GENERIC_CANNOT_UPLOAD'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
		die();
	}

	/*
	print_r($path_parts);
	echo $fname.'<br/>';
	echo $fileext.'<br/>';
	die(); 
	*/
	array_map('unlink', glob(WB_PATH.MEDIA_DIRECTORY.'/einbild/s'.$section_id."_*"));

	$folder = WB_PATH.MEDIA_DIRECTORY.'/einbild';
	if (!is_dir($folder)) make_dir($folder);


	$ncount = 1;
	while ($ncount < 100) {
		if ($ncount == 1) {
			$fullname = 's'.$section_id.'_'.$ffname.$fileext;
		} else {
			$fullname = 's'.$section_id.'_'.$ffname.'-'.$ncount.$fileext;
		}
		$fullpfad = $folder.'/'.$fullname;
		if (!file_exists($fullpfad)) {break;}
		$ncount++;
	}

	//move only
	if (! move_uploaded_file($_FILES['image'.$section_id]['tmp_name'], $fullpfad))  {		
		  $admin->print_error($MESSAGE['GENERIC_CANNOT_UPLOAD'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
	} else {
		$image = '{SYSVAR:MEDIA_REL}/einbild/'.$fullname;
	}
	
	$saveimage=', `image`=\''.$database->escapeString($image).'\' ';

} else {
	$image='';
	$saveimage='';
}

// one more special case , delete the image is set, this overrides the upload and delete it. 
if(isset($_POST['delete'.$section_id])) {
	array_map('unlink', glob(WB_PATH.MEDIA_DIRECTORY.'/einbild/s'.$section_id."_*"));
	$image="";
	$saveimage=', `image`=\'\'';
}

// one more special case , delete the image is set, this overrides the upload and delete it. 
if(isset($_POST['delete'.$section_id])) {
	array_map('unlink', glob(WB_PATH.MEDIA_DIRECTORY.'/einbild/s'.$section_id."_*"));
	$image="";
}


$headline = strip_tags($headline);

// Generate SQL Query and run it 


// now create the rest of the query
$sql = 'UPDATE `'.TABLE_PREFIX.'mod_einbild` '
     . 'SET `headline`=\''.$database->escapeString($headline).'\' '
     
	 .     $saveimage 
    
     . 'WHERE `section_id`='.(int)$section_id;
$database->query($sql);

$sec_anchor = (defined( 'SEC_ANCHOR' ) && ( SEC_ANCHOR != '' )  ? '#'.SEC_ANCHOR.$section['section_id'] : '' );
if(defined('EDIT_ONE_SECTION') && EDIT_ONE_SECTION){
    $edit_page = ADMIN_URL.'/pages/modify.php?page_id='.$page_id.'&einbild='.$section_id;
} elseif ( $bBackLink ) {
	$edit_page = ADMIN_URL.'/pages/index.php';
} else {
    $edit_page = ADMIN_URL.'/pages/modify.php?page_id='.$page_id.$sec_anchor;
}

// Check if there is a database error, otherwise say successful
if ($database->is_error()) {
	$admin->print_error($database->get_error(), $js_back);
} else {
	$admin->print_success($MESSAGE['PAGES_SAVED'], $edit_page );
}

// Print admin footer //This displays the footer/End of admin page 
$admin->print_footer();


