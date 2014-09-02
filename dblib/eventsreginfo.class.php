<?php
/*****************************
NOTES
 * CLASS FILE TO STORE  MIX TYPES OF DATA STRUCTURE ALSO "GET SET" FUNCTIONS FOR FUNTURE CHECKING PURPOSE
******************************/

class Eventsreginfo {
	private $reginfo = array();

	function __construct() {
		$this->reginfo=array( 'regid'=>0, 'eventsid'=>0, 'uid'=>0, 'registertime'=>NULL, 'numberofpeople'=>0, 'remarks'=>''
		);

	}

	public function __get( $key ) {
		return $this->reginfo[$key];
	}

	public function __set( $key, $value ) {
		$this->reginfo[$key] = $value;
	}




}



?>
