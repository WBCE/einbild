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

// Insert an extra row into the database
$sql = 'INSERT INTO `'.TABLE_PREFIX.'mod_einbild` '
     . 'SET `page_id`='.$page_id.', '
     .     '`section_id`='.$section_id.', '
     .     '`headline`=\'\', '
     .     '`image`=\'\'';
$database->query($sql);

