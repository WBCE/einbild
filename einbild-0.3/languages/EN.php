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

/*
 -----------------------------------------------------------------------------------------
  ENGLISH LANGUAGE FILE FOR MODULE: einbild
 -----------------------------------------------------------------------------------------
*/

// Deutsche Modulbeschreibung
$module_description = 'This module loads external scripts (e.g. Google Maps) only with consent of the visitors (according to GDPR).';

$EB['HEADLINE'] = 'Title/Alt text';
$EB['IMAGE']  = 'Image';
$EB['IMAGE_DELETE']  = 'Delete image';
