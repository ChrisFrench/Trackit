<?php
/**
 * @package	Trackit
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

Trackit::load( 'TrackitViewBase', "views.base", array( 'site'=>'site', 'type'=>'components', 'ext'=>'com_trackit' ) );

class TrackitViewDashboard extends TrackitViewBase  
{
}