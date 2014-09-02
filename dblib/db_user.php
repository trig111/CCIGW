<?php
require_once 'config.php';
require_once 'user.class.php';
/*****************************
NOTES
 * USER RELATED DB OPERATIONS
 * USUALLY PARAMATER IS AN OBJECT,BE SURE YOU RESET THE OBJECT BEFORE NEXT INVOKE
 * FOR THOSE OF THE CHECKING PURPOSE FUNCTIONS, THEY ARE USUALLY RETURN A BOOLEAN TYPE
 * $XXXX->EXECUATE()  ALSO RETURN A BOOL TYPE

******************************/


class Db_user {

	public $db_connection_handle = NULL;

	function __construct() {

		global $DBUSER, $DBPASS, $DBNAME;

		$this->db_connection_handle =
			new PDO( "mysql:host=localhost;dbname=$DBNAME", $DBUSER, $DBPASS );
		$this->db_connection_handle->
		setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$this->db_connection_handle->setAttribute( PDO::ATTR_CASE, PDO::CASE_LOWER );
		$this->db_connection_handle->
		setAttribute( PDO::ATTR_ORACLE_NULLS, PDO::NULL_NATURAL );
	}



	//succeed:  returns # of record inserted,usually 1
	//else:     return an error string,let user do it again
	public function add_new_user( User $newuser ) {

		//$adjusted_pass = $do_hash == TRUE ? sha1($pass) : $pass;

		$user_array=array(
			':accessid'     =>$newuser->accessid,
			':username'     =>$newuser->username,
			':userpass'     =>sha1($newuser->userpass),
			':email'        =>$newuser->email,
			':firstname'    =>$newuser->firstname,
			':lastname'     =>$newuser->lastname,
			':gender'       =>$newuser->gender,
			':phonenumber'  =>$newuser->phonenumber,
			':address'      =>$newuser->address,
			':status'       =>$newuser->status,
			':lastlogin'    =>$newuser->lastlogin,
			':identifier'   =>$newuser->identifier
			//':expiry_time'  =>$newuser->expiry_time
		);
		try{
			$sql ="INSERT INTO db_user(`accessid`, `username`, `userpass`, `email`, `firstname`, `lastname`, `gender`, `phonenumber`, `address`, `status`, `created`, `lastlogin`, `identifier`, `expiry_time`) VALUES (:accessid,:username,:userpass,:email,:firstname,:lastname,:gender,:phonenumber,:address,:status,now(),:lastlogin,:identifier,NOW()+INTERVAL 1 DAY)";


			$st = $this->db_connection_handle->prepare( $sql );

			$result = $st->execute( $user_array );
                        $st->closeCursor();
			return $result;
		}
		catch ( PDOException $e ) {
			return $e->getMessage();

		}
	}

	//we assuming the primary key (uid) is not changed during the updating(uid cannot be modified by user!!!)
	//otherwise we need two User object,one for update_before and the another one for untilnow

	//sha1 function should be used before this function called
	//succeed:  returns # of record inserted,may be more then 1 since it has cascading relation
	//else:     return an error string,let user do it again

	public function update_user_info( User $userupdate ) {

		$user_array=array(
			':uid'          =>$userupdate->uid,
			':accessid'     =>$userupdate->accessid,
			':username'     =>$userupdate->username,
			//':userpass'     =>sha1($userupdate->userpass),
			':email'        =>$userupdate->email,
			':firstname'    =>$userupdate->firstname,
			':lastname'     =>$userupdate->lastname,
			':gender'       =>$userupdate->gender,
			':phonenumber'  =>$userupdate->phonenumber,
			':address'      =>$userupdate->address,
			':status'       =>$userupdate->status,
                       // ':created'      =>$userupdate->created,
			//':lastlogin'    =>$userupdate->lastlogin,
			':identifier'   =>$userupdate->identifier,
			//':expiry_time'  =>$userupdate->expiry_time
		);
                
                        
		try{

                        

$sql="UPDATE IGNORE db_user SET accessid=:accessid,username=:username,email=:email,firstname=:firstname,lastname=:lastname,gender=:gender,phonenumber=:phonenumber,address=:address,status=:status,identifier=:identifier WHERE uid=:uid";


			$st = $this->db_connection_handle->prepare( $sql );

			$result = $st->execute( $user_array );
                        
			return $result;
		}
		catch ( PDOException $e ) {
			return $e->getMessage();

		}
	}
        
        public function update_user_info_necessary( $uid,$firstname,$lastname,$gender,$phonenumber,$address,$email ) {

		$user_array=array(
			':uid'          =>$uid,
			//':accessid'     =>$userupdate->accessid,
			//':username'     =>$userupdate->username,
			//':userpass'     =>sha1($userupdate->userpass),
			':email'        =>$email,
			':firstname'    =>$firstname,
			':lastname'     =>$lastname,
			':gender'       =>$gender,
			':phonenumber'  =>$phonenumber,
			':address'      =>$address
			//':status'       =>$userupdate->status,
                        //':created'      =>$userupdate->created,
			//':lastlogin'    =>$userupdate->lastlogin,
			//':identifier'   =>$userupdate->identifier,
			//':expiry_time'  =>$userupdate->expiry_time
		);
                
                        
		try{

                        

$sql="UPDATE db_user SET firstname=:firstname,lastname=:lastname,gender=:gender,phonenumber=:phonenumber,address=:address,email=:email WHERE uid=:uid";


			$st = $this->db_connection_handle->prepare( $sql );

			$result = $st->execute( $user_array );
                        
			return $result;
		}
		catch ( PDOException $e ) {
			return $e->getMessage();

		}
	}


        public function reset_user_pass($username,$userpass ) {

		$user_array=array(
			':username'     =>$username,
			':userpass'     =>sha1($userpass)
			
		);
                
                        
		try{

                        

$sql="UPDATE db_user SET userpass=:userpass WHERE username=:username";


			$st = $this->db_connection_handle->prepare( $sql );

			$result = $st->execute( $user_array );
                        
			return $result;
		}
		catch ( PDOException $e ) {
			return $e->getMessage();

		}
	}



	// same assumation as updating
	// be cautious of it since it cascades to other table,it will delete any relevant info with this uid automatically
	//succeed:  returns # of record inserted,may be more then 1 since it has cascading relation
	//else:     return an error string,let user do it again





	public function delete_user_info(  $userdelete ) {
		$user_array=array(
			':uid'          =>$userdelete
		);

		try{
			$sql= "DELETE FROM db_user WHERE uid=:uid";

			$st = $this->db_connection_handle->prepare( $sql );

			$result = $st->execute( $user_array );

			return $result;
		}
		catch ( PDOException $e ) {
			return $e->getMessage();

		}
	}
	//assume the username has been checked already
	//based on username(this attribute is unique and has index)in db_user structure
	//depends on the controller to set how to retrieve from variables
	public function show_user_info( $uid) {

		$user_array=array(
			':uid'          =>$uid
		);
		try{

			$sql="SELECT * FROM db_user WHERE uid=:uid";
			//$userdetails= new User();
			$st = $this->db_connection_handle->prepare( $sql );
			$st->setFetchMode( PDO::FETCH_ASSOC );
			$st->execute( $user_array );
			$row = $st->fetch();
			
			return $row;
		}
		catch ( PDOException $e ) {
			return $e->getMessage();

		}
	}

public function show_user_info_by_name( $username) {

		$user_array=array(
			':username'          =>$username
		);
		try{

			$sql="SELECT * FROM db_user WHERE username=:username";
			//$userdetails= new User();
			$st = $this->db_connection_handle->prepare( $sql );
			$st->setFetchMode( PDO::FETCH_ASSOC );
			$st->execute( $user_array );
			$row = $st->fetch();
			
			return $row;
		}
		catch ( PDOException $e ) {
			return $e->getMessage();

		}
	}

	//succeed: return a dataset(2D-array)
	//else return a error string
	public function show_all_user_info( $offset, $pagesize ) {

		try{


			$sql='SELECT * FROM db_user LIMIT :offset,:pagesize';
			//$userdetails= new User();
			$st = $this->db_connection_handle->prepare( $sql );
			$st->bindParam( ':offset', $offset, PDO::PARAM_INT );
			$st->bindParam( ':pagesize', $pagesize, PDO::PARAM_INT );
			$st->execute();
			$st->setFetchMode( PDO::FETCH_ASSOC );
			$result=array();


			while ( $row = $st->fetch() ) {
				array_push( $result, $row );
			}
			return $result;
		}


		catch ( PDOException $e ) {
			return $e->getMessage();

		}


	}


	public function check_user_account( $username, $userpass ) {

		$userpass = sha1($userpass);
		$user_array = array( ':username' => $username );
		$sql = 'SELECT userpass FROM db_user WHERE username=:username';

		try
		{
			$st = $this->db_connection_handle->prepare( $sql );
			$st->execute( $user_array );
			$st->setFetchMode( PDO::FETCH_ASSOC );
			$row = $st->fetch();

			if ( strcmp( $row['userpass'], $userpass ) == 0 )
				return TRUE;
			else return FALSE;
		}
		catch ( PDOException $e ) {
			return $e->getMessage();
		}



	}
        
        
        public function check_user_status($username){
            $user_array = array( ':username' => $username );
		$sql = 'SELECT status FROM db_user WHERE username=:username';

		try
		{
			$st = $this->db_connection_handle->prepare( $sql );
			$st->execute( $user_array );
			$st->setFetchMode( PDO::FETCH_ASSOC );
			$row = $st->fetch();

			if ( $row['status']  == 1 )
				return TRUE;
			else return FALSE;
		}
		catch ( PDOException $e ) {
			return $e->getMessage();
		}
            
        }
        
        
       public function check_user_name_and_email($username,$email){
            $user_array = array( ':username' => $username,':email' => $email );
            $sql = 'SELECT * FROM db_user WHERE username=:username or email=:email';
            try
		{
			$st = $this->db_connection_handle->prepare( $sql );
			$st->execute( $user_array );
			//$st->setFetchMode( PDO::FETCH_ASSOC );
			$count = $st->rowCount();

			if($count==0) return TRUE;
                        else return FALSE;
		}
		catch ( PDOException $e ) {
			return $e->getMessage();
		}
            
            
        }
         public function isMatch_user_name_and_email($username,$email){
            $user_array = array( ':username' => $username );
            $sql = 'SELECT email FROM db_user WHERE username=:username';
             try
		{
			$st = $this->db_connection_handle->prepare( $sql );
			$st->execute( $user_array );
			$st->setFetchMode( PDO::FETCH_ASSOC );
			$row = $st->fetch();
			if(strcmp( $row['email'],$email)!= 0) return FALSE;
                        else return TRUE;      
		}
		catch ( PDOException $e ) {
			return $e->getMessage();
		}
            
            
        }
        
        public function check_user_name($username){
            $user_array = array( ':username' => $username );
            $sql = 'SELECT * FROM db_user WHERE username=:username';
            try
		{
			$st = $this->db_connection_handle->prepare( $sql );
			$st->execute( $user_array );
			//$st->setFetchMode( PDO::FETCH_ASSOC );
			$count = $st->rowCount();

			if($count==0) return TRUE;
                        else return FALSE;
		}
		catch ( PDOException $e ) {
			return $e->getMessage();
		}
            
            
        }
        
	public function active_user_account (User $account) {
             $user_array = array( ':username' => $account->username );
            $sql = 'SELECT status,identifier,expiry_time,email FROM db_user WHERE username=:username';
            try
		{
			$st = $this->db_connection_handle->prepare( $sql );
			$st->execute( $user_array );
			$st->setFetchMode( PDO::FETCH_ASSOC );
			$row = $st->fetch();
                        
                      
                        $account->email=$row['email'];
                        $identifier=$account->identifier;
                        
                        

			if ( $row['status']  == 1 )
				return 0;
			else if(strcmp( $row['identifier'],$identifier)!= 0)
                                return 1;
                        $d1 = new DateTime($row['expiry_time']);
                        $d2 = new DateTime(date("Y-m-d H:i:s"));
                        if($d1<$d2) return 2; 
//                        var_dump($d1 < $d2);
                        else return 3;
                        

                        
		}
		catch ( PDOException $e ) {
			return $e->getMessage();
		}
            
            
        }
        
        public function complete_activation ($username){
            $user_array=array(
			':username'     =>$username
		);
                
                        
		try{

                        

$sql="UPDATE db_user SET status=1,identifier=NULL,expiry_time=NULL WHERE username=:username";


			$st = $this->db_connection_handle->prepare( $sql );

			$result = $st->execute( $user_array );
                        
			return $result;
		}
		catch ( PDOException $e ) {
			return $e->getMessage();

		}
	}
            
        
        public function regenerate_activation($username,$identifier){
            $user_array=array(
			':username'     =>$username,
                        ':identifier'   =>$identifier
		);
                
                        
		try{

                        

            $sql="UPDATE db_user SET identifier=:identifier,expiry_time=NOW()+INTERVAL 1 DAY WHERE username=:username";


			$st = $this->db_connection_handle->prepare( $sql );

			$result = $st->execute( $user_array );
                        
			return $result;
		}
		catch ( PDOException $e ) {
			return $e->getMessage();

		}
            
        }
	//public function set_db_access(){}
	//public function delete_db_access(){}
	public function show_single_user_access_and_uid($username){
             $user_array = array( ':username' => $username );

            try{


			$sql='SELECT accessid,uid FROM db_user where username=:username';
		
			$st = $this->db_connection_handle->prepare( $sql );
			$st->execute( $user_array );
			$st->setFetchMode( PDO::FETCH_ASSOC );
			



			$row = $st->fetch();

			return $row;
                        
		}


		catch ( PDOException $e ) {
			return $e->getMessage();

		}
            
        }
	//public function show_all_access(){}
	//
	public function show_corresponding_access( $accessid ) {
		
	try{


			$sql='SELECT * FROM db_access where accessid=:accessid';
		
			$st = $this->db_connection_handle->prepare( $sql );
                        $st->bindParam( ':accessid', $accessid, PDO::PARAM_INT );
			$st->execute();
			$st->setFetchMode( PDO::FETCH_ASSOC );



			$row = $st->fetch();

			return $row;
		}


		catch ( PDOException $e ) {
			return $e->getMessage();

		}
               


	}
	//
        function update_user_info_when_login($username){
            $user_array=array(
			':username'     =>$username);        
            
            
            
            try{

                        

                        $sql="UPDATE db_user SET lastlogin=now() WHERE username=:username";

			$st = $this->db_connection_handle->prepare( $sql );

			$result = $st->execute( $user_array );
                        
			return $result;
		}
		catch ( PDOException $e ) {
			return $e->getMessage();

		}
                }
                
                public function get_user_email_by_username( $username ) {
		

                    $user_array = array( ':username' => $username );
		

		
                 
		try{


			$sql='SELECT email FROM db_user where username=:username';
		
			$st = $this->db_connection_handle->prepare( $sql );
			$st->execute( $user_array );
			$st->setFetchMode( PDO::FETCH_ASSOC );
			$row = $st->fetch();
                        
			return $row['email'];
		}


		catch ( PDOException $e ) {
			return $e->getMessage();

		}
               


	}
        
        function get_name_by_uid($uid){
            try{


			$sql='SELECT username FROM db_user where uid=:uid';
		
			$st = $this->db_connection_handle->prepare( $sql );
                        $st->bindParam( ':uid', $uid, PDO::PARAM_INT );
			$st->execute();
			$st->setFetchMode( PDO::FETCH_ASSOC );



			$row = $st->fetch();

			return $row['username'];
		}


		catch ( PDOException $e ) {
			return $e->getMessage();

		}
            
        }
        
         function get_uid_by_name($username){
            
            $user_array = array( ':username' => $username );

            try{


			$sql='SELECT uid FROM db_user where username=:username';
		
			$st = $this->db_connection_handle->prepare( $sql );
                       // $st->bindParam( ':username', $uid, PDO::PARAM_STRING );
			$st->execute($user_array);
			$st->setFetchMode( PDO::FETCH_ASSOC );
			



			$row = $st->fetch();
                      // var_dump($row['uid']);

			return $row['uid'];
		}


		catch ( PDOException $e ) {
			return $e->getMessage();

		}
            
        }
                
      public function show_user_access_list() {

		try{


			$sql='SELECT * FROM db_access';
			//$userdetails= new User();
			$st = $this->db_connection_handle->prepare( $sql );
			$st->execute();
			$st->setFetchMode( PDO::FETCH_ASSOC );
			$result=array();


			while ( $row = $st->fetch() ) {
				array_push( $result, $row );
			}
			return $result;
		}


		catch ( PDOException $e ) {
			return $e->getMessage();

		}


	}  
          public function get_num_of_users(){
         try{
            $sql='SELECT COUNT( * ) FROM  db_user';
            $st = $this->db_connection_handle->prepare( $sql );
            $st->execute();
            $st->setFetchMode(PDO::FETCH_NUM);
            $result=$st->fetch();
            return $result;
        }

        catch( PDOException $e ) {
            return $e->getMessage();
         }
     }
                
   public function check_email_integrity($uid,$email){
            $user_array = array( ':email' => $email );
            $sql = 'SELECT uid FROM db_user WHERE email=:email';
            try
		{
			$st = $this->db_connection_handle->prepare( $sql );
			$st->execute( $user_array );
			$st->setFetchMode( PDO::FETCH_ASSOC );
			$result=$st->fetch();

			if($result['uid']==$uid||empty($result)) return TRUE;
                        else return FALSE;
		}
		catch ( PDOException $e ) {
			return $e->getMessage();
		}
            
            
        }

}
?>