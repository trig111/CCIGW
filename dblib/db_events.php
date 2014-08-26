<?php

/*****************************
NOTES
 * EVENTS RELATED DB OPERATIONS
 * USUALLY PARAMATER IS AN OBJECT,BE SURE YOU RESET THE OBJECT BEFORE NEXT INVOKE
 * $XXXX->EXECUATE() RETURN A BOOL TYPE
******************************/

require_once 'config.php';
require_once 'events.class.php';
require_once 'eventsreginfo.class.php';

class Db_events {
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





    public function post_events( Events $newevents ) {

        $events_array=array(
            //':eventsid' =>$newevents->eventsid,
           
            ':subject'      =>$newevents->subject,
            ':readaccess'   =>$newevents->readaccess,
            ':body'         =>$newevents->body,
            ':categoryid'   =>$newevents->categoryid,
            //':createtime' =>$newevents->createtime,
            ':uid'          =>$newevents->uid,
            ':startime'     =>$newevents->startime,
            ':endtime'      =>$newevents->endtime,
            ':maxmember'    =>$newevents->maxmember
            //':lastedit'   =>$newevents->lastedit
        );
        try{
            $sql ="INSERT INTO db_events (`subject`, `readaccess`, `body`, `categoryid`, `createtime`, `uid`, `startime`, `endtime`, `maxmember`, `lastedit`) VALUES (:subject,:readaccess,:body,:categoryid,now(),:uid,:startime,:endtime,:maxmember,NULL)";


            $st = $this->db_connection_handle->prepare( $sql );

            $result = $st->execute( $events_array );
            
            return $result;
        }
        catch ( PDOexception $e ) {
            return $e->getMessage();

        }
    }
    //
    //
    //
    //
    //
    //
    //
    //
    public function delete_events( $eventsdelete ) {
        $events_array=array(
            ':eventsid'          =>$eventsdelete
        );

        try{
            $sql= "DELETE FROM db_events WHERE eventsid=:eventsid";

            $st = $this->db_connection_handle->prepare( $sql );

            $result = $st->execute( $events_array );

            return $result;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }
    }
    //
    //
    //
    //
    //
    //
    //
    public function update_events( Events $eventsdata ) {


        $evets_array=array(
            ':eventsid' =>$eventsdata->eventsid,
            ':subject'=>$eventsdata->subject,
            ':readaccess' =>$eventsdata->readaccess,
            ':body'=>$eventsdata->body,
            ':categoryid' =>$eventsdata->categoryid,
            ':createtime' =>$eventsdata->createtime,
            ':uid' =>$eventsdata->uid,
            ':startime' =>$eventsdata->startime,
            ':endtime' =>$eventsdata->endtime,
            ':maxmember' =>$eventsdata->maxmember,
            //':lastedit'=>$eventsdata->lastedit
        );
        try{



            $sql="UPDATE db_events SET subject=:subject,readaccess=:readaccess,body=:body,categoryid=:categoryid,createtime=:createtime,uid=:uid,startime=:startime,endtime=:endtime,maxmember=:maxmember,lastedit=now() WHERE eventsid=:eventsid";


            $st = $this->db_connection_handle->prepare( $sql );

            $result = $st->execute( $evets_array );

            return $result;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }
    }




    //
    //
    //
    //
    //function show_event_list(){}
    //
    //
    //
    //function show_single_event(){}
    //
    //
    //
    //
    public function add_reply( Events $replydata ) {

        $evets_array=array(
            //':eventsreplyid' =>$eventsdata->Geteventsreply('eventsreplyid'),
            ':eventsid'=>$replydata->Geteventsreply('eventsid'),
            ':body'=>$replydata->Geteventsreply( 'body' ),
            ':uid' =>$replydata->Geteventsreply( 'uid' ),
            //':replytime' =>$replydata->Geteventsreply( 'replytime' )
            //':lastedit'=>$eventsdata->Geteventsreply('eventsreplyid')
        );

        try{

            $sql= "INSERT INTO db_evtreply (eventsid,body,uid,replytime,lastedit) VALUES (:eventsid,:body,:uid,now(),NULL)";
            $st = $this->db_connection_handle->prepare( $sql );

            $result = $st->execute( $evets_array );

            return $result;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }



    }



    public function delete_reply( Events $replydelete ) {

        $evets_array=array(
            ':eventsreplyid' =>$replydelete->Geteventsreply( 'eventsreplyid' )
            //
        );

        try{
            $sql= "DELETE FROM db_evtreply WHERE eventsreplyid=:eventsreplyid";


            $st = $this->db_connection_handle->prepare( $sql );

            $result = $st->execute( $evets_array );

            return $result;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }
    }
    //
    //
    //

    public function update_reply( Events $eventsupdate ) {
        $evets_array=array(
            ':eventsreplyid' =>$eventsupdate->Geteventsreply( 'eventsreplyid' ),
            ':eventsid'=>$eventsupdate->Geteventsreply( 'eventsid' ),
            ':body'=>$eventsupdate->Geteventsreply( 'body' ),
            ':uid' =>$eventsupdate->Geteventsreply( 'uid' ),
            ':replytime' =>$eventsupdate->Geteventsreply( 'replytime' )
            //':lastedit'=>$eventsdata->Geteventsreply('eventsreplyid')
        );



        try{




            $sql="UPDATE db_evtreply SET eventsid=:eventsid,body=:body,uid=:uid,replytime=:replytime,lastedit=now() WHERE eventsreplyid=:eventsreplyid";

            $st = $this->db_connection_handle->prepare( $sql );

            $result = $st->execute( $evets_array );

            return $result;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }
    }





    //
    //
    //function show_replies(){}




    function register_event( Eventsreginfo $eventsreg ) {
        $evets_array=array(

            //':regid'=>$eventsreg->regid,
            ':eventsid'=>$eventsreg->eventsid,
            ':uid'=>$eventsreg->uid,
            //':registertime'=>$eventsreg->registertime,
            ':numberofpeople'=>$eventsreg->numberofpeople,
            ':price'=>$eventsreg->price,
            ':remarks'=>$eventsreg->remarks,
            //':lastedit'=>$eventsreg->lastedit
        );

        try{

            $sql= "INSERT INTO db_regevt (`eventsid`, `uid`, `registertime`, `numberofpeople`, `price`, `remarks`, `lastedit`) VALUES (:eventsid,:uid,now(),:numberofpeople,:price,:remarks,NULL)";
            $st = $this->db_connection_handle->prepare( $sql );

            $result = $st->execute( $evets_array );

            return $result;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }





    }



    function update_registration( Eventsreginfo $eventsreg ) {

        $evets_array=array(

            ':regid'=>$eventsreg->regid,
            ':eventsid'=>$eventsreg->eventsid,
            ':uid'=>$eventsreg->uid,
            ':registertime'=>$eventsreg->registertime,
            ':numberofpeople'=>$eventsreg->numberofpeople,
            ':price'=>$eventsreg->price,
            ':remarks'=>$eventsreg->remarks
            //':lastedit'=>$eventsreg->lastedit
        );





        try{




            $sql="UPDATE db_regevt SET eventsid=:eventsid,uid=:uid,registertime=:registertime,numberofpeople=:numberofpeople,price=:price,remarks=remarks,lastedit=now() WHERE regid=:regid";

            $st = $this->db_connection_handle->prepare( $sql );

            $result = $st->execute( $evets_array );

            return $result;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }

    }





    //
    //
    function cancel_register( Eventsreginfo $eventsreg ) {
        $evets_array=array(
            ':regid' =>$eventsreg->regid
            //
        );

        try{
            $sql= "DELETE FROM db_regevt WHERE regid=:regid";


            $st = $this->db_connection_handle->prepare( $sql );

            $result = $st->execute( $evets_array );

            return $result;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }



    }

    //
    //
    //
    //may edited later based on the view and controller
    public function show_events_list( $offset, $pagesize ) {




        try{


            $sql='SELECT * FROM db_events LIMIT :offset,:pagesize';
           
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
    
   
    public function admin_show_events_list( $offset, $pagesize ) {




        try{
           $sql='SELECT eventsid,categoryname,subject,username,readaccess,maxmember,createtime,lastedit FROM db_events,db_user,id_category WHERE db_events.uid=db_user.uid and db_events.categoryid=id_category.categoryid LIMIT :offset,:pagesize';
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
    
    //
    //
    //
    public function show_single_event( $eventsid ) {

        $user_array=array(
            ':eventsid'          =>$eventsid
        );
        try{

            $sql="SELECT * FROM db_events WHERE eventsid=:eventsid";
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

    //
    //
    //
    public function show_single_register( $regid ) {

//        $user_array=array(
//            ':$regid'          =>$regid
//        );
        try{

            $sql="SELECT * FROM db_regevt WHERE regid=:regid";
            //$userdetails= new User();
            $st = $this->db_connection_handle->prepare( $sql );
             $st->bindParam( ':regid', $regid, PDO::PARAM_INT );
            $st->setFetchMode( PDO::FETCH_ASSOC );
            $st->execute();
            $row = $st->fetch();

            return $row;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }


    }

    //
    //
    //
    public function show_register_list( $offset, $pagesize ) {




        try{


            $sql='SELECT * FROM db_regevt LIMIT :offset,:pagesize';
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

    //
    //
    //
    public function show_corresponding_reply( $eventsid ) {


//        $user_array=array(
//            ':$eventsid'          =>(int)$eventsid
//        );
        try{


            $sql='SELECT * FROM db_evtreply where eventsid=:eventsid';
            //$userdetails= new User();
            $st = $this->db_connection_handle->prepare( $sql );
            $st->bindParam( ':eventsid', $eventsid, PDO::PARAM_INT );
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

    //
    //
    //
    public function show_corresponding_category( $categoryid ) {

        $user_array=array(
            ':categoryid'          =>$categoryid
        );

        try{

            $sql="SELECT categoryname FROM id_category WHERE categoryid=:categoryid";

            $st = $this->db_connection_handle->prepare( $sql );
            $st->setFetchMode( PDO::FETCH_ASSOC );
            $st->execute( $user_array );
            $row = $st->fetch();

            return $row['categoryname'];
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }

    }
    public function add_category( Events $categoryinfo ) {


        $evets_array=array(


            //':categoryid'=>$categoryinfo->Geteventscategory('categoryid'),
            ':categoryname'=>$categoryinfo->Geteventscategory( 'categoryname' )

        );

        try{

            $sql= "INSERT INTO id_category(`categoryname`) VALUES (:categoryname)";
            $st = $this->db_connection_handle->prepare( $sql );

            $result = $st->execute( $evets_array );

            return $result;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }



    }
    public function update_category( Events $categoryinfo ) {

        $evets_array=array(


            ':categoryid'=>$categoryinfo->Geteventscategory( 'categoryid' ),
            ':categoryname'=>$categoryinfo->Geteventscategory( 'categoryname' )

        );






        try{




            $sql="UPDATE id_category SET categoryname=:categoryname WHERE categoryid=:categoryid";

            $st = $this->db_connection_handle->prepare( $sql );

            $result = $st->execute( $evets_array );

            return $result;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }

    }

    public function delete_category( Events $categoryinfo ) {
        $evets_array=array(


            ':categoryid'=>$categoryinfo->Geteventscategory( 'categoryid' )
            //':categoryname'=>$categoryinfo->Geteventscategory('categoryname')

        );

        try{
            $sql= "DELETE FROM id_category WHERE categoryid=:categoryid";


            $st = $this->db_connection_handle->prepare( $sql );

            $result = $st->execute( $evets_array );

            return $result;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }
    }

 public function show_category_list() {

     try{


            $sql='SELECT * FROM id_category';
           
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
}
?>
