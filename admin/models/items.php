<?php
/**
* @package		Trackit
* @copyright	Copyright (C) 2009 DT Design Inc. All rights reserved.
* @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
* @link 		http://www.dioscouri.com
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');


Trackit::load('TrackitModelBase','models.base');

class TrackitModelItems extends TrackitModelBase 
{
	
	protected function _buildQueryWhere(&$query)
    {
        $filter     = $this->getState('filter');
		$filter_id_from = $this->getState('filter_id_from');
        $filter_id_to   = $this->getState('filter_id_to');
       	$filter_name      = $this->getState('filter_name');
		$filter_url    = $this->getState('filter_url');
    	$filter_viewed    = $this->getState('filter_viewed');
		$filter_played    = $this->getState('filter_played');
    	$filter_datecreated     = $this->getState('filter_datecreated ');
    	$filter_lastmodified    = $this->getState('filter_lastmodified');
		$filter_enabled    = $this->getState('filter_enabled');
		
        if ($filter) 
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter ) ) ).'%');
            $where = array();
            $where[] = 'LOWER(tbl.name) LIKE '.$key;
           
      
            $query->where('('.implode(' OR ', $where).')');
        }
		if ($filter_name) 
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter_name ) ) ).'%');
            $where = array();
            $where[] = 'LOWER(tbl.name) LIKE '.$key;
          
      
            $query->where('('.implode(' OR ', $where).')');
        }
		
		 if (strlen($filter_id_from))
        {
            if (strlen($filter_id_to))
            {
                $query->where('tbl.id >= '.(int) $filter_id_from);  
            }
                else
            {
                $query->where('tbl.id = '.(int) $filter_id_from);
            }
        }
        
        if (strlen($filter_id_to))
        {
            $query->where('tbl.id <= '.(int) $filter_id_to);
        }
        
    	if (strlen($filter_viewed))
    	{
    		$query->where("tbl.viewed = '".$filter_viewed."'");
    	}
		
		if (strlen($filter_played))
    	{
    		$query->where("tbl.played = '".$filter_played."'");
    	}
		
		 if ($filter_url) 
        {
            $key    = $this->_db->Quote('%'.$this->_db->getEscaped( trim( strtolower( $filter_url ) ) ).'%');
            
           $query->where("tbl.url  LIKE ".$key);
        }
      
    	
		
    	if (strlen($filter_datecreated))
        {
            $query->where("tbl.datecreated = '".$filter_datecreated."'");
        }
          
		    	
       if (strlen($filter_lastmodified))
        {
            $query->where("tbl.lastmodified = '".$filter_lastmodified."'");
        }
	    
		if (strlen($filter_enabled))
        {
            $query->where("tbl.enabled = '".$filter_enabled."'");
        }
	 
    }

	 protected function _buildQueryGroup(&$query)
    {
    }

	/**
     * Builds JOINS clauses for the query
     */
    protected function _buildQueryJoins(&$query)
    {
  	
    }
	/**
	 * Builds SELECT fields list for the query
	 */
	protected function _buildQueryFields(&$query)
	{
		$fields = array();
		//$fields[] = " scope.* ";
		
	
	//	 $fields[] = " MAX(review.lastVisited)  ";
        
		
		$query -> select($fields);
		// if you move this up above the fields than the building addresses override the school address
		$query -> select($this -> getState('select', 'tbl.*'));
		
	}
	
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk)) {
			// Convert the params field to an object, than we can  have access to edit in the admi views, i change it to attribs to keep the json if needed. 
			//$registry = new JRegistry;
			//$registry->loadString($item->params);
			//$item->attribs = $registry->toObject();

		}

		return $item;
	}
	
	/*Use Get Items to get a listing of items that has had the attribs prepared*/
	
	public function getItems()
	{
		
		$items = parent::getList(); 
	
		//foreach(@$items as $item)
		//{
			//$registry = new JRegistry;
		//	$registry->loadString($item->params);
		//	$item->attribs = $registry->toObject();
			//Modal Link
			
		//}
		
		return $items;
	}
	
	//admin style lists
	public function getList($refresh = false)
	{
		
		
		$items = parent::getList($refresh); 
		
		foreach(@$items as $item)
		{
			$item->link = 'index.php?option=com_trackit&controller=items&view=items&task=edit&id='.$item->id;
			$item->edit_link = 'index.php?option=com_trackit&task=edit&tmpl=component&layout=form&id='.$item->id;
		
		}
		
		return $items;
	}

	public function getUpdateId() {

		$id = JRequest::getVar('id');
			
		if($id){
			//if they sent the ID than just return it
			return $id;
		}
		$db = JFactory::getDBO();
		// ok we got the vars for the query
		$name = urldecode(JRequest::getVar('n'));
		$url = urldecode(JRequest::getVar('u'));	
		$object_id = JRequest::getVar('oid');
		
		$name = $db->quote($name);
		$url = $db->quote($url);
		
         $query = new DSCQuery;
        $query->select('id');
        $query->from('#__trackit_items AS tbl');
       // $query->leftJoin('#__trackit_scopes AS s ON tbl.scope_id = s.scope_id');
		if($object_id) {
		 $query->where('tbl.object_id = '. (int) $object_id);
		}
		
		if($url) {
		 $query->where('tbl.url = '. $url);
		}
		if($name) {
		 $query->where('tbl.name = '. $name);
		}
    
        $db->setQuery($query);
		
		$item = $db->loadResult();
		return $item;
		
		
		
	}
	
		
	
	
	
}