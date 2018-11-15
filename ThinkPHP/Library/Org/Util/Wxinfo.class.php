<?php 

namespace Org\Util;

class Wxinfo{
	public $APPID = "wx2b197950b3db1f2f";
    // public $APPID = "wx4702a1ff1d49ee42";
	// public $APPSECRET = '71d5c2e589f2331b74d7a444ab456876';
    public $APPSECRET = 'b97a00d70cdb3148fa5c5f907155000b ';
	public $MCHID = '1347727101';
    public $KEY = '8W0WSwqJF2923KH42AhgSD72IEWOUXUW';

	public function wx_user_info($openid){
        $access_token=$this->GetAccess_token();
        $access_token=json_decode($access_token,ture);
        $access_token=$access_token['access_token'];
        $url='https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        $userinfo=$this->https_request($url);
        return $userinfo;
    }

    public function GetAccess_token(){
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx2b197950b3db1f2f&secret=b97a00d70cdb3148fa5c5f907155000b';
        $access_token=$this->https_request($url);
        return $access_token;
    }

    public function GetOpenid() {
        // $MCHID = '1239486402';
        // $KEY = 'af8w3lYkfaGwd8fwlTe23kfAwefS8Ddf';
        // $SSLCERT_PATH = '../cert/apiclient_cert.pem';
        // $SSLKEY_PATH = '../cert/apiclient_key.pem';
        //通过code获得openid
        if (!isset($_GET['code'])){
            //触发微信返回code码
            $baseUrl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].$_SERVER['QUERY_STRING']);

            // $url = $this->__CreateOauthUrlForCode($baseUrl);
            import('ORG.util.WxPayConfig');
            $urlObj["appid"] = 'wx2b197950b3db1f2f';
            $urlObj["redirect_uri"] = "$baseUrl";
            $urlObj["response_type"] = "code";
            $urlObj["scope"] = "snsapi_base";
            $urlObj["state"] = "STATE"."#wechat_redirect";
            $bizString = $this->ToUrlParams($urlObj);
            $url= "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
            // $url="http://www.baidu.com";
            header('location:'.$url);
            // header('location: '.$url);
            // $this->redirect("https://open.weixin.qq.com/");
          
            exit();
        } else {
            //获取code码，以获取openid
            $code = $_GET['code'];
            $openid = $this->getOpenidFromMp($code);
            return $openid;
        }
    }


    public function ToUrlParams($result)
    {
        $buff = "";
        foreach ($result as $k => $v)
        {
            if($k != "sign" && $v != "" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
        }
        
        $buff = trim($buff, "&");
        return $buff;
    }

    public function GetOpenidFromMp($code)
    {
        $CURL_PROXY_HOST = "0.0.0.0";//"10.152.18.220";
        $CURL_PROXY_PORT = 0;//8080;
        $REPORT_LEVENL = 1;

        $url = $this->CreateOauthUrlForOpenid($code);
        //初始化curl
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOP_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if($CURL_PROXY_HOST != "0.0.0.0" 
            && $CURL_PROXY_PORT != 0){
            curl_setopt($ch,CURLOPT_PROXY, $CURL_PROXY_HOST);
            curl_setopt($ch,CURLOPT_PROXYPORT, $CURL_PROXY_PORT);
        }
        //运行curl，结果以jason形式返回
        $res = curl_exec($ch);
        curl_close($ch);
        //取出openid
        $data = json_decode($res,true);
        $this->data = $data;
        $openid = $data['openid'];
        return $openid;
    }


    private function CreateOauthUrlForOpenid($code)
    {
        $urlObj["appid"] ='wx2b197950b3db1f2f';
        $urlObj["secret"] = 'b97a00d70cdb3148fa5c5f907155000b';
        $urlObj["code"] = $code;
        $urlObj["grant_type"] = "authorization_code";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;
    }

    function https_request($url, $data = null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
     /*   $dataStr = "";
        if($data && is_array($data)) {
            foreach($data as $key => $value) {
                $dataStr .= "$key=$value";
            }
        }
        var_dump($dataStr);*/
     /*   if (class_exists('\CURLFile')) {
            curl_setopt($curl, CURLOPT_SAFE_UPLOAD, true);
        } else {
            if (defined('CURLOPT_SAFE_UPLOAD')) {
                curl_setopt($curl, CURLOPT_SAFE_UPLOAD, false);
            }
        }*/
        // curl_setopt($curl, CURLOPT_SAFE_UPLOAD, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        $output = curl_exec($curl);
        $http=curl_getinfo($curl);
        curl_close($curl);
        return $output;
    }
}