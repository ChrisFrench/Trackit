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

if ( !class_exists('Trackit') ) {
    JLoader::register( "Trackit", JPATH_ADMINISTRATOR.DS."components".DS."com_trackit".DS."defines.php" );
}

Trackit::load( "TrackitHelperRoute", 'helpers.route' );

/**
 * Build the route
 * Is just a wrapper for TrackitHelperRoute::build()
 * 
 * @param unknown_type $query
 * @return unknown_type
 */
function TrackitBuildRoute(&$query)
{
    return TrackitHelperRoute::build($query);
}

/**
 * Parse the url segments
 * Is just a wrapper for TrackitHelperRoute::parse()
 * 
 * @param unknown_type $segments
 * @return unknown_type
 */
function TrackitParseRoute($segments)
{
    return TrackitHelperRoute::parse($segments);
}