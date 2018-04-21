<?php

class Perm extends AppModel{



    public $useTable = "listmembers__perm";



    public function __makeCondition($search) {

		if((string)(int)$search == $search) {

			return array(

				'perm' => intval($search)

			);

		}

	}



	public function getListMembersByPerm($perm, $key) {

		$conditions = array("Perm.perm" => $perm);

	  	$search_user = $this->find('first', array(

	  		'conditions' => $conditions

	  	));

	  	return (!empty($search_user)) ? $search_user['Perm'][$key] : NULL;

  	}



}

