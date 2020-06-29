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
?>

<img class="mod_einbild_img" src="<?php echo $image; ?>" alt="<?php echo $headline; ?>" title="<?php echo $headline; ?>" />