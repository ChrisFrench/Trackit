<?php
/**
 * @package	Trackit
 * @author 	Dioscouri Design
 * @link 	http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/
 
/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );


Trackit::load('TrackitTable','tables.base');

class TrackitTableItems extends TrackitTable 
{

	function TrackitTableItems( &$db ) 
	{
		$tbl_key 	= 'id';
		$tbl_suffix = 'items';
		$this->set( '_suffix', $tbl_suffix );
		$name 		= "trackit";
		
		parent::__construct( "#__{$name}_{$tbl_suffix}", $tbl_key, $db );	
	}
	
	function check( )
	{
		$db = $this->getDBO( );
		$nullDate = $db->getNullDate( );
		if ( empty( $this->createdate ) || $this->createdate == $nullDate )
		{
			$date = JFactory::getDate( );
			$this->createdate = $date->toMysql( );
		}

		
		if ( empty( $this->name ) )
		{
		  return false;
		}
		if ( empty( $this->url ) )
		{
		  return false;
		}
		if ( empty( $this->object_id ) )
		{
		  return false;
		}
		
		
		return true;
	}
	
	function viewed()
	
	{
		if($this->check()){ // Check is required to avoid  having it create a empty row, with just a view of 1
        $this->viewed = $this->viewed + 1;
        $this->store( false ); 
		}
	}
	function played()
	
	{
		if($this->check()){ // Check is required to avoid  having it create a empty row, with just a view of 1
        $this->played = $this->played + 1;
        $this->store( false ); 
		}
	}
	
	
}