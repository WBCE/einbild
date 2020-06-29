<?php
/**
 * @category        modules
 * @package         einbild
 * @author          WBCE Project
 * @copyright       florian
 * @license			WTFPL
 */
//no direct file access
if(count(get_included_files()) ==1){$z="HTTP/1.0 404 Not Found";header($z);die($z);}

// fetch the function fo template loading , this should be in core 
require_once (WB_PATH."/modules/einbild/includes/get_tpl_file.php");

//Load Language Files
$lang = __DIR__ . '/languages/' . LANGUAGE . '.php';
require (!file_exists($lang) ? __DIR__ . '/languages/EN.php' : $lang);


// fetch MEdial url for replace {SYSVAR:MEDIA_REL}
$sMediaUrl = WB_URL.MEDIA_DIRECTORY;

// Get content 
$headline = '';
$image='';

$sql = 'SELECT * FROM `'.TABLE_PREFIX.'mod_einbild` WHERE `section_id`='.(int)$section_id;
$get_content = $database->query($sql);
$rows = $get_content->numRows();
if ($rows==1) {
	$Data = $get_content->fetchRow();
	
	// get values for Variables
	$headline = $Data['headline'];
	if ($Data['image']!="") 
		$image = str_replace('{SYSVAR:MEDIA_REL}', $sMediaUrl, $Data['image'] );
} else {
	$content= "<h3>Database error, did not found the right number of rows ($rows)</h3>" ;
}



$page_title=$wb->page_title;
$page_description=$wb->page_description;
$page_keywords=$wb->page_keywords;

//if the Template got a special template for this override the default one
include (GetModTplFile('einbild'));





