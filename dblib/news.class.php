<?php
/*****************************
NOTES
 * CLASS FILE TO STORE  MIX TYPES OF DATA STRUCTURE ALSO "GET SET" FUNCTIONS FOR FUNTURE CHECKING PURPOSE
******************************/

class News {
	protected $newsinfo = array();
	protected $newscategory = array();





	function __construct() {
		$this->newsinfo=array( 'newsid'=>0, 'uid'=>0, 'readaccess'=>0, 'subject'=>'', 
			'createtime'=>NULL, 'body'=>'', 'categoryid'=>0,'lastedit'=>NULL
		);
		
		$this->newscategory=array( 'categoryid'=>0, 'categoryname'=>'' );

	}

	public function __get( $key ) {
		return $this->newsinfo[$key];
	}

	public function __set( $key, $value ) {
		$this->newsinfo[$key] = $value;
	}


	public function Getnewscategory( $key ) {//may add isset later
		return $this->newscategory[$key];
	}
	public function Setnewscategory( $key, $value ) {
		$this->newscategory[$key] = $value;
	}
        


}



?>
