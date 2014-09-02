<?php

/*****************************
NOTES
 * CLASS FILE TO STORE  MIX TYPES OF DATA STRUCTURE ALSO "GET SET" FUNCTIONS FOR FUNTURE CHECKING PURPOSE
******************************/

class Events {
	private $eventsinfo = array();
	private $eventsreply=array();
	private $eventscategory=array();





	function __construct() {
		$this->eventsinfo=array( 'eventsid'=>0, 'subject'=>'', 'readaccess'=>0, 'body'=>'', 'categoryid'=>0, 'createtime'=>NULL, 'uid'=>0, 'startime'=>NULL, 
			'endtime'=>NULL, 'maxmember'=>0,'lastedit'=>NULL
		);
		$this->eventsreply=array(
			'eventsreplyid'=>0, 'eventsid'=>0, 'body'=>'', 'uid'=>0, 'replytime'=>NULL,'lastedit'=>NULL
		);
		$this->eventscategory=array( 'categoryid'=>0, 'categoryname'=>'' );

	}

	public function __get( $key ) {
		return $this->eventsinfo[$key];
	}

	public function __set( $key, $value ) {
		$this->eventsinfo[$key] = $value;
	}

	public function Geteventsreply( $key ) {//may add isset later
		return $this->eventsreply[$key];
	}

	public function Seteventsreply( $key, $value ) {//may add isset later
		$this->eventsreply[$key] = $value;
	}

	public function Geteventscategory( $key ) {//may add isset later
		return $this->eventscategory[$key];
	}

	public function Seteventscategory( $key, $value ) {//may add isset later
		$this->eventscategory[$key] = $value;
	}


}



?>
