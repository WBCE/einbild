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
  DEUTSCHE SPRACHDATEI FUER DAS MODUL: einbild
 -----------------------------------------------------------------------------------------
*/

// Deutsche Modulbeschreibung
$module_description = 'Mit diesem Modul werden externe Scripte (z.B. Google Maps) DSGVO-konform erst mit expliziter Zustimmung geladen.';

$EB['HEADLINE'] = 'Titel/Alt-Text';
$EB['IMAGE']  = 'Bild';
$EB['IMAGE_DELETE']  = 'Bild löschen';
