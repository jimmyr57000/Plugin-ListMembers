<?php
class ListmembersAppSchema extends CakeSchema {

	public $file = 'schema.php';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {}

		public $listmembers__perm = array(
			
			'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
			
			'perm' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
			
			'etat' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
			
		);
}