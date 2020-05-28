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



$module_directory = 'einbild';
$module_name = 'einbild';
$module_function = 'page';
$module_version = '0.3';
$module_platform = '1.4.0';
$module_author = 'florian';
$module_license = 'WTFPL';
$module_description = 'Place an image somewhere. ';

/*
0.3 2020/05/27
! Fix for Fatal Error when used with other wysiwyg2 based modules on the same page (thx to Bernd)