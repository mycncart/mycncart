<?php 
/******************************************************
 * @package Pav blog module for Opencart 1.5.x
 * @version 1.0
 * @author http://www.pavothemes.com
 * @copyright	Copyright (C) Feb 2013 PavoThemes.com <@emai:pavothemes@gmail.com>.All rights reserved.
 * @license		GNU General Public License version 2
*******************************************************/

/**
 * class ModelPavblogComment 
 */
class ModelPavblogComment extends Model {		
	
	
	public function getLatest( $limit ){
		
		$sql = 'SELECT c.* FROM '.DB_PREFIX.'pavblog_comment c WHERE `status`=1  ORDER BY created DESC';
		

		
		$sql .= " LIMIT " . $limit;
	
	
		$query = $this->db->query( $sql ); 
		$data = $query->rows;
		
		return $data;
	}
	
	public function getList( $data ){
	
		$sql = 'SELECT c.* FROM '.DB_PREFIX.'pavblog_comment c WHERE `status`=1 AND blog_id='.$data['blog_id'].' ORDER BY created DESC';
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}				

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
	
		$query = $this->db->query( $sql ); 
		$data = $query->rows;
		
		return $data;

	}
	public function countComment( $blog_id ){
		$sql = 'SELECT count(c.comment_id)as total FROM '.DB_PREFIX.'pavblog_comment c WHERE `status`=1 AND blog_id='.$blog_id;
			
		$query = $this->db->query( $sql ); 
		$data = $query->row;
		
		return $data['total'];
	}
	
	public function saveComment( $data , $status=0){
		$sql = ' INSERT INTO '.DB_PREFIX.'pavblog_comment (status,user,email,comment,blog_id,created) VALUES('.(int)$status.',"'
				.$this->db->escape($data['user']).'","'.$this->db->escape($data['email']).'","'.$this->db->escape($data['comment']).'",'.(int)($data['blog_id']).', now()) ';

		$this->db->query( $sql );
	}
}
?>