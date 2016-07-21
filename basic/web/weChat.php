<?php
header('content-type:text/html;charset=utf-8');
/**
 * wechat php test
 */
$str=$_GET['str'];
//$str = "XjuwK";
//链接pdo
include_once("./pdo.php");
$pdo->query("set names utf8");


//查询用户数据
$data = $pdo->query("SELECT apptoken,aid FROM appmsg where appkey='$str'")->fetch();
//print_r($data);die;

//$keyword="你好";

define("ID","$data[aid]");
define("TOKEN", "$data[apptoken]");
//$setmsg = $pdo->query("SELECT setmsg FROM replymsg WHERE getmsg='".$keyword."'AND aid=".ID)->fetch();
//print_r($setmsg);die;


//define your token

$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid($pdo);
//$memcache = \Yii::$app->cache;//开启memcache 缓存
//$memcache->flush();die;
class wechatCallbackapiTest
{
    public function valid($pdo)
    {
        $echoStr = $_GET["echostr"];
        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            $this->responseMsg($pdo);//开启自动回复
            exit;
        }
    }

    public function responseMsg($pdo)
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];


        //extract post data
        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            if(!empty( $keyword ))
            {
				
                $memcache = \Yii::$app->cache;//开启memcache 缓存
				//$memcache->flush();die;
				$key = $memcache->get("$keyword".'_'.ID);//查询memcache中是否有关键字的回复
                if(empty($key)){
                    $setmsg = $pdo->query("SELECT setmsg FROM replymsg WHERE getmsg='$keyword' AND aid=".ID)->fetch();//从数据库中查询回复
                    $memcache->set("$keyword".'_'.ID,$setmsg['setmsg']);//将恢复内容写入memcache
					//echo $setmsg;die;
					if(!empyt($setmsg)){
						$contentStr = "$setmsg[setmsg]";
					}else{
						$contentStr = "你在说什么?";
					}
                }else{
					$contentStr = "$key";
				}
            
                $msgType = "text";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else{
                $msgType = "text";
                $contentStr = "您好! 欢迎您关注本微信号";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }

        }else {
            echo "";
            exit;
        }
    }

    private function checkSignature()
    {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}

?>