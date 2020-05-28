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

// Delete record from the database
$database->query("DELETE FROM ".TABLE_PREFIX."mod_einbild WHERE section_id = '$section_id'");
