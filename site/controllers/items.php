<?php
/**
 * @version 1.5
 * @package Trackit
 * @author  Dioscouri Design
 * @link    http://www.dioscouri.com
 * @copyright Copyright (C) 2007 Dioscouri Design. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );

class TrackitControllerItems extends TrackitController
{
	/**
	 * constructor
	 */
	function __construct()
	{
		parent::__construct();

		$this->set('suffix', 'items');
		
		
	}
	
	function viewed()
    {
        
 
        $model  = $this->getModel( $this->get('suffix') );
        $id = $model->getUpdateId();
        $response = array();
		if(!$id) {
			//if no ID, than create a row, if this fails we  die
			$this->create();
			$id = $model->getUpdateId();
			if(!$id) {
				$response['msg'] = 'Failed to find ID';
			}
		} else {
        
	    JTable::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_trackit/tables' );
	    $table = JTable::getInstance( 'Items', 'TrackitTable' );
	    $table->load( $id ); 
        $table->viewed();
	    
		// create a responce and send it back JSON encoded
		
        $response['msg'] = $table->viewed;
		//$response['success'] = $success;
		}
			
        echo ( json_encode( $response ) );
       
       
    }
	
	function played()
    {
        
        $model  = $this->getModel( $this->get('suffix') );
		$id = $model->getUpdateId();
        
	    JTable::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_trackit/tables' );
	    $table = JTable::getInstance( 'Items', 'TrackitTable' );
	    $table->load( $id ); 
        $table->played();
	    
		$response = array();
        $response['msg'] = $table->played;
		//$response['success'] = $success;
		
			
        echo ( json_encode( $response ) );
       
       
    }
	
	function create() {
		
		//create should really only ever be called by the view update
		
		$name = urldecode(JRequest::getVar('n'));
		$url = urldecode(JRequest::getVar('u'));	
		$object_id = JRequest::getVar('oid');
	
		echo $url; 
	    JTable::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_trackit/tables' );
	    $table = JTable::getInstance( 'Items', 'TrackitTable' );
	    $table->load(); 
		$table->name = $name;
	    $table->url = $url;
		$table->object_id = $object_id;
		$table->store();
		
	}




}

?>