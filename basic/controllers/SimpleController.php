<?php

namespace app\controllers;

use yii\web\Controller;

class SimpleController extends Controller
{
    public $enableCsrfValidation = false;
	//非法登录
	public function init(){
        parent::init();
        $session =\YII::$app->session;
        $arr=$session->has('user');
//        var_dump($arr);die;
//        if(isset($arr)){
//        if(empty($arr)){
        //判断是否为空empty()只检测变量，检测任何非变量的东西都将导致解析错误。
        //if(is_null($arr)){
        if($arr==''){
            $this->redirect(array('/site/index'));
        }
    }
    //首页展示
    public function actionShow()
    {
        $session =\YII::$app->session;
        $name=$session->get('user');
        return $this->renderPartial('index.html',[
            'name'=>$name,
        ]);
    }
    //添加
    public function actionAdd()
    {
        $session =\YII::$app->session;
        $name=$session->get('user');
        return $this->renderPartial('compose.html',[
            'name'=>$name,
        ]);
    }
    //增add
	public function actionAdd2(){
		// print_r($_SERVER);die;
		$session=\YII::$app->session;
		$request=\YII::$app->request;
		$arr=$request->post();
		$arr['apptoken']=md5(rand(1000,9999));//token
		$arr['appkey']=$this->actionkey(5);//appkey唯一标示
		$arr['uid']=$session->get('id');//用户id
	    //路径拼写 $uri=/app/basic/web  $arr['appuel']=http://localhost/app/basic/web/weChat.php?str=$appkey
		$uri=substr($_SERVER['REQUEST_URI'],0,strpos($_SERVER['REQUEST_URI'],'index.php')-1);
		$arr['appurl']='http://'.$_SERVER['HTTP_HOST'].$uri.'/weChat.php?str='.$arr['appkey'];
		// print_r($arr['appurl']);die;
		//添加入库
		$db=\Yii::$app->db;
		$ar=$db->createCommand()->insert('appmsg',$arr)->execute();
			if(!empty($ar)){
			 $this->redirect(array('/simple/list'));
		    }else{
		     echo "<script>alert('添加失败');window.history.go(-1);</script>";
		    }
	}
	//actionkey生成唯一标示
	public function actionkey($length){
		$str="abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$randStr='';
		$len=strlen($str)-1;
	    for($i=0;$i<$length;$i++){
		    $num=rand(0,$len);
			$randStr.=$str[$num];
	    }
		return $randStr;
	}
	//列表
	public function actionList(){
        $session =\YII::$app->session;
        $db =\YII::$app->db;
		$id=$session->get('id');
		$arr=$db->createCommand("select * from appmsg where uid='$id'")->queryAll();
        //print_r($arr);die;
        $name=$session->get('user');
        return $this->renderPartial('list', [
            'name'=>$name,
            'list' => $arr,
        ]);
	}
	//删除 完善时用ajax删除
	public function actionDelete(){
		
		$id = \Yii::$app->request->get('id');
        // $sql="delete from appmsg where 'aid='.$id";
        $re = \Yii::$app->db->createCommand()->delete('appmsg',['aid'=>$id])->execute();
        if($re){
			// echo "ok";die;
			 $this->redirect(array('/simple/list'));
        }else{
            echo "<script>alert('删除失败');window.history.go(-1);</script>";
        }
	}
	//修改 action1
	public function actionUpdate(){
        $request=\Yii::$app->request;
        $id=$request->get('id');
        $db=\Yii::$app->db;
		$arr=$db->createCommand("select * from appmsg where aid='$id'")->queryAll();
        print_r($arr);die;
        $session =\Yii::$app->session;
        $name=$session->get('user');
        return $this->renderPartial('update',[
            'name'=>$name,
            'arr' =>$arr,
        ]);
	}
	//修改 action2  *未完成*
	public function actionUpdate_pro(){
        $request=\Yii::$app->request;
		 $id = $request->post('id');
//         $user_name = $request->post('a_name');
         $name = $request->post('name');
         $appId = $request->post('appId');
         $appSecret = $request->post('appSecret');
         $test=Number::find()->where(['id'=>$id])->one();
        $test->name=$name;
        $test->appId=$appId;
        $test->appSecret=$appSecret;
        $res=$test->save();
        if($res){
            $this->redirect(array('simple/list'));
        }else{
            echo "<script>alert('修改失败');window.history.go(-1);</script>";
        }
    }
}


