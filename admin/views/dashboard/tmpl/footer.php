<?php
/**
 * @version	1.5
 * @package	Trackit
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/
defined('_JEXEC') or die('Restricted access'); ?>

	<?php
	    $defines = Trackit::getInstance();

		$img_file = "dioscouri_logo_transparent.png";
		$img_path = "../media/com_trackit/images";

		$url = "http://www.dioscouri.com/";
		if ($amigosid = $defines->get( 'amigosid', '' ))
		{
			$url .= "?amigosid=".$amigosid;
		}
	?>

	<table style="margin-bottom: 5px; width: 100%; border-top: thin solid #e5e5e5;">
	<tbody>
	<tr>
		<td style="text-align: left; width: 33%;">
			Built with Dioscouri rapid development library!<br>
			<a href="https://github.com/dioscouri/library" target="_blank">https://github.com/dioscouri/library</a> 
		</td>
		<td style="text-align: center; width: 33%;">
			<?php echo JText::_( "Trackit" ); ?>: <?php echo JText::_( "COM_TRACKIT_DESC" ); ?>
			<br/>
		
			<?php echo JText::_( "COM_TRACKIT_VERSION" ); ?>: <?php echo $defines->getVersion(); ?>
		</td>
		<td style="text-align: right; width: 33%;">
		</td>
	</tr>
	</tbody>
	</table>
