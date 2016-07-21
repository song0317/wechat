<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * session 入 数据库
 */
class Session extends Model
{

    public function __construct()
    {
        ini_set("session.save_handler","user");
        //session.gc_probability = 1 分子
        ini_set("session.gc_probability",1);
        //session.gc_divisor = 1000 分母
        ini_set("session.gc_divisor",2);
        //session.gc_maxlifetime = 1440 垃圾回收时间，session有效期
        session_set_save_handler( "open","close","read","write","destroy","gc" );
    }


    //连接数据库
    public static function open(){
        @$link = mysql_connect('127.0.0.1', 'root', 'root');
        mysql_query('set names utf8');
        mysql_query('use session');
    }

    public static function close(){
        mysql_close();
    }


    public static function read($sess_id){
        $sql = "select session_data from `session` where session_id = '$sess_id'";
        $rows = \Yii::$app->db->createCommand($sql)->queryOne();
//        $result = mysql_query($sql);
        if(!empty($rows)){
			
            return $rows['session_data']; }
        else{
            return '';
        }
    }


    public static function write($sess_id,$sess_data){
        $sql = "insert into `session` (session_id,session_data,session_time) values('$sess_id','$sess_data', now()) on duplicate key update session_data = '$sess_data' , session_time = now()";  //这是为了gc()
        $bool = \Yii::$app->db->createCommand($sql)->execute();;
        return $bool; 
//        return mysql_query($sql);
    }


    public static function destroy($sess_id){
//        echo __FUNCTION__;
        $sql = "delete from `session` where session_id = '$sess_id'";
        $bool = \Yii::$app->db->createCommand($sql)->execute();
        return $bool;
//        return mysql_query($sql);
    }


    public static function gc($sess_id){
        $maxlifetime = ini_set("session.gc_maxlifetime",1200);
//        echo __FUNCTION__;
        $sql = "delete from `session` where now()-session_time > '$maxlifetime' ";
        $bool = \Yii::$app->db->createCommand($sql)->execute();;
        return $bool;
//        return mysql_query($sql);
    }
}
?>