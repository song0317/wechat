<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Session;

class SiteController extends Controller
{
    public $enableCsrfValidation = false;//禁止POST传值

	//加载登录页面
    public function actionIndex()
    {
        $session=\Yii::$app->session;
		$name=$session->get('user');
	if(!empty($name)){
		return $this->redirect('index.php?r=simple/show');
	}else{
		return $this->renderPartial('index');
	}
        
    }
	//执行登录
    public function actionLogin()
    {
        $request=\YII::$app->request;
        $arr=$request->post();
		
		//判断是否有传值
	if(empty($arr)){
		return $this->actionLogin();
	}else{
		//用户名,密码
		$db=\Yii::$app->db;
	    $username=$arr['username'];
		$pass=md5($arr['pass']);
		// print_r($pass);die;
	    $sql="SELECT u_id FROM users WHERE u_name='$username' AND u_password='$pass'";
        $id=$db->createCommand($sql)->queryOne();
	    // var_dump($id);die;
		//sessiom入库
	if(!empty($id)){
		//echo 123;die;
        $session=\Yii::$app->session;
		$name=$session->get('user');
	   if(!$name){
		$session->open();//开启session
        Session::write(session_id(),$username);//sessiom入库
		$session->set('user',$username);//session记录user
	    $session->set('id',$id['u_id']);//session记录id
	   }
	   $this->redirect('index.php?r=simple/show');
	}else{
		//echo '验证失败';die;
        return $this->actionIndex();
	}
	}
    
    }
	//用户注册
	public function register(){
       $request=\Yii::$app->request;
	   $arr=$request->post();
	   if($arr){
		echo "this is no access for register!!";
	  }
	}
	//退出登录
    public function actionLogout()
    {
        $session =\Yii::$app->session;
        $name=$session->get('user');
        if($name){
            // $session->remove('user');
            $session->destroy();
            $this->redirect(array('site/index'));
        }else{
            $this->redirect(array('/simple/show'));
        }
    }

}


