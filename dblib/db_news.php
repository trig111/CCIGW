<?php
require_once 'config.php';
require_once 'news.class.php';
/*****************************
NOTES
 * NEWS RELATED DB OPERATIONS
 * USUALLY PARAMATER IS AN OBJECT,BE SURE YOU RESET THE OBJECT BEFORE NEXT INVOKE
 * $XXXX->EXECUATE() RETURN A BOOL TYPE
******************************/

class Db_news {
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
    public function post_news( News $newevents ) {



        $events_array=array(
            //':newsid' =>$newevents->newsid,
            ':uid' =>$newevents->uid,
            ':readaccess' =>$newevents->readaccess,
            ':subject'=>$newevents->subject,
            //':createtime' =>$newevents->createtime,
            ':body'=>$newevents->body,
            ':categoryid' =>$newevents->categoryid

            //':lastedit'=>$newevents->lastedit
        );
        try{
            $sql ="INSERT INTO db_news(`uid`, `readaccess`, `subject`, `createtime`, `body`, `categoryid`, `lastedit`) VALUES (:uid,:readaccess,:subject,now(),:body,:categoryid,NULL)";


            $st = $this->db_connection_handle->prepare( $sql );

            $result = $st->execute( $events_array );

            return $result;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }
    }

    public function update_news( News $newevents ) {



        $events_array=array(
            ':newsid' =>$newevents->newsid,
            ':uid' =>$newevents->uid,
            ':readaccess' =>$newevents->readaccess,
            ':subject'=>$newevents->subject,
            //':createtime' =>$newevents->createtime,
            ':body'=>$newevents->body,
            ':categoryid' =>$newevents->categoryid

            //':lastedit'=>$newevents->lastedit
        );
        try{


            $sql="UPDATE db_news SET uid=:uid,readaccess=:readaccess,subject=:subject,body=:body,categoryid=:categoryid,lastedit=now() WHERE newsid=:newsid";


            $st = $this->db_connection_handle->prepare( $sql );

            $result = $st->execute( $events_array );

            return $result;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }


    }

    public function delete_news( News $newevents ) {


        $events_array=array(
            ':newsid'          =>$newevents->newsid
        );

        try{
            $sql= "DELETE FROM db_news WHERE newsid=:newsid";

            $st = $this->db_connection_handle->prepare( $sql );

            $result = $st->execute( $events_array );

            return $result;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }
    }
    public function show_single_news( $newsid ) {



//        $user_array=array(
//            ':$newsid'          =>$newsid
//        );
        try{

            $sql="SELECT newsid,subject,db_news.categoryid as categoryid,categoryname,readaccess, body,createtime,db_news.uid as uid,username,lastedit FROM db_news,db_user,id_category WHERE newsid=:newsid and db_news.uid=db_user.uid and id_category.categoryid=db_news.categoryid";
            //$userdetails= new User();
            $st = $this->db_connection_handle->prepare( $sql );
            $st->bindParam( ':newsid', $newsid, PDO::PARAM_INT );
            $st->setFetchMode( PDO::FETCH_ASSOC );
            $st->execute();
            $row = $st->fetch();

            return $row;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }
    }

    public function client_show_news_list( $offset, $pagesize ) {



        try{


            $sql='SELECT newsid FROM db_news LIMIT :offset,:pagesize';

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

    public function get_num_of_news(){
         try{
            $sql='SELECT COUNT( * ) FROM  db_news';
            $st = $this->db_connection_handle->prepare( $sql );
            $st->execute();
            $st->setFetchMode(PDO::FETCH_NUM);
            $result=$st->fetch();
            return $result[0];
        }

        catch( PDOException $e ) {
            return $e->getMessage();
         }
     }
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

            return $row;
        }
        catch ( PDOException $e ) {
            return $e->getMessage();

        }

    }
}
