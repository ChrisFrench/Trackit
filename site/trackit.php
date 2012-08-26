<?php
/**
 * @package Trackit
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

// Check the registry to see if our Trackit class has been overridden
if ( !class_exists('Trackit') ) 
    JLoader::register( "Trackit", JPATH_ADMINISTRATOR.DS."components".DS."com_trackit".DS."defines.php" );

// before executing any tasks, check the integrity of the installation
Trackit::getClass( 'TrackitHelperDiagnostics', 'helpers.diagnostics' )->checkInstallation();

// set the options array
$options = array( 'site'=>'site', 'type'=>'components', 'ext'=>'com_trackit' );

// Require the base controller
Trackit::load( 'TrackitController', 'controller', $options );

// Require specific controller if requested
$controller = JRequest::getWord('controller', JRequest::getVar( 'view' ) );
if (!Trackit::load( 'TrackitController'.$controller, "controllers.$controller", $options ))
    $controller = '';

if (empty($controller))
{
    // redirect to default
    $default_controller = new TrackitController();
    $redirect = "index.php?option=com_trackit&view=" . $default_controller->default_view;
    $redirect = JRoute::_( $redirect, false );
    JFactory::getApplication()->redirect( $redirect );
}

$doc = JFactory::getDocument();
$uri = JURI::getInstance();
$js = "var com_trackit = {};\n";
$js.= "com_trackit.jbase = '".$uri->root()."';\n";
$doc->addScriptDeclaration($js);

$parentPath = JPATH_ADMINISTRATOR . '/components/com_trackit/helpers';
DSCLoader::discover('TrackitHelper', $parentPath, true);

$parentPath = JPATH_ADMINISTRATOR . '/components/com_trackit/library';
DSCLoader::discover('Trackit', $parentPath, true);

// load the plugins
JPluginHelper::importPlugin( 'trackit' );

// Create the controller
$classname = 'TrackitController'.$controller;
$controller = Trackit::getClass( $classname );

// ensure a valid task exists
$task = JRequest::getVar('task');
if (empty($task))
{
    $task = 'display';
    JRequest::setVar( 'layout', 'default' );
}
JRequest::setVar( 'task', $task );

// Perform the requested task
$controller->execute( $task );

// Redirect if set by the controller
$controller->redirect();

?>