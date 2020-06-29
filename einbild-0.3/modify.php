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


//Load Language Files
$lang = __DIR__ . '/languages/' . LANGUAGE . '.php';
require (!file_exists($lang) ? __DIR__ . '/languages/EN.php' : $lang);
	
// Fetch media URL for replacing {SYSVAR:MEDIA_REL}
$sMediaUrl = WB_URL.MEDIA_DIRECTORY;

// Get page content   htmlspecialchars
$headline = '';
$image=WB_URL.'/modules/einbild/blank.png';
$image_delete_disabled = 'disabled';

$sql = 'SELECT * FROM `'.TABLE_PREFIX.'mod_einbild` WHERE `section_id`='.(int)$section_id;
$get_content = $database->query($sql);
$rows = $get_content->numRows();
if ($rows==1) {
	$Data = $get_content->fetchRow();
	
	// get values for Variables
	$headline = $Data['headline'];
	if ($Data['image']!="") {
		$image = str_replace('{SYSVAR:MEDIA_REL}', $sMediaUrl, $Data['image'] );
		$image_delete_disabled='';
	}

} else {
	echo "<h3>Database error, did not found the right number of rows ($rows)</h3>" ;
}



include (WB_PATH."/modules/einbild/templates/modify.tpl.php");


