<?php

/*****************************
NOTES
 * CLASS FILE TO STORE  MIX TYPES OF DATA STRUCTURE ALSO "GET SET" FUNCTIONS FOR FUNTURE CHECKING PURPOSE
******************************/
class User {
	
          private $useraccess;               
       private $userinfo;
	public function __construct() {
        
                $this->useraccess=array(
			'accessid'=>0, 'readaccess'=>0, 'allowview'=>'0',
			'allowpost'=>'0', 'allowreply'=>'0', 'allowupdate'=>'0',
			'allowdelete'=>'0', 'allowgetattach'=>'0',
			'allowpostattach'=>'0', 'allowsearch'=>'0',
			'allowsetreadperm'=>'0', 'type'=>'');
		$this->userinfo=array( 'uid'=>0, 'accessid'=>0, 'username'=>'', 'userpass'=>'',
			'email'=>'', 'firstname'=>'', 'lastname'=>'', 'gender'=>'m',
			'phonenumber'=>'', 'address'=>'', 'status'=>0, 'created'=>NULL,
			'lastlogin'=>NULL, 'identifier'=>NULL, 'expiry_time'=>NULL
		);
		


	}

	public function __get( $key ) {
		return $this->userinfo[$key];
	}

	public function __set( $key, $value ) {
		$this->userinfo[$key] = $value;
	}

	public function Getuseraccess( $key ) {
		return $this->useraccess[$key];
	}

	public function Setuseraccess( $key, $value ) {
		$this->userinfo[$key] = $value;
	}
        public function toshow(){
            
            foreach ($this->userinfo as $key => $value) {
                    echo $value."\n";
                }
        }
        
        



}



?>
