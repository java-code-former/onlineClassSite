<?php
function is_login() {
    $tel = cookie('admin_tel');
    $password = cookie('admin_password');
    $id = M('admin')->where(array('tel'=>$tel,'password'=>$password))->getField('id');
    if ($tel && $password && $id==1)
    {
        return $id;
    }
}

function is_member()
{
    $tel = cookie('tel');
    $pwd = cookie('pwd');
    $uid = M('user')->where(array('tel'=>$tel,'pwd'=>$pwd))->getField('uid');
    if ($tel && $pwd && $uid)
    {
        cookie('uid',$uid,3600*24*7);
        return $uid;
    }

}

function pay($uid,$oid,$cid,$price){
    // $uid,$oid,$cid,ordernum
    // echo $uid;
    // echo "---";
    // echo $oid;
    // echo "---";
    // echo $cid;
    // echo "---";
    // echo $price;
    // die;
    $coupon=M('coupon');
    $use_coupon=M('use_coupon');
    $order=M('order');
    //优惠券
    $money=$coupon->where('id="'.$cid.'"')->getField('money');
    $info=$use_coupon->where('ordernum="'.$oid.'"')->find();
    $order_price=$price-$money;
    $order_price="0.01";
    if($info){
        $use_coupon->where('ordernum="'.$oid.'"')->data(array('cid'=>$cid))->save();
    }else{
        $data=array(
            'uid'=>$uid,
            'ordernum'=>$oid,
            'cid'=>$cid,
            'state'=>'1',
            'usetime'=>time()
        );
        $use_coupon->add($data);
    }
    return $order_price;
}

function pay_success($oid){
    file_put_contents('log.txt', '1111');
    $use_coupon=M('use_coupon');
    $use_coupon->where('ordernum="'.$oid.'"')->setField('state','2');

}



/**
 * 过滤html代码
 * @param string $str
 * @return string
 */
function stripHTML($str, $filter = array())
{
    $str		= stripHTMLNoEnter($str, $filter);
    $search		= array("\r", "\n");
    $replace	= array('', '');
    $str 		= str_replace($search, $replace, $str);

    return $str;
}

function stripHTMLNoEnter($str, $filter = array())
{
    $str = trim($str, " \t\n\r\0\x0B");

    /*while(substr($str, -3) == '')
    {
        $user = substr($str, 0, -3);
    }*/

    $pattern = array(
        "'<script[^>]*?>.*?</script>'si",
        "'<javascript[^>]*?>.*?</javascript>'si",
        "'<style[^>]*?>.*?</style>'si",
        '/[\x00-\x08\x0b\x0c\x0e-\x1f]/'
    );
    $replace = array(
        "",
        "",
        "",
        ""
    );
    $str = preg_replace($pattern, $replace, $str);

    $search = array(
        "'",
        "\"",
        ",",
        //"\n",
        "\\",
        "%",
        "\xE2\x80\xAE",
        "\xE2\x81\xAB",
        "‫",
        "",
        "\xE0\xB8\x8F",
        "\xE0\xB9\x8E",
        "\xE0\xB8\xAA",
        "\xE0\xB9\x89",
        "\xE0\xB8\x94",
        "\xE0\xB9\x87",
    );
    $replace = array(
        '‘',
        '“',
        "，",
        //"",
        "、",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
    );
    if(isset($filter['search']) && is_array($filter['search']))
    {
        $search = array_merge($search, $filter['search']);
    }
    if(isset($filter['replace']) && is_array($filter['replace']))
    {
        $replace = array_merge($replace, $filter['replace']);
    }

    $str = str_replace($search, $replace, $str);

    $str = preg_replace('/[\x00-\x08\x0b\x0c\x0e-\x1f]/', '', $str);
    return htmlspecialchars($str);
}

//过滤掉javascript标签
function stripJavascript($str)
{
    $pattern = array(
        "'<script[^>]*?>.*?</script>'si",
        "'<javascript[^>]*?>.*?</javascript>'si",
        "'<style[^>]*?>.*?</style>'si",
        "'<script.*>'si",
        "'<javascript.*>'si",
        "'<style.*>'si",
    );
    $replace = array(
        "",
        "",
        "",
        "",
        "",
        "",
    );
    $str = preg_replace($pattern, $replace, $str);
    return $str;
}

function stripUserHtml($str)
{
    $filter = array();
    $filter['search'] = array(
        "",
        " ",
        "　",
        "	",
        "	",
        ":",
    );
    $filter['replace'] = array(
        "",
        "",
        "",
        "",
        "",
        "：",
    );

    return stripHTML($str, $filter);
}

/**
 * 计算字符长度，包括中文
 *
 * @param unknown_type $String
 * @return unknown
 */
function sysStrLen($String)
{
    $I = 0;
    $StringLast = array();
    $Length = strlen($String);
    while ( $I < $Length ) {
        $StringTMP = substr($String, $I, 1);
        if (ord($StringTMP) >= 224) {
            if ($I + 3 > $Length) {
                break;
            }
            $StringTMP = substr($String, $I, 3);
            $I = $I + 3;
        }
        elseif (ord($StringTMP) >= 192) {
            if ($I + 2 > $Length) {
                break;
            }
            $StringTMP = substr($String, $I, 2);
            $I = $I + 2;
        }
        else {
            $I = $I + 1;
        }
        $StringLast[] = $StringTMP;
    }

    return count($StringLast);
}

/**
 * 截断字符串
 *    - 支持中文
 *
 * @param string $string
 * @param int $Length       截断字符串长度
 * @parma bool $Append      是否要加 .
 *
 * @return string
 */
function subStrForAllEnc($String, $Length, $Append = false)
{
    if (strlen($String) <= $Length) {
        return $String;
    }
    else {
        $I = 0;
        $J = 0;
        $strLen = strlen($String);
        while ( $I < $Length && $J < $strLen ) {
            $StringTMP = substr($String, $J, 1);
            if (ord($StringTMP) >= 224) {
                if ($J + 3 > $strLen) {
                    break;
                }
                $StringTMP = substr($String, $J, 3);
                $J = $J + 3;
            }
            elseif (ord($StringTMP) >= 192) {
                if ($J + 2 > $strLen) {
                    break;
                }
                $StringTMP = substr($String, $J, 2);
                $J = $J + 2;
            }
            else {
                $J = $J + 1;
            }
            $StringLast[] = $StringTMP;
            $I++;
        }
        $StringLast = implode("", $StringLast);
        if ($StringLast != $String && $Append) {
            $StringLast .= "...";
        }
        return $StringLast;
    }
}
/**
 *
 * 分割字符串，代替内置的explode，去掉空元素
 * @param string $seperator
 * @param string $str
 */
function myExplode($seperator,$str){
    if(!$str) return array();
    else{
        $result=explode($seperator,$str);
        if(!$result)  return $result;
        $temp=array();
        for($i=0;$i<count($result);$i++){
            if($result[$i]=='') continue;
            $temp[]=$result[$i];
        }
        return $temp;
    }
}

function formatAlias($String)
{
    $start = 0;
    $strLeng = strlen($String);
    $str = '';
    while (1)
    {
        $StringTMP = substr($String, $start, 1);
        if(ord($StringTMP) >= 240)
        {
            $StringTMP = substr($String, $start, 4);
            $start += 4;
            continue;
        }elseif (ord($StringTMP) >= 224) //三个字节
        {
            $StringTMP = substr($String, $start, 3);
            $start += 3;
            if($start > $strLeng)
            {
                continue;
            }
        }elseif(ord($StringTMP) >= 192)
        {
            $StringTMP = substr($String, $start, 2);
            $start += 2;
        }
        else {
            $StringTMP = substr($String, $start, 1);
            $start += 1;
        }
        $str = $str.$StringTMP;
        if($StringTMP==''|| $start >= $strLeng)
        {
            break;
        }
    }
    return $str;
}
/**
 * 判断是否是utf-8字符编码
 * @param string $string
 */
function is_utf8($string) {
    // From [url=http://w3.org/International/questions/qa-forms-utf-8.html]http://w3.org/International/questions/qa-forms-utf-8.html[/url]
    return preg_match('%^(?:
[\x09\x0A\x0D\x20-\x7E] # ASCII
#| [\xC2-\xDF][\x80-\xBF] # non-overlong 2-byte  // ADD by zhangzhihua 为过滤“翻转字符”。带有附加符号的各国语言文字(拉丁文、希腊文、阿拉伯语等)由于“光标在前“保存后整个字体会发生翻转
| [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
| \xED[\x80-\x9F][\x80-\xBF] # excluding surrogates
| \xF0[\x90-\xBF][\x80-\xBF]{2} # planes 1-3
)*$%xs', $string);
}

/**
 * 本站不接受的utf-8的字符编码
 * @param string $string
 * @return number
 */
function is_utf8_deny($string){
    return preg_match('%(?:
\x7F
| [\xC2-\xDF]
| [\xCB-\xCD]
| \xD9
| [\xDB-\xDF]
| \xE0
| \xE1[\x81-\x82]
| \xE1\x85[\x9A-\xA0]
| \xE2[\x80-\x82]
| \xED[\xA0-\xBF]
| \xEF\xBF[\xB0-\xBF]  #FFF0-FFFF
| \xEF\xBB\xBF
)%xs', $string);
}



/* *
 * 支付宝接口公用函数
 * 详细：该类是请求、通知返回两个文件所调用的公用函数核心处理文件
 * 版本：3.3
 * 日期：2012-07-19
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
 */

/**
 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
 * @param $para 需要拼接的数组
 * return 拼接完成以后的字符串
 */
function createLinkstring($para) {
    $arg  = "";
    while (list ($key, $val) = each ($para)) {
        $arg.=$key."=".$val."&";
    }
    //去掉最后一个&字符
    $arg = substr($arg,0,count($arg)-2);

    //如果存在转义字符，那么去掉转义
    if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

    return $arg;
}
/**
 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串，并对字符串做urlencode编码
 * @param $para 需要拼接的数组
 * return 拼接完成以后的字符串
 */
function createLinkstringUrlencode($para) {
    $arg  = "";
    while (list ($key, $val) = each ($para)) {
        $arg.=$key."=".urlencode($val)."&";
    }
    //去掉最后一个&字符
    $arg = substr($arg,0,count($arg)-2);

    //如果存在转义字符，那么去掉转义
    if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

    return $arg;
}
/**
 * 除去数组中的空值和签名参数
 * @param $para 签名参数组
 * return 去掉空值与签名参数后的新签名参数组
 */
function paraFilter($para) {
    $para_filter = array();
    while (list ($key, $val) = each ($para)) {
        if($key == "sign" || $key == "sign_type" || $val == "")continue;
        else	$para_filter[$key] = $para[$key];
    }
    return $para_filter;
}
/**
 * 对数组排序
 * @param $para 排序前的数组
 * return 排序后的数组
 */
function argSort($para) {
    ksort($para);
    reset($para);
    return $para;
}
/**
 * 写日志，方便测试（看网站需求，也可以改成把记录存入数据库）
 * 注意：服务器需要开通fopen配置
 * @param $word 要写入日志里的文本内容 默认值：空值
 */
function logResult($word='') {
    $fp = fopen("log.txt","a");
    flock($fp, LOCK_EX) ;
    fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\n".$word."\n");
    flock($fp, LOCK_UN);
    fclose($fp);
}

/**
 * 远程获取数据，POST模式
 * 注意：
 * 1.使用Crul需要修改服务器中php.ini文件的设置，找到php_curl.dll去掉前面的";"就行了
 * 2.文件夹中cacert.pem是SSL证书请保证其路径有效，目前默认路径是：getcwd().'\\cacert.pem'
 * @param $url 指定URL完整路径地址
 * @param $cacert_url 指定当前工作目录绝对路径
 * @param $para 请求的数据
 * @param $input_charset 编码格式。默认值：空值
 * return 远程输出的数据
 */
function getHttpResponsePOST($url, $cacert_url, $para, $input_charset = '') {

    if (trim($input_charset) != '') {
        $url = $url."_input_charset=".$input_charset;
    }
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);//SSL证书认证
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);//严格认证
    curl_setopt($curl, CURLOPT_CAINFO,$cacert_url);//证书地址
    curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
    curl_setopt($curl,CURLOPT_POST,true); // post传输数据
    curl_setopt($curl,CURLOPT_POSTFIELDS,$para);// post传输数据
    $responseText = curl_exec($curl);
    //var_dump( curl_error($curl) );//如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
    curl_close($curl);

    return $responseText;
}

/**
 * 远程获取数据，GET模式
 * 注意：
 * 1.使用Crul需要修改服务器中php.ini文件的设置，找到php_curl.dll去掉前面的";"就行了
 * 2.文件夹中cacert.pem是SSL证书请保证其路径有效，目前默认路径是：getcwd().'\\cacert.pem'
 * @param $url 指定URL完整路径地址
 * @param $cacert_url 指定当前工作目录绝对路径
 * return 远程输出的数据
 */
function getHttpResponseGET($url,$cacert_url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);//SSL证书认证
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);//严格认证
    curl_setopt($curl, CURLOPT_CAINFO,$cacert_url);//证书地址
    $responseText = curl_exec($curl);
    //var_dump( curl_error($curl) );//如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
    curl_close($curl);

    return $responseText;
}

/**
 * 实现多种字符编码方式
 * @param $input 需要编码的字符串
 * @param $_output_charset 输出的编码格式
 * @param $_input_charset 输入的编码格式
 * return 编码后的字符串
 */
function charsetEncode($input,$_output_charset ,$_input_charset) {
    $output = "";
    if(!isset($_output_charset) )$_output_charset  = $_input_charset;
    if($_input_charset == $_output_charset || $input ==null ) {
        $output = $input;
    } elseif (function_exists("mb_convert_encoding")) {
        $output = mb_convert_encoding($input,$_output_charset,$_input_charset);
    } elseif(function_exists("iconv")) {
        $output = iconv($_input_charset,$_output_charset,$input);
    } else die("sorry, you have no libs support for charset change.");
    return $output;
}
/**
 * 实现多种字符解码方式
 * @param $input 需要解码的字符串
 * @param $_output_charset 输出的解码格式
 * @param $_input_charset 输入的解码格式
 * return 解码后的字符串
 */
function charsetDecode($input,$_input_charset ,$_output_charset) {
    $output = "";
    if(!isset($_input_charset) )$_input_charset  = $_input_charset ;
    if($_input_charset == $_output_charset || $input ==null ) {
        $output = $input;
    } elseif (function_exists("mb_convert_encoding")) {
        $output = mb_convert_encoding($input,$_output_charset,$_input_charset);
    } elseif(function_exists("iconv")) {
        $output = iconv($_input_charset,$_output_charset,$input);
    } else die("sorry, you have no libs support for charset changes.");
    return $output;
}

/* *
 * MD5
 * 详细：MD5加密
 * 版本：3.3
 * 日期：2012-07-19
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
 */

/**
 * 签名字符串
 * @param $prestr 需要签名的字符串
 * @param $key 私钥
 * return 签名结果
 */

function md5Sign($prestr, $key) {
    $prestr = $prestr . $key;
    return md5($prestr);
}

/**
 * 验证签名
 * @param $prestr 需要签名的字符串
 * @param $sign 签名结果
 * @param $key 私钥
 * return 签名结果
 */
function md5Verify($prestr, $sign, $key) {
    $prestr = $prestr . $key;
    $mysgin = md5($prestr);

    if($mysgin == $sign) {
        return true;
    }
    else {
        return false;
    }
}