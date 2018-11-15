<?php

header("Content-type:text/html;charset=utf-8");
//设置时区
date_default_timezone_set("Asia/Shanghai");
//传递数据以易于阅读的样式格式化后输出
function dd($data)
{
    // 定义样式
    $str = '<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
    // 如果是boolean或者null直接显示文字；否则print
    if (is_bool($data)) {
        $show_data = $data ? 'true' : 'false';
    } elseif (is_null($data)) {
        $show_data = 'null';
    } else {
        $show_data = print_r($data, true);
    }
    $str .= $show_data;
    $str .= '</pre>';
    echo $str;
}

/** 单文件上传
 * @param $img  img  资源   $_FILES['img']
 * @return string
 */
function uplodenumimg($img)
{
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize = 453145728;// 设置附件上传大小
    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->savePath = ''; // 设置附件上传（子）目录
    $upload->rootPath = './Upload/file/';
    $upload->savePath = ''; // 设置附件上传（子）目录
    $Path = './Upload/file/';
    if (!file_exists($Path)) {
        mkdir($Path, 0777, true);
    }
    $info = $upload->uploadOne($img);
    return trim($Path . $info['savepath'] . $info['savename'], '.');

}


/**
 * app 图片上传
 * @return string 上传后的图片名
 */
function app_upload_image($path, $maxSize = 52428800)
{
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path = trim($path, '.');
    $path = trim($path, '/');
    $config = array(
        'rootPath' => './',         //文件上传保存的根路径
        'savePath' => './' . $path . '/',
        'exts' => array('jpg', 'gif', 'png', 'jpeg', 'bmp'),
        'maxSize' => $maxSize,
        'autoSub' => true,
    );
    $upload = new \Think\Upload($config);// 实例化上传类
    $info = $upload->upload();
    if ($info) {
        foreach ($info as $k => $v) {
            $data[] = trim($v['savepath'], '.') . $v['savename'];
        }
        return $data;
    }
}

/**
 * 实例化阿里云oos
 * @return object 实例化得到的对象
 */
function new_oss()
{
    vendor('Alioss.autoload');
    $config = C('ALIOSS_CONFIG');
    $oss = new \OSS\OssClient($config['KEY_ID'], $config['KEY_SECRET'], $config['END_POINT']);
    return $oss;
}

/**
 * 上传文件到oss并删除本地文件
 * @param  string $path 文件路径
 * @return bollear      是否上传
 */
function oss_upload($path)
{
    // 获取bucket名称
    $bucket = C('ALIOSS_CONFIG.BUCKET');
    // 先统一去除左侧的.或者/ 再添加./
    $oss_path = ltrim($path, './');
    $path = './' . $oss_path;
    if (file_exists($path)) {
        // 实例化oss类
        $oss = new_oss();
        // 上传到oss
        $oss->uploadFile($bucket, $oss_path, $path);
        // 如需上传到oss后 自动删除本地的文件 则删除下面的注释
        // unlink($path);
        return true;
    }
    return false;
}

/**
 * 删除oss上指定文件
 * @param  string $object 文件路径 例如删除 /Public/README.md文件  传Public/README.md 即可
 */
function oss_delet_object($object)
{
    // 实例化oss类
    $oss = new_oss();
    // 获取bucket名称
    $bucket = C('ALIOSS_CONFIG.BUCKET');
    $test = $oss->deleteObject($bucket, $object);
}

/**
 * app 视频上传
 * @return string 上传后的视频名
 */
function app_upload_video($path, $maxSize = 52428800)
{
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path = trim($path, '.');
    $path = trim($path, '/');
    $config = array(
        'rootPath' => './',         //文件上传保存的根路径
        'savePath' => './' . $path . '/',
        'exts' => array('mp4', 'avi', '3gp', 'rmvb', 'gif', 'wmv', 'mkv', 'mpg', 'vob', 'mov', 'flv', 'swf', 'mp3', 'ape', 'wma', 'aac', 'mmf', 'amr', 'm4a', 'm4r', 'ogg', 'wav', 'wavpack'),
        'maxSize' => $maxSize,
        'autoSub' => true,
    );
    $upload = new \Think\Upload($config);// 实例化上传类
    $info = $upload->upload();
    if ($info) {
        foreach ($info as $k => $v) {
            $data[] = trim($v['savepath'], '.') . $v['savename'];
        }
        return $data;
    }
}


/**
 * 返回文件格式
 * @param  string $str 文件名
 * @return string      文件格式
 */
function file_format($str)
{
    // 取文件后缀名
    $str = strtolower(pathinfo($str, PATHINFO_EXTENSION));
    // 图片格式
    $image = array('webp', 'jpg', 'png', 'ico', 'bmp', 'gif', 'tif', 'pcx', 'tga', 'bmp', 'pxc', 'tiff', 'jpeg', 'exif', 'fpx', 'svg', 'psd', 'cdr', 'pcd', 'dxf', 'ufo', 'eps', 'ai', 'hdri');
    // 视频格式
    $video = array('mp4', 'avi', '3gp', 'rmvb', 'gif', 'wmv', 'mkv', 'mpg', 'vob', 'mov', 'flv', 'swf', 'mp3', 'ape', 'wma', 'aac', 'mmf', 'amr', 'm4a', 'm4r', 'ogg', 'wav', 'wavpack');
    // 压缩格式
    $zip = array('rar', 'zip', 'tar', 'cab', 'uue', 'jar', 'iso', 'z', '7-zip', 'ace', 'lzh', 'arj', 'gzip', 'bz2', 'tz');
    // 文档格式
    $text = array('exe', 'doc', 'ppt', 'xls', 'wps', 'txt', 'lrc', 'wfs', 'torrent', 'html', 'htm', 'java', 'js', 'css', 'less', 'php', 'pdf', 'pps', 'host', 'box', 'docx', 'word', 'perfect', 'dot', 'dsf', 'efe', 'ini', 'json', 'lnk', 'log', 'msi', 'ost', 'pcs', 'tmp', 'xlsb');
    // 匹配不同的结果
    switch ($str) {
        case in_array($str, $image):
            return 'image';
            break;
        case in_array($str, $video):
            return 'video';
            break;
        case in_array($str, $zip):
            return 'zip';
            break;
        case in_array($str, $text):
            return 'text';
            break;
        default:
            return 'image';
            break;
    }
}

/**
 * 发送友盟推送消息
 * @param  integer $uid 用户id
 * @param  string $title 推送的标题
 * @return boolear         是否成功
 */
function umeng_push($uid, $title)
{
    // 获取token
    $device_tokens = D('OauthUser')->getToken($uid, 2);
    // 如果没有token说明移动端没有登录；则不发送通知
    if (empty($device_tokens)) {
        return false;
    }
    // 导入友盟
    Vendor('Umeng.Umeng');
    // 自定义字段   根据实际环境分配；如果不用可以忽略
    $status = 1;
    // 消息未读总数统计  根据实际环境获取未读的消息总数 此数量会显示在app图标右上角
    $count_number = 1;
    $data = array(
        'key' => 'status',
        'value' => "$status",
        'count_number' => $count_number
    );
    // 判断device_token  64位表示为苹果 否则为安卓
    if (strlen($device_tokens) == 64) {
        $key = C('UMENG_IOS_APP_KEY');
        $timestamp = C('UMENG_IOS_SECRET');
        $umeng = new \Umeng($key, $timestamp);
        $umeng->sendIOSUnicast($data, $title, $device_tokens);
    } else {
        $key = C('UMENG_ANDROID_APP_KEY');
        $timestamp = C('UMENG_ANDROID_SECRET');
        $umeng = new \Umeng($key, $timestamp);
        $umeng->sendAndroidUnicast($data, $title, $device_tokens);
    }
    return true;
}


/**
 * 返回用户id
 * @return integer 用户id
 */
function get_uid()
{
    return $_SESSION['user']['id'];
}

/**
 * 返回iso、Android、ajax的json格式数据
 * @param  array $data 需要发送到前端的数据
 * @param  string $error_message 成功或者错误的提示语
 * @param  integer $error_code 状态码： 0：成功  1：失败
 * @return string                 json格式的数据
 */
function ajax_return($data = '', $error_message = '成功', $error_code = 1)
{
    $all_data = array(
        'data' => $data,
        'code' => $error_code,
        'msg' => $error_message,
    );
    // 如果是ajax或者app访问；则返回json数据 pc访问直接p出来
    echo json_encode($all_data);
    exit(0);
}

/**
 * 获取完整网络连接
 * @param  string $path 文件路径
 * @return string       http连接
 */
function get_url($path)
{
    // 如果是空；返回空
    if (empty($path)) {
        return '';
    }
    // 如果已经有http直接返回
    if (strpos($path, 'http://') !== false) {
        return $path;
    }
    // 判断是否使用了oss
    $alioss = C('ALIOSS_CONFIG');
    if (empty($alioss['KEY_ID'])) {
        return 'http://' . $_SERVER['HTTP_HOST'] . $path;
    } else {
        return 'http://' . $alioss['BUCKET'] . '.' . $alioss['END_POINT'] . $path;
    }

}

/**
 * 检测是否登录
 * @return boolean 是否登录
 */
function check_login()
{
    if (!empty($_SESSION['user']['id'])) {
        return true;
    } else {
        return false;
    }
}

/**
 * 根据配置项获取对应的key和secret
 * @return array key和secret
 */
function get_rong_key_secret()
{
    // 判断是需要开发环境还是生产环境的key
    if (C('RONG_IS_DEV')) {
        $key = C('RONG_DEV_APP_KEY');
        $secret = C('RONG_DEV_APP_SECRET');
    } else {
        $key = C('RONG_PRO_APP_KEY');
        $secret = C('RONG_PRO_APP_SECRET');
    }
    $data = array(
        'key' => $key,
        'secret' => $secret
    );
    return $data;
}

/**
 * 获取融云token
 * @param  integer $uid 用户id
 * @return integer      token
 */
function get_rongcloud_token($uid)
{
    // 从数据库中获取token
    $token = D('OauthUser')->getToken($uid, 1);
    // 如果有token就返回
    if ($token) {
        return $token;
    }
    // 获取用户昵称和头像
    $user_data = M('Users')->field('username,avatar')->getById($uid);
    // 用户不存在
    if (empty($user_data)) {
        return false;
    }
    // 获取头像url格式
    $avatar = get_url($user_data['avatar']);
    // 获取key和secret
    $key_secret = get_rong_key_secret();
    // 实例化融云
    $rong_cloud = new \Org\Xb\RongCloud($key_secret['key'], $key_secret['secret']);
    // 获取token
    $token_json = $rong_cloud->getToken($uid, $user_data['username'], $avatar);
    $token_array = json_decode($token_json, true);
    // 获取token失败
    if ($token_array['code'] != 200) {
        return false;
    }
    $token = $token_array['token'];
    $data = array(
        'uid' => $uid,
        'type' => 1,
        'nickname' => $user_data['username'],
        'head_img' => $avatar,
        'access_token' => $token
    );
    // 插入数据库
    $result = D('OauthUser')->addData($data);
    if ($result) {
        return $token;
    } else {
        return false;
    }
}

/**
 * 更新融云头像
 * @param  integer $uid 用户id
 * @return boolear      操作是否成功
 */
function refresh_rongcloud_token($uid)
{
    // 获取用户昵称和头像
    $user_data = M('Users')->field('username,avatar')->getById($uid);
    // 用户不存在
    if (empty($user_data)) {
        return false;
    }
    $avatar = get_url($user_data['avatar']);
    // 获取key和secret
    $key_secret = get_rong_key_secret();
    // 实例化融云
    $rong_cloud = new \Org\Xb\RongCloud($key_secret['key'], $key_secret['secret']);
    // 更新融云用户头像
    $result_json = $rong_cloud->userRefresh($uid, $user_data['username'], $avatar);
    $result_array = json_decode($result_json, true);
    if ($result_array['code'] == 200) {
        return true;
    } else {
        return false;
    }
}

/**
 * 删除指定的标签和内容
 * @param array $tags 需要删除的标签数组
 * @param string $str 数据源
 * @param string $content 是否删除标签内的内容 0保留内容 1不保留内容
 * @return string
 */
function strip_html_tags($tags, $str, $content = 0)
{
    if ($content) {
        $html = array();
        foreach ($tags as $tag) {
            $html[] = '/(<' . $tag . '.*?>[\s|\S]*?<\/' . $tag . '>)/';
        }
        $data = preg_replace($html, '', $str);
    } else {
        $html = array();
        foreach ($tags as $tag) {
            $html[] = "/(<(?:\/" . $tag . "|" . $tag . ")[^>]*>)/i";
        }
        $data = preg_replace($html, '', $str);
    }
    return $data;
}

/**
 * 传递ueditor生成的内容获取其中图片的路径
 * @param  string $str 含有图片链接的字符串
 * @return array       匹配的图片数组
 */
function get_ueditor_image_path($str)
{
    $preg = '/\/Upload\/image\/u(m)?editor\/\d*\/\d*\.[jpg|jpeg|png|bmp]*/i';
    preg_match_all($preg, $str, $data);
    return current($data);
}

/**
 * 字符串截取，支持中文和其他编码
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $suffix 截断显示字符
 * @param string $charset 编码格式
 * @return string
 */
function re_substr($str, $start = 0, $length, $suffix = true, $charset = "utf-8")
{
    if (function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif (function_exists('iconv_substr')) {
        $slice = iconv_substr($str, $start, $length, $charset);
    } else {
        $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("", array_slice($match[0], $start, $length));
    }
    $omit = mb_strlen($str) >= $length ? '...' : '';
    return $suffix ? $slice . $omit : $slice;
}

// 设置验证码
function show_verify($config = '')
{
    if ($config == '') {
        $config = array(
            'codeSet' => '1234567890',
            'fontSize' => 30,
            'useCurve' => false,
            'imageH' => 60,
            'imageW' => 240,
            'length' => 4,
            'fontttf' => '4.ttf',
        );
    }
    $verify = new \Think\Verify($config);
    return $verify->entry();
}

// 检测验证码
function check_verify($code)
{
    $verify = new \Think\Verify();
    return $verify->check($code);
}

/**
 * 取得根域名
 * @param type $domain 域名
 * @return string 返回根域名
 */
function get_url_to_domain($domain)
{
    $re_domain = '';
    $domain_postfix_cn_array = array("com", "net", "org", "gov", "edu", "com.cn", "cn");
    $array_domain = explode(".", $domain);
    $array_num = count($array_domain) - 1;
    if ($array_domain[$array_num] == 'cn') {
        if (in_array($array_domain[$array_num - 1], $domain_postfix_cn_array)) {
            $re_domain = $array_domain[$array_num - 2] . "." . $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
        } else {
            $re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
        }
    } else {
        $re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
    }
    return $re_domain;
}

/**
 * 按符号截取字符串的指定部分
 * @param string $str 需要截取的字符串
 * @param string $sign 需要截取的符号
 * @param int $number 如是正数以0为起点从左向右截  负数则从右向左截
 * @return string 返回截取的内容
 */
/*  示例
    $str='123/456/789';
    cut_str($str,'/',0);  返回 123
    cut_str($str,'/',-1);  返回 789
    cut_str($str,'/',-2);  返回 456
    具体参考 http://www.baijunyao.com/index.php/Home/Index/article/aid/18
*/
function cut_str($str, $sign, $number)
{
    $array = explode($sign, $str);
    $length = count($array);
    if ($number < 0) {
        $new_array = array_reverse($array);
        $abs_number = abs($number);
        if ($abs_number > $length) {
            return 'error';
        } else {
            return $new_array[$abs_number - 1];
        }
    } else {
        if ($number >= $length) {
            return 'error';
        } else {
            return $array[$number];
        }
    }
}

/**
 * 发送邮件
 * @param  string $address 需要发送的邮箱地址 发送给多个地址需要写成数组形式
 * @param  string $subject 标题
 * @param  string $content 内容
 * @return boolean       是否成功
 */
function send_email($address, $subject, $content)
{
    $email_smtp = C('EMAIL_SMTP');
    $email_username = C('EMAIL_USERNAME');
    $email_password = C('EMAIL_PASSWORD');
    $email_from_name = C('EMAIL_FROM_NAME');
    $email_smtp_secure = C('EMAIL_SMTP_SECURE');
    $email_port = C('EMAIL_PORT');
    if (empty($email_smtp) || empty($email_username) || empty($email_password) || empty($email_from_name)) {
        return array("error" => 1, "message" => '邮箱配置不完整');
    }
    require_once './ThinkPHP/Library/Org/Nx/class.phpmailer.php';
    require_once './ThinkPHP/Library/Org/Nx/class.smtp.php';
    $phpmailer = new \Phpmailer();
    // 设置PHPMailer使用SMTP服务器发送Email
    $phpmailer->IsSMTP();
    // 设置设置smtp_secure
    $phpmailer->SMTPSecure = $email_smtp_secure;
    // 设置port
    $phpmailer->Port = $email_port;
    // 设置为html格式
    $phpmailer->IsHTML(true);
    // 设置邮件的字符编码'
    $phpmailer->CharSet = 'UTF-8';
    // 设置SMTP服务器。
    $phpmailer->Host = $email_smtp;
    // 设置为"需要验证"
    $phpmailer->SMTPAuth = true;
    // 设置用户名
    $phpmailer->Username = $email_username;
    // 设置密码
    $phpmailer->Password = $email_password;
    // 设置邮件头的From字段。
    $phpmailer->From = $email_username;
    // 设置发件人名字
    $phpmailer->FromName = $email_from_name;
    // 添加收件人地址，可以多次使用来添加多个收件人
    if (is_array($address)) {
        foreach ($address as $addressv) {
            $phpmailer->AddAddress($addressv);
        }
    } else {
        $phpmailer->AddAddress($address);
    }
    // 设置邮件标题
    $phpmailer->Subject = $subject;
    // 设置邮件正文
    $phpmailer->Body = $content;
    // 发送邮件。
    if (!$phpmailer->Send()) {
        $phpmailererror = $phpmailer->ErrorInfo;
        return array("error" => 1, "message" => $phpmailererror);
    } else {
        return array("error" => 0);
    }
}

/**
 * 获取一定范围内的随机数字
 * 跟rand()函数的区别是 位数不足补零 例如
 * rand(1,9999)可能会得到 465
 * rand_number(1,9999)可能会得到 0465  保证是4位的
 * @param integer $min 最小值
 * @param integer $max 最大值
 * @return string
 */
function rand_number($min = 1, $max = 9999)
{
    return sprintf("%0" . strlen($max) . "d", mt_rand($min, $max));
}

/**
 * 生成一定数量的随机数，并且不重复
 * @param integer $number 数量
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @return string
 */
function build_count_rand($number, $length = 4, $mode = 1)
{
    if ($mode == 1 && $length < strlen($number)) {
        //不足以生成一定数量的不重复数字
        return false;
    }
    $rand = array();
    for ($i = 0; $i < $number; $i++) {
        $rand[] = rand_string($length, $mode);
    }
    $unqiue = array_unique($rand);
    if (count($unqiue) == count($rand)) {
        return $rand;
    }
    $count = count($rand) - count($unqiue);
    for ($i = 0; $i < $count * 3; $i++) {
        $rand[] = rand_string($length, $mode);
    }
    $rand = array_slice(array_unique($rand), 0, $number);
    return $rand;
}

/**
 * 生成不重复的随机数
 * @param  int $start 需要生成的数字开始范围
 * @param  int $end 结束范围
 * @param  int $length 需要生成的随机数个数
 * @return array       生成的随机数
 */
function get_rand_number($start = 1, $end = 10, $length = 4)
{
    $connt = 0;
    $temp = array();
    while ($connt < $length) {
        $temp[] = rand($start, $end);
        $data = array_unique($temp);
        $connt = count($data);
    }
    sort($data);
    return $data;
}

/**
 * 实例化page类
 * @param  integer $count 总数
 * @param  integer $limit 每页数量
 * @return subject       page类
 */
function new_page($count, $limit = 10)
{
    return new \Think\Page($count, $limit);
}

/**
 * 处理post上传的文件；并返回路径
 * @param  string $path 字符串 保存文件路径示例： /Upload/image/
 * @param  string $format 文件格式限制
 * @param  string $maxSize 允许的上传文件最大值 52428800
 * @return array           返回ajax的json格式数据
 */
function post_upload($path = 'file', $format = 'empty', $maxSize = '52428800')
{
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path = trim($path, '/');
    // 添加Upload根目录
    $path = strtolower(substr($path, 0, 6)) === 'upload' ? ucfirst($path) : 'Upload/' . $path;
    // 上传文件类型控制
    $ext_arr = array(
        'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
        'photo' => array('jpg', 'jpeg', 'png'),
        'flash' => array('swf', 'flv'),
        'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
        'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2', 'pdf')
    );
    if (!empty($_FILES)) {
        // 上传文件配置
        $config = array(
            'maxSize' => $maxSize,       //   上传文件最大为50M
            'rootPath' => './',           //文件上传保存的根路径
            'savePath' => './' . $path . '/',         //文件上传的保存路径（相对于根路径）
            'saveName' => array('uniqid', ''),     //上传文件的保存规则，支持数组和字符串方式定义
            'autoSub' => true,                   //  自动使用子目录保存上传文件 默认为true
            'exts' => isset($ext_arr[$format]) ? $ext_arr[$format] : '',
        );
        // 实例化上传
        $upload = new \Think\Upload($config);
        // 调用上传方法
        $info = $upload->upload();
        $data = array();
        if (!$info) {
            // 返回错误信息
            $error = $upload->getError();
            $data['error_info'] = $error;
            return $data;
        } else {
            // 返回成功信息
            foreach ($info as $file) {
                $data['name'] = trim($file['savepath'] . $file['savename'], '.');
                return $data;
            }
        }
    }
}

/**
 * 上传文件类型控制   此方法仅限ajax上传使用
 * @param  string $path 字符串 保存文件路径示例： /Upload/image/
 * @param  string $format 文件格式限制
 * @param  integer $maxSize 允许的上传文件最大值 52428800
 * @return booler       返回ajax的json格式数据
 */
function upload($path = 'file', $format = 'empty', $maxSize = '52428800')
{
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path = trim($path, '/');
    // 添加Upload根目录
    $path = strtolower(substr($path, 0, 6)) === 'upload' ? ucfirst($path) : 'Upload/' . $path;
    // 上传文件类型控制
    $ext_arr = array(
        'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
        'photo' => array('jpg', 'jpeg', 'png'),
        'flash' => array('swf', 'flv'),
        'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
        'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2', 'pdf')
    );
    if (!empty($_FILES)) {
        // 上传文件配置
        $config = array(
            'maxSize' => $maxSize,       //   上传文件最大为50M
            'rootPath' => './',           //文件上传保存的根路径
            'savePath' => './' . $path . '/',         //文件上传的保存路径（相对于根路径）
            'saveName' => array('uniqid', ''),     //上传文件的保存规则，支持数组和字符串方式定义
            'autoSub' => true,                   //  自动使用子目录保存上传文件 默认为true
            'exts' => isset($ext_arr[$format]) ? $ext_arr[$format] : '',
        );
        // 实例化上传
        $upload = new \Think\Upload($config);
        // 调用上传方法
        $info = $upload->upload();
        $data = array();
        if (!$info) {
            // 返回错误信息
            $error = $upload->getError();
            $data['error_info'] = $error;
            echo json_encode($data);
        } else {
            // 返回成功信息
            foreach ($info as $file) {
                $data['name'] = trim($file['savepath'] . $file['savename'], '.');
                echo json_encode($data);
            }
        }
    }
}

/*
* 计算星座的函数 string get_zodiac_sign(string month, string day)
* 输入：月份，日期
* 输出：星座名称或者错误信息
*/

function get_zodiac_sign($month, $day)
{
    // 检查参数有效性
    if ($month < 1 || $month > 12 || $day < 1 || $day > 31)
        return (false);
    // 星座名称以及开始日期
    $signs = array(
        array("20" => "水瓶座"),
        array("19" => "双鱼座"),
        array("21" => "白羊座"),
        array("20" => "金牛座"),
        array("21" => "双子座"),
        array("22" => "巨蟹座"),
        array("23" => "狮子座"),
        array("23" => "处女座"),
        array("23" => "天秤座"),
        array("24" => "天蝎座"),
        array("22" => "射手座"),
        array("22" => "摩羯座")
    );
    list($sign_start, $sign_name) = each($signs[(int)$month - 1]);
    if ($day < $sign_start)
        list($sign_start, $sign_name) = each($signs[($month - 2 < 0) ? $month = 11 : $month -= 2]);
    return $sign_name;
}

/**
 * 发送 容联云通讯 验证码
 * @param  int $phone 手机号
 * @param  int $code 验证码
 * @return boole      是否发送成功
 */
function send_sms_code($phone, $code)
{
    //请求地址，格式如下，不需要写https://
    $serverIP = 'app.cloopen.com';
    //请求端口
    $serverPort = '8883';
    //REST版本号
    $softVersion = '2013-12-26';
    //主帐号
    $accountSid = C('RONGLIAN_ACCOUNT_SID');
    //主帐号Token
    $accountToken = C('RONGLIAN_ACCOUNT_TOKEN');
    //应用Id
    $appId = C('RONGLIAN_APPID');
    //应用Id
    $templateId = C('RONGLIAN_TEMPLATE_ID');
    $rest = new \Org\Xb\Rest($serverIP, $serverPort, $softVersion);
    $rest->setAccount($accountSid, $accountToken);
    $rest->setAppId($appId);
    // 发送模板短信
    $result = $rest->sendTemplateSMS($phone, array($code, 5), $templateId);
    if ($result == NULL) {
        return false;
    }
    if ($result->statusCode != 0) {
        return false;
    } else {
        return true;
    }
}

/**
 * 将路径转换加密
 * @param  string $file_path 路径
 * @return string            转换后的路径
 */
function path_encode($file_path)
{
    return rawurlencode(base64_encode($file_path));
}

/**
 * 将路径解密
 * @param  string $file_path 加密后的字符串
 * @return string            解密后的路径
 */
function path_decode($file_path)
{
    return base64_decode(rawurldecode($file_path));
}

/**
 * 根据文件后缀的不同返回不同的结果
 * @param  string $str 需要判断的文件名或者文件的id
 * @return integer     1:图片  2：视频  3：压缩文件  4：文档  5：其他
 */
function file_category($str)
{
    // 取文件后缀名
    $str = strtolower(pathinfo($str, PATHINFO_EXTENSION));
    // 图片格式
    $images = array('webp', 'jpg', 'png', 'ico', 'bmp', 'gif', 'tif', 'pcx', 'tga', 'bmp', 'pxc', 'tiff', 'jpeg', 'exif', 'fpx', 'svg', 'psd', 'cdr', 'pcd', 'dxf', 'ufo', 'eps', 'ai', 'hdri');
    // 视频格式
    $video = array('mp4', 'avi', '3gp', 'rmvb', 'gif', 'wmv', 'mkv', 'mpg', 'vob', 'mov', 'flv', 'swf', 'mp3', 'ape', 'wma', 'aac', 'mmf', 'amr', 'm4a', 'm4r', 'ogg', 'wav', 'wavpack');
    // 压缩格式
    $zip = array('rar', 'zip', 'tar', 'cab', 'uue', 'jar', 'iso', 'z', '7-zip', 'ace', 'lzh', 'arj', 'gzip', 'bz2', 'tz');
    // 文档格式
    $document = array('exe', 'doc', 'ppt', 'xls', 'wps', 'txt', 'lrc', 'wfs', 'torrent', 'html', 'htm', 'java', 'js', 'css', 'less', 'php', 'pdf', 'pps', 'host', 'box', 'docx', 'word', 'perfect', 'dot', 'dsf', 'efe', 'ini', 'json', 'lnk', 'log', 'msi', 'ost', 'pcs', 'tmp', 'xlsb');
    // 匹配不同的结果
    switch ($str) {
        case in_array($str, $images):
            return 1;
            break;
        case in_array($str, $video):
            return 2;
            break;
        case in_array($str, $zip):
            return 3;
            break;
        case in_array($str, $document):
            return 4;
            break;
        default:
            return 5;
            break;
    }
}

/**
 * 组合缩略图
 * @param  string $file_path 原图path
 * @param  integer $size 比例
 * @return string              缩略图
 */
function get_min_image_path($file_path, $width = 170, $height = 170)
{
    $min_path = str_replace('.', '_' . $width . '_' . $height . '.', trim($file_path, '.'));
    $min_path = OSS_URL . $min_path;
    return $min_path;
}

/**
 * 不区分大小写的in_array()
 * @param  string $str 检测的字符
 * @param  array $array 数组
 * @return boolear       是否in_array
 */
function in_iarray($str, $array)
{
    $str = strtolower($str);
    $array = array_map('strtolower', $array);
    if (in_array($str, $array)) {
        return true;
    }
    return false;
}

/**
 * 传入时间戳,计算距离现在的时间
 * @param  number $time 时间戳
 * @return string     返回多少以前
 */
function word_time($time)
{
    $time = (int)substr($time, 0, 10);
    $int = time() - $time;
    $str = '';
    if ($int <= 2) {
        $str = sprintf('刚刚', $int);
    } elseif ($int < 60) {
        $str = sprintf('%d秒前', $int);
    } elseif ($int < 3600) {
        $str = sprintf('%d分钟前', floor($int / 60));
    } elseif ($int < 86400) {
        $str = sprintf('%d小时前', floor($int / 3600));
    } elseif ($int < 1728000) {
        $str = sprintf('%d天前', floor($int / 86400));
    } else {
        $str = date('Y-m-d H:i:s', $time);
    }
    return $str;
}

/**
 * 生成缩略图
 * @param  string $image_path 原图path
 * @param  integer $width 缩略图的宽
 * @param  integer $height 缩略图的高
 * @return string             缩略图path
 */
function crop_image($image_path, $width = 170, $height = 170)
{
    $image_path = trim($image_path, '.');
    $min_path = '.' . str_replace('.', '_' . $width . '_' . $height . '.', $image_path);
    $image = new \Think\Image();
    $image->open($image_path);
    // 生成一个居中裁剪为$width*$height的缩略图并保存
    $image->thumb($width, $height, \Think\Image::IMAGE_THUMB_CENTER)->save($min_path);
    oss_upload($min_path);
    return $min_path;
}

/**
 * 上传文件类型控制 此方法仅限ajax上传使用
 * @param  string $path 字符串 保存文件路径示例： /Upload/image/
 * @param  string $format 文件格式限制
 * @param  integer $maxSize 允许的上传文件最大值 52428800
 * @return booler   返回ajax的json格式数据
 */
function ajax_upload($path = 'file', $format = 'empty', $maxSize = '52428800')
{
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path = trim($path, '/');
    // 添加Upload根目录
    $path = strtolower(substr($path, 0, 6)) === 'upload' ? ucfirst($path) : 'Upload/' . $path;
    // 上传文件类型控制
    $ext_arr = array(
        'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
        'photo' => array('jpg', 'jpeg', 'png'),
        'flash' => array('swf', 'flv'),
        'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
        'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2', 'pdf')
    );
    if (!empty($_FILES)) {
        // 上传文件配置
        $config = array(
            'maxSize' => $maxSize,               // 上传文件最大为50M
            'rootPath' => './',                   // 文件上传保存的根路径
            'savePath' => './' . $path . '/',         // 文件上传的保存路径（相对于根路径）
            'saveName' => array('uniqid', ''),     // 上传文件的保存规则，支持数组和字符串方式定义
            'autoSub' => true,                   // 自动使用子目录保存上传文件 默认为true
            'exts' => isset($ext_arr[$format]) ? $ext_arr[$format] : '',
        );
        // p($_FILES);
        // 实例化上传
        $upload = new \Think\Upload($config);
        // 调用上传方法
        $info = $upload->upload();
        // p($info);
        $data = array();
        if (!$info) {
            // 返回错误信息
            $error = $upload->getError();
            $data['error_info'] = $error;
            echo json_encode($data);
        } else {
            // 返回成功信息
            foreach ($info as $file) {
                $data['name'] = trim($file['savepath'] . $file['savename'], '.');
                // p($data);
                echo json_encode($data);
            }
        }
    }
}

/**
 * 检测webuploader上传是否成功
 * @param  string $file_path post中的字段
 * @return boolear           是否成功
 */
function upload_success($file_path)
{
    // 为兼容传进来的有数组；先转成json
    $file_path = json_encode($file_path);
    // 如果有undefined说明上传失败
    if (strpos($file_path, 'undefined') !== false) {
        return false;
    }
    // 如果没有.符号说明上传失败
    if (strpos($file_path, '.') === false) {
        return false;
    }
    // 否则上传成功则返回true
    return true;
}


/**
 * 把用户输入的文本转义（主要针对特殊符号和emoji表情）
 */
function emoji_encode($str)
{
    if (!is_string($str)) return $str;
    if (!$str || $str == 'undefined') return '';

    $text = json_encode($str); //暴露出unicode
    $text = preg_replace_callback("/(\\\u[ed][0-9a-f]{3})/i", function ($str) {
        return addslashes($str[0]);
    }, $text); //将emoji的unicode留下，其他不动，这里的正则比原答案增加了d，因为我发现我很多emoji实际上是\ud开头的，反而暂时没发现有\ue开头。
    return json_decode($text);
}

/**
 * 检测是否是手机访问
 */
function is_mobile()
{
    $useragent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $useragent_commentsblock = preg_match('|\(.*?\)|', $useragent, $matches) > 0 ? $matches[0] : '';
    function _is_mobile($substrs, $text)
    {
        foreach ($substrs as $substr)
            if (false !== strpos($text, $substr)) {
                return true;
            }
        return false;
    }

    $mobile_os_list = array('Google Wireless Transcoder', 'Windows CE', 'WindowsCE', 'Symbian', 'Android', 'armv6l', 'armv5', 'Mobile', 'CentOS', 'mowser', 'AvantGo', 'Opera Mobi', 'J2ME/MIDP', 'Smartphone', 'Go.Web', 'Palm', 'iPAQ');
    $mobile_token_list = array('Profile/MIDP', 'Configuration/CLDC-', '160×160', '176×220', '240×240', '240×320', '320×240', 'UP.Browser', 'UP.Link', 'SymbianOS', 'PalmOS', 'PocketPC', 'SonyEricsson', 'Nokia', 'BlackBerry', 'Vodafone', 'BenQ', 'Novarra-Vision', 'Iris', 'NetFront', 'HTC_', 'Xda_', 'SAMSUNG-SGH', 'Wapaka', 'DoCoMo', 'iPhone', 'iPod');

    $found_mobile = _is_mobile($mobile_os_list, $useragent_commentsblock) ||
        _is_mobile($mobile_token_list, $useragent);
    if ($found_mobile) {
        return true;
    } else {
        return false;
    }
}

/**
 * 将utf-16的emoji表情转为utf8文字形
 * @param  string $str 需要转的字符串
 * @return string      转完成后的字符串
 */
function escape_sequence_decode($str)
{
    $regex = '/\\\u([dD][89abAB][\da-fA-F]{2})\\\u([dD][c-fC-F][\da-fA-F]{2})|\\\u([\da-fA-F]{4})/sx';
    return preg_replace_callback($regex, function ($matches) {
        if (isset($matches[3])) {
            $cp = hexdec($matches[3]);
        } else {
            $lead = hexdec($matches[1]);
            $trail = hexdec($matches[2]);
            $cp = ($lead << 10) + $trail + 0x10000 - (0xD800 << 10) - 0xDC00;
        }

        if ($cp > 0xD7FF && 0xE000 > $cp) {
            $cp = 0xFFFD;
        }
        if ($cp < 0x80) {
            return chr($cp);
        } else if ($cp < 0xA0) {
            return chr(0xC0 | $cp >> 6) . chr(0x80 | $cp & 0x3F);
        }
        $result = html_entity_decode('&#' . $cp . ';');
        return $result;
    }, $str);
}

/**
 * 获取当前访问的设备类型
 * @return integer 1：其他  2：iOS  3：Android
 */
function get_device_type()
{
    //全部变成小写字母
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $type = 1;
    //分别进行判断
    if (strpos($agent, 'iphone') !== false || strpos($agent, 'ipad') !== false) {
        $type = 2;
    }
    if (strpos($agent, 'android') !== false) {
        $type = 3;
    }
    return $type;
}

/**
 * 生成pdf
 * @param  string $html 需要生成的内容
 */
function pdf($html = '<h1 style="color:red">hello word</h1>')
{
    vendor('Tcpdf.tcpdf');
    $pdf = new \Tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // 设置打印模式
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('TCPDF Example 001');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    // 是否显示页眉
    $pdf->setPrintHeader(false);
    // 设置页眉显示的内容
    $pdf->SetHeaderData('logo.png', 60, 'baijunyao.com', '白俊遥博客', array(0, 64, 255), array(0, 64, 128));
    // 设置页眉字体
    $pdf->setHeaderFont(Array('dejavusans', '', '12'));
    // 页眉距离顶部的距离
    $pdf->SetHeaderMargin('5');
    // 是否显示页脚
    $pdf->setPrintFooter(true);
    // 设置页脚显示的内容
    $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
    // 设置页脚的字体
    $pdf->setFooterFont(Array('dejavusans', '', '10'));
    // 设置页脚距离底部的距离
    $pdf->SetFooterMargin('10');
    // 设置默认等宽字体
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // 设置行高
    $pdf->setCellHeightRatio(1);
    // 设置左、上、右的间距
    $pdf->SetMargins('10', '10', '10');
    // 设置是否自动分页  距离底部多少距离时分页
    $pdf->SetAutoPageBreak(TRUE, '15');
    // 设置图像比例因子
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $pdf->setFontSubsetting(true);
    $pdf->AddPage();
    // 设置字体
    $pdf->SetFont('stsongstdlight', '', 14, '', true);
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    $pdf->Output('example_001.pdf', 'I');
}

/**
 * 生成二维码
 * @param  string $url url连接
 * @param  integer $size 尺寸 纯数字
 */
function qrcode($url, $size = 4)
{
    Vendor('Phpqrcode.phpqrcode');
    QRcode::png($url, false, QR_ECLEVEL_L, $size, 2, false, 0xFFFFFF, 0x000000);
}

/**
 * 数组转xls格式的excel文件
 * @param  array $data 需要生成excel文件的数组
 * @param  string $filename 生成的excel文件名
 *      示例数据：
 * $data = array(
 * array(NULL, 2010, 2011, 2012),
 * array('Q1',   12,   15,   21),
 * array('Q2',   56,   73,   86),
 * array('Q3',   52,   61,   69),
 * array('Q4',   30,   32,    0),
 * );
 */
function create_xls($data, $filename = 'simple.xls')
{
    ini_set('max_execution_time', '0');
    Vendor('PHPExcel.PHPExcel');
    $filename = str_replace('.xls', '', $filename) . '.xls';
    $phpexcel = new PHPExcel();
    $phpexcel->getProperties()
        ->setCreator("Maarten Balliauw")
        ->setLastModifiedBy("Maarten Balliauw")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");
    $phpexcel->getActiveSheet()->fromArray($data);
    $phpexcel->getActiveSheet()->setTitle('Sheet1');
    $phpexcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$filename");
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0
    $objwriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
    $objwriter->save('php://output');
    exit;
}

/**
 * 数据转csv格式的excle
 * @param  array $data 需要转的数组
 * @param  string $header 要生成的excel表头
 * @param  string $filename 生成的excel文件名
 *      示例数组：
 * $data = array(
 * '1,2,3,4,5',
 * '6,7,8,9,0',
 * '1,3,5,6,7'
 * );
 * $header='用户名,密码,头像,性别,手机号';
 */
function create_csv($data, $header = null, $filename = 'simple.csv')
{
    // 如果手动设置表头；则放在第一行
    if (!is_null($header)) {
        array_unshift($data, $header);
    }
    // 防止没有添加文件后缀
    $filename = str_replace('.csv', '', $filename) . '.csv';
    ob_clean();
    Header("Content-type:  application/octet-stream ");
    Header("Accept-Ranges:  bytes ");
    Header("Content-Disposition:  attachment;  filename=" . $filename);
    foreach ($data as $k => $v) {
        // 如果是二维数组；转成一维
        if (is_array($v)) {
            $v = implode(',', $v);
        }
        // 替换掉换行
        $v = preg_replace('/\s*/', '', $v);
        // 解决导出的数字会显示成科学计数法的问题
        $v = str_replace(',', "\t,", $v);
        // 转成gbk以兼容office乱码的问题
        echo iconv('UTF-8', 'GBK', $v) . "\t\r\n";
    }
}

/**
 * 导入excel文件
 * @param  string $file excel文件路径
 * @return array        excel文件内容数组
 */
function import_excel($file)
{
    // 判断文件是什么格式
    $type = pathinfo($file);
    $type = strtolower($type["extension"]);
    if ($type == 'xlsx') {
        $type = 'Excel2007';
    } elseif ($type == 'xls') {
        $type = 'Excel5';
    }
    ini_set('max_execution_time', '0');
    Vendor('PHPExcel.PHPExcel');
    // 判断使用哪种格式
    $objReader = PHPExcel_IOFactory::createReader($type);
    $objPHPExcel = $objReader->load($file);
    $sheet = $objPHPExcel->getSheet(0);
    // 取得总行数
    $highestRow = $sheet->getHighestRow();
    // 取得总列数
    $highestColumn = $sheet->getHighestColumn();
    //循环读取excel文件,读取一条,插入一条
    $data = array();
    //从第一行开始读取数据
    for ($j = 1; $j <= $highestRow; $j++) {
        //从A列读取数据
        for ($k = 'A'; $k <= $highestColumn; $k++) {
            // 读取单元格
            $data[$j][] = $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
        }
    }
    return $data;
}

/**
 * 跳向支付宝付款
 * @param  array $order 订单数据 必须包含 out_trade_no(订单号)、price(订单金额)、subject(商品名称标题)
 */
function alipay($order)
{
    vendor('Alipay.AlipaySubmit', '', '.class.php');
    // 获取配置
    $config = C('ALIPAY_CONFIG');
    $data = array(
        "_input_charset" => $config['input_charset'], // 编码格式
        "logistics_fee" => "0.00", // 物流费用
        "logistics_payment" => "SELLER_PAY", // 物流支付方式SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
        "logistics_type" => "EXPRESS", // 物流类型EXPRESS（快递）、POST（平邮）、EMS（EMS）
        "notify_url" => $config['notify_url'], // 异步接收支付状态通知的链接
        "out_trade_no" => $order['out_trade_no'], // 订单号
        "partner" => $config['partner'], // partner 从支付宝商户版个人中心获取
        "payment_type" => "1", // 支付类型对应请求时的 payment_type 参数,原样返回。固定设置为1即可
        "price" => $order['price'], // 订单价格单位为元
        // "price" => 0.01, // // 调价用于测试
        "quantity" => "1", // price、quantity 能代替 total_fee。 即存在 total_fee,就不能存在 price 和 quantity;存在 price、quantity, 就不能存在 total_fee。 （没绕明白；好吧；那无视这个参数即可）
        "receive_address" => '1', // 收货人地址 即时到账方式无视此参数即可
        "receive_mobile" => '1', // 收货人手机号码 即时到账方式无视即可
        "receive_name" => '1', // 收货人姓名 即时到账方式无视即可
        "receive_zip" => '1', // 收货人邮编 即时到账方式无视即可
        "return_url" => $config['return_url'], // 页面跳转 同步通知 页面路径 支付宝处理完请求后,当前页面自 动跳转到商户网站里指定页面的 http 路径。
        "seller_email" => $config['seller_email'], // email 从支付宝商户版个人中心获取
        "service" => "create_direct_pay_by_user", // 接口名称 固定设置为create_direct_pay_by_user
        "show_url" => $config['show_url'], // 商品展示网址,收银台页面上,商品展示的超链接。
        "subject" => $order['subject'] // 商品名称商品的标题/交易标题/订单标 题/订单关键字等
    );
    $alipay = new \AlipaySubmit($config);
    $new = $alipay->buildRequestPara($data);
    $go_pay = $alipay->buildRequestForm($new, 'get', '支付');
    echo $go_pay;
}

/**
 * 微信扫码支付
 * @param  array $order 订单 必须包含支付所需要的参数 body(产品描述)、total_fee(订单金额)、out_trade_no(订单号)、product_id(产品id)
 */
function weixinpay($order)
{
    $order['trade_type'] = 'NATIVE';
    Vendor('Weixinpay.Weixinpay');
    $weixinpay = new \Weixinpay();
    $weixinpay->pay($order);
}

/**
 * 验证AppStore内付
 * @param  string $receipt_data 付款后凭证
 * @return array                验证是否成功
 */
function validate_apple_pay($receipt_data)
{
    /**
     * 21000 App Store不能读取你提供的JSON对象
     * 21002 receipt-data域的数据有问题
     * 21003 receipt无法通过验证
     * 21004 提供的shared secret不匹配你账号中的shared secret
     * 21005 receipt服务器当前不可用
     * 21006 receipt合法，但是订阅已过期。服务器接收到这个状态码时，receipt数据仍然会解码并一起发送
     * 21007 receipt是Sandbox receipt，但却发送至生产系统的验证服务
     * 21008 receipt是生产receipt，但却发送至Sandbox环境的验证服务
     */
    function acurl($receipt_data, $sandbox = 0)
    {
        //小票信息
        $POSTFIELDS = array("receipt-data" => $receipt_data);
        $POSTFIELDS = json_encode($POSTFIELDS);

        //正式购买地址 沙盒购买地址
        $url_buy = "https://buy.itunes.apple.com/verifyReceipt";
        $url_sandbox = "https://sandbox.itunes.apple.com/verifyReceipt";
        $url = $sandbox ? $url_sandbox : $url_buy;

        //简单的curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTFIELDS);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    // 验证参数
    if (strlen($receipt_data) < 20) {
        $result = array(
            'status' => false,
            'message' => '非法参数'
        );
        return $result;
    }
    // 请求验证
    $html = acurl($receipt_data);
    $data = json_decode($html, true);

    // 如果是沙盒数据 则验证沙盒模式
    if ($data['status'] == '21007') {
        // 请求验证
        $html = acurl($receipt_data, 1);
        $data = json_decode($html, true);
        $data['sandbox'] = '1';
    }

    if (isset($_GET['debug'])) {
        exit(json_encode($data));
    }

    // 判断是否购买成功
    if (intval($data['status']) === 0) {
        $result = array(
            'status' => true,
            'message' => '购买成功'
        );
    } else {
        $result = array(
            'status' => false,
            'message' => '购买失败 status:' . $data['status']
        );
    }
    return $result;
}

/**
 * geetest检测验证码
 */
function geetest_chcek_verify($data)
{
    $geetest_id = C('GEETEST_ID');
    $geetest_key = C('GEETEST_KEY');
    $geetest = new \Org\Xb\Geetest($geetest_id, $geetest_key);
    $user_id = $_SESSION['geetest']['user_id'];
    if ($_SESSION['geetest']['gtserver'] == 1) {
        $result = $geetest->success_validate($data['geetest_challenge'], $data['geetest_validate'], $data['geetest_seccode'], $user_id);
        if ($result) {
            return true;
        } else {
            return false;
        }
    } else {
        if ($geetest->fail_validate($data['geetest_challenge'], $data['geetest_validate'], $data['geetest_seccode'])) {
            return true;
        } else {
            return false;
        }
    }
}

function postSMS($AuthCode, $mobile = '')
{
    $userName = 'suowei';        //必选	string	帐号名称
    $userPass = '008899.zlx';        //必选	string	密码
    $mobile = trim($mobile);            //必选	string	多个手机号码之间用英文“,”分开，最大支持500个手机号码，同一请求中，最好不要出现相同的手机号码
    $message = "尊敬的用户您好，您的验证码[{$AuthCode}]有了新的进展";    //内容
    $signature = '【餐匠官网】';
    $url = 'http://101.200.29.88:8082/SendMT/SendMessage';
    $message = urlencode($signature . $message);
    $params = 'CorpID=' . $userName . '&Pwd=' . $userPass . '&subid=' . '&Mobile=' . $mobile . '&Content=' . $message;
    $re = curl_get_contents($url, $params);
    return true;
}

/**
 * 获取用户Ip
 * @return bool
 */
function getRealIp()
{
    $ip = false;
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) {
            array_unshift($ips, $ip);
            $ip = FALSE;
        }
        for ($i = 0; $i < count($ips); $i++) {
            if (!eregi("^(10│172.16│192.168).", $ips[$i])) {
                $ip = $ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

/*
 * CURL
 */
function curl_get_contents($url, $option = array(), $header = array(), $type = 'POST', $setopt = 10)
{
    $curl = curl_init(); // 启动一个CURL会话
    if ($curl !== false) {
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)'); // 模拟用户使用的浏览器
        if (!empty ($option)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $option); // Post提交的数据包
        }
        curl_setopt($curl, CURLOPT_TIMEOUT, $setopt); // 设置超时限制防止死循环
        if (empty($header)) {
            $header = array();
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // 设置HTTP头
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $type);
        curl_getinfo($curl, CURLINFO_HTTP_CODE); // 获取Status Code 正确返回200
        $result = curl_exec($curl); // 执行操作
        curl_close($curl); // 关闭CURL会话
        return $result;
    } else {
        return false;
    }
}

/**
 * var_dump打印
 * @param $arr
 */
function v($arr)
{
    echo '<pre>';

    var_dump($arr);

    echo '</pre>';
}

/**
 * var_export打印
 * @param $data
 */
function vv($data)
{
    echo "<pre/>";
    var_export($data);
}

/**
 * 获取上一个页面地址
 */
function get_history()
{
    return $_SERVER['HTTP_REFERER'];
}

/**
 * 获取用户审核状态值
 * 注册成功是否审核通过 0未提交审核  1审核状态中 2审核未通过 3审核通过
 * $stateId 状态值
 */
function getauditInformstate($comuser_state)
{
    $str = '';
    switch ($comuser_state) {
        case 0:
            $str = '未提交审核';
            break;
        case 1:
            $str = '审核状态中';
            break;
        case 2:
            $str = '审核未通过';
            break;
        case 3:
            $str = '审核通过';
            break;
    }
    return $str;
}

//创建TOKEN
function creatToken()
{
    $code = chr(mt_rand(0xB0, 0xF7)) . chr(mt_rand(0xA1, 0xFE)) . chr(mt_rand(0xB0, 0xF7)) . chr(mt_rand(0xA1, 0xFE)) . chr(mt_rand(0xB0, 0xF7)) . chr(mt_rand(0xA1, 0xFE));
    session('TOKEN', authcode($code));
}

//判断TOKEN
function checkToken($token)
{
    if ($token == session('TOKEN')) {
        session('TOKEN', NULL);
        return TRUE;
    } else {
        return FALSE;
    }
}

/**
 * 将字符串转码
 * @param $str 传入字符串0
 * @param $toEncode 目标编码格式
 * @return string 返回字符串
 */
function str_auth_decode($str, $toEncode = 'UTF-8')
{
    $encode = mb_detect_encoding($str, array("ASCII", 'UTF-8', "GB2312", "GBK", 'BIG5'));
    $str_encode = mb_convert_encoding($str, $toEncode, $encode);
    return $str_encode;
}

/* 加密TOKEN */
function authcode($str)
{
    $key = "ANDIAMON";
    $str = substr(md5($str), 8, 10);
    return md5($key . $str);
}

/**
 * jquery 分页显示插件 需要引入 jquery pagination.css pagination.js
 * @param $pageCount 总页数
 * @param $current 当前页
 * @param $url 跳转地址
 * @param string $pageClass class
 */
function PageShow($pageCount, $current, $url, $pageClass = '.M-box1')
{
    $str = <<<str
        <script type="text/javascript">
          $('{$pageClass}').pagination({
                pageCount: {$pageCount},
                coping: true,
                current: {$current},
                prevContent: '上页',
                nextContent: '下页',
                callback: function (api) {
                window.location.href = '{$url}/p/' + api.getCurrent();
            }
            });
        </script>
str;
    echo $str;


}

/**
 * [time_tran PHP把时间转换成几分钟前、几小时前、几天前的几个函数、类分享]
 * @param  [type] $the_time [传入的时间戳]
 * @return [type]           [description]
 */
function time_tran($the_time)
{
    $now_time = date("Y-m-d H:i:s", time());
    $now_time = strtotime($now_time);
    $show_time = $the_time;
    $dur = $now_time - $show_time;
    if ($dur < 0) {
        return $the_time;
    } else {
        if ($dur < 60) {
            return $dur . '秒前';
        } else {
            if ($dur < 3600) {
                return floor($dur / 60) . '分钟前';
            } else {
                if ($dur < 86400) {
                    return floor($dur / 3600) . '小时前';
                } else {
                    if ($dur < 259200) {//3天内
                        return floor($dur / 86400) . '天前';
                    } else {
                        return '3天前';
                    }
                }
            }
        }
    }
}

/***
 * 浏览记录实现方法开始 +---------------------------------------------------------- +----------------------------------------------------------
 */

/**
 * +----------------------------------------------------------
 * 浏览记录按照时间排序
 * +----------------------------------------------------------
 */
function my_sort($a, $b)
{
    $a = substr($a, 1);
    $b = substr($b, 1);
    if ($a == $b) return 0;
    return ($a > $b) ? -1 : 1;
}

/**
 * +----------------------------------------------------------
 * 网页浏览记录生成
 * +----------------------------------------------------------
 */
function cookie_history($t_name, $t_id, $sex, $name_img, $l_pay, $thisurl, $pre)
{
    $dealinfo['t_id'] = $t_id;
    $dealinfo['name'] = $t_name;
    $dealinfo['sex'] = $sex;
    $dealinfo['img'] = $name_img;
    $dealinfo['url'] = $thisurl;
    $dealinfo['skill'] = $l_pay;

    if (!empty($pre)) {
        $dealinfo['pre'] = $pre;
    }
    $time = 't' . NOW_TIME;
    $cookie_history = array($time => json_encode($dealinfo));  //设置cookie
    if (!cookie('history')) {//cookie空，初始一个
        cookie('history', $cookie_history);
    } else {
        $new_history = array_merge(cookie('history'), $cookie_history);//添加新浏览数据
        uksort($new_history, "my_sort");//按照浏览时间排序
        $history = array_unique($new_history);
        if (count($history) > 4) {
            $history = array_slice($history, 0, 4);
        }
        cookie('history', $history);
    }
}

/*
  +----------------------------------------------------------
 * 网页浏览记录读取
  +----------------------------------------------------------
 */
function cookie_history_read()
{
    $arr = cookie('history');
    foreach ((array)$arr as $k => $v) {
        $list[$k] = json_decode($v, true);
    }
    return $list;
}

/**
 * 浏览记录实现方法结束 +---------------------------------------------------------- +---------------------------------------------------------- +----------------------------------------------------------
 */

/** 支付方法 2017-6-27
 * @param $id
 */
function pdy_id($id)
{
    if ($id == 1) {
        return $pay_id_name = '微信';
    } else if ($id == 2) {
        return $pay_id_name = '支付宝';
    } else if ($id == 3) {
        return $pay_id_name = '银联';
    } else if ($id == 4) {
        return $pay_id_name = '云';
    }
}


/** 支付方法 2017-6-27
 * @param $id  订单状态（0 未付款 ,1 已付款 ，2 已发货 ，3 未发货 ，4 已收货 ）
 */
function goods_order_info($id)
{
    if ($id == 0) {
        return $goods_order_info = '未付款';
    } else if ($id == 1) {
        return $goods_order_info = '已付款';
    } else if ($id == 2) {
        return $goods_order_info = '已发货';
    } else if ($id == 3) {
        return $goods_order_info = '未发货';
    } else if ($id == 4) {
        return $goods_order_info = '已收货';
    }
}


/**2017-6-27
 * 获得定单号
 *
 * @return string
 */
function getOrderId()
{
    $year_code = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    $i = intval(date('Y')) - 2010 - 1;

    return $year_code[$i] . date('md') .
        substr(time(), -5) . substr(microtime(), 2, 5) . str_pad(mt_rand(1, 99), 2, '0', STR_PAD_LEFT);
}

/**
 * 格式化金额
 *
 * @param int $money
 * @param int $len
 * @param string $sign
 * @return string
 */
function format_money($money, $len = 2, $sign = '￥', $ppt = '元')
{
    $negative = $money > 0 ? '' : '-';
    $int_money = intval(abs($money));
    $len = intval(abs($len));
    $decimal = '';//小数
    if ($len > 0) {
        $decimal = '.' . substr(sprintf('%01.' . $len . 'f', $money), -$len);
    }
    $tmp_money = strrev($int_money);
    $strlen = strlen($tmp_money);
    for ($i = 3; $i < $strlen; $i += 3) {
        $format_money .= substr($tmp_money, 0, 3) . ',';
        $tmp_money = substr($tmp_money, 3);
    }
    $format_money .= $tmp_money;
    $format_money = strrev($format_money);
    return $sign . $negative . $format_money . $decimal . ' ' . $ppt;
}


/**
 * 对银行卡号进行掩码处理
 * @param  string $bankCardNo 银行卡号
 * @return string             掩码后的银行卡号
 */
function formatBankCardNo($bankCardNo)
{
    //截取银行卡号前4位
    $prefix = substr($bankCardNo, 0, 4);
    //截取银行卡号后4位
    $suffix = substr($bankCardNo, -4, 4);

    $maskBankCardNo = $prefix . " **** **** **** " . $suffix;

    return $maskBankCardNo;
}


/**
 * 对银行卡号进行掩码处理
 * @param  string $bankCardNo 银行卡号
 * @return string             掩码后的银行卡号
 */
function formatBank($bankCardNo)
{
    //截取银行卡号后4位
    return $suffix = substr($bankCardNo, -4, 4);
}



function PasswordEncryption($password)
{
    $key = 'qianchu668';
    return md5($password . $key);

}


/** php 将秒数转换为时间（年、天、小时、分、秒）
 * @param $time
 * @return bool|string
 */
function Sec2Time($time)
{
    if (is_numeric($time)) {
        $value = array(
            "years" => 0, "days" => 0, "hours" => 0,
            "minutes" => 0, "seconds" => 0,
        );
        if ($time >= 31556926) {
            $value["years"] = floor($time / 31556926);
            $time = ($time % 31556926);
        }
        if ($time >= 86400) {
            $value["days"] = floor($time / 86400);
            $time = ($time % 86400);
        }
        if ($time >= 3600) {
            $value["hours"] = floor($time / 3600);
            $time = ($time % 3600);
        }
        if ($time >= 60) {
            $value["minutes"] = floor($time / 60);
            $time = ($time % 60);
        }
        $value["seconds"] = floor($time);
        //return (array) $value;
        $t = $value["years"] . "年" . $value["days"] . "天" . " " . $value["hours"] . "小时" . $value["minutes"] . "分" . $value["seconds"] . "秒";
        Return $t;

    } else {
        return (bool)FALSE;
    }

}

/**  php 时间转换，秒数的转换成 0:31:5
 * @param $num
 * @return string
 */
function dataformat($num)
{
    $hour = floor($num / 3600);
    $minute = floor(($num - 3600 * $hour) / 60);
    $second = floor((($num - 3600 * $hour) - 60 * $minute) % 60);
    return $hour . ':' . $minute . ':' . $second;
}


/** 传递一个数组获得指定订单的状态
 * @param $Soldout
 * @return mixed
 */
function goods_order_info_state($Soldout)
{
    foreach ($Soldout as &$v) {
        $v['goods_order_info'] = goods_order_info($v['is_can']);
        if ($v['is_show'] == 1) {
            $v['goods_order_info'] = '无效';
        }
    }
    return $Soldout;
}

/*七牛云使用开始--------------------------------------------------------------------------------------------*/
function Qiniu_Encode($str) // URLSafeBase64Encode
{
    $find = array('+', '/');
    $replace = array('-', '_');
    return str_replace($find, $replace, base64_encode($str));
}

function Qiniu_Sign($url)
{
    $setting = C('UPLOAD_SITEIMG_QINIU');
    $duetime = NOW_TIME + 86400;//下载凭证有效时间
    $DownloadUrl = $url . '?e=' . $duetime;
    $Sign = hash_hmac('sha1', $DownloadUrl, $setting ["driverConfig"] ["secrectKey"], true);
    $EncodedSign = Qiniu_Encode($Sign);
    $Token = $setting ["driverConfig"] ["accessKey"] . ':' . $EncodedSign;
    $RealDownloadUrl = $DownloadUrl . '&token=' . $Token;
    return $RealDownloadUrl;
}


//PHP上传音视频
/**
 * @param $nametype  file->name的值
 * @return bool   返回上传成功的七牛服务器路径
 */
function upload_video($nametype)
{

    $upload = new \Think\Upload($nametype);// 实例化上传类
    $upload->maxSize = 0;// 设置附件上传大小 kdj.f4v
    $upload->exts = array('flv', 'mp3', 'mp4');// 设置附件上传类型
    $upload->savePath = 'video/';// 设置附件上传目录
    $info = $upload->upload();
    ob_end_clean();
    if (!$info) {// 上传错误提示错误信息
        return false;
    } else {// 上传成功
        return $info[$nametype]['url'];
    }
}


// 七牛上传图片
/**
 * @param $imgdata 图片资源
 * @return array
 */
function uploadthinkphpOne($imgdata)
{
    $setting = C('UPLOAD_SITEIMG_QINIU');
    $UPLOAD = new \Think\Upload($setting);
    $info = $UPLOAD->uploadOne($imgdata);
    return $imgurl = $info['url'] . '?imageView2/0/format/webp/q/75|watermark/2/text/6aSQ5Yyg/font/5a6L5L2T/fontsize/440/fill/IzFCMUIxRA==/dissolve/100/gravity/SouthWest/dx/20/dy/20|imageslim';
}


// 七牛上传图片
/**
 * @param $imgdata 图片资源
 * @return array
 */
function uploadthinkphpOne_p($imgdata)
{
    $setting = C('UPLOAD_SITEIMG_QINIU');
    $UPLOAD = new \Think\Upload($setting);
    $info = $UPLOAD->uploadOne($imgdata);
    return $imgurl = $info['url'] . '?imageView2/1/w/120/h/60/q/75|imageslim';
}

/**
 * @param $imgdata
 * @return string
 * //视频上传的方法 后获取  一张缩略图文件路径   http://othe89t1b.bkt.clouddn.com/job_cat.mp4 //这个是参数 ?vframe/jpg/offset/21/w/420/h300
 *  获取视频长度                            http://othe89t1b.bkt.clouddn.com/ajq         //这个是参数 ?avinfo
 */
function uploadthinkphpOne_video($imgdata)
{
    $setting = C('UPLOAD_SITEIMG_QINIU');
    $UPLOAD = new \Think\Upload($setting);
//    $UPLOAD->exts=array('mp3', 'mp4', 'flv');// 设置附件上传类型
    $info = $UPLOAD->uploadOne($imgdata);
//    echo $UPLOAD->getError();
    return $imgurl = $info['url'];
}


//删除七牛上的文件
/*
 * $file 删除的文件名称  不是路径
 * $bucket 空间名称
 * $domin 空间默认域名
 */
function QiniuDel($file)
{
    $config = array(
        'driverConfig' => array(
            'secretKey' => 'bunfi_QkAKCJe4edqL8KjabozIY2QvAuJVPl22n7',//申请的key
            'accessKey' => 'bVBZvf5sMq-I6uS3ZPZD0bQzXgMjsL01yxWoswfl',//申请的密码
            'bucket' => 'canjiang',//空间名称
            'domain' => 'othe89t1b.bkt.clouddn.com',//临时域名
        ),
    );
    $Upload = new \Think\Upload\Driver\Qiniu\QiniuStorage($config['driverConfig']);
    $info = $Upload->del($file);
    if (is_array($info)) {
        return true;
    } else {
        return false;
    }
}

/**
 * @param $url_video 视频资源链接
 */
function duration($url_video)
{

    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $url_video . '?avinfo');
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //执行命令
    $datap = curl_exec($curl);
    //关闭URL请求
    curl_close($curl);
    //显示获得的数据
    $v = json_decode($datap, true);

    $p = intval($v['format']['duration']);

    return $p;
}


/*七牛云使用结束--------------------------------------------------------------------------------------------*/


function getpage($count, $pagesize = 10)
{
    $p = new Think\Page($count, $pagesize);
    $p->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
    $p->setConfig('prev', '上一页');
    $p->setConfig('next', '下一页');
    $p->setConfig('last', '末页');
    $p->setConfig('first', '首页');
    $p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
    $p->lastSuffix = false;//最后一页不显示为总页数
    return $p;
}


/**
 * @param $ks 开始年份
 * @param $kk 开始月份
 * @param $js 结束年份
 * @param $jj 结束月份
 * @return float时间处理函数
 * Timeconversionyear('2016','3','2017','1');
 * 结果是     年数
 */

function Timeconversionyear($kss, $kks, $jss, $jjs, $num)
{
    $ks = mb_substr($kss, 0, -$num, 'utf-8');
    $kk = mb_substr($kks, 0, -$num, 'utf-8');
    $js = mb_substr($jss, 0, -$num, 'utf-8');
    $jj = mb_substr($jjs, 0, -$num, 'utf-8');
    if ($jj > $kk) {
        $ppt = ($js - $ks) * 12 + ($jj - $kk);
    } else {
        $ppt = ($js - $ks - 1) * 12 + ($jj + 12 - $kk);
    }
    return $unm = ceil($ppt / 12);
}

/** 时间处理函数
 * @param $a
 * @param $b
 * @param $c
 * @param $d
 * 结果  [time] => 1059667200,1490976000
 */
function Time_data_sjaincuo($a, $b, $c, $d, $num)
{
    return $time = strtotime(mb_substr($a, 0, -$num, 'utf-8') . '-' . mb_substr($b, 0, -$num, 'utf-8')) . ',' . strtotime(mb_substr($c, 0, -$num, 'utf-8') . '-' . mb_substr($d, 0, -$num, 'utf-8'));
}


/** 时间处理函数
 * @param $a
 * @param $b
 * @param $c
 * @param $d
 * 结果  [time] => 1059667200,1490976000
 */
function Time_data_sjaincuo_save($a, $b, $c, $d, $num)
{
    return $time = mb_substr($a, 0, -$num, 'utf-8') . ',' . mb_substr($b, 0, -$num, 'utf-8') . ',' . mb_substr($c, 0, -$num, 'utf-8') . ',' . mb_substr($d, 0, -$num, 'utf-8');
}

/**
 * @param $id 1全职  2 兼职  3 实习
 */
function gz_status($id)
{
    if ($id == 1) {
        return $pay_id_name = '全职';
    } else if ($id == 2) {
        return $pay_id_name = '兼职';
    } else if ($id == 3) {
        return $pay_id_name = '实习';
    }
}

/**
 * @param $id 1良好    2一般  3熟练   4精通
 */
function jn_status($id)
{
    if ($id == 1) {
        return $pay_id_name = '良好';
    } else if ($id == 2) {
        return $pay_id_name = '一般';
    } else if ($id == 3) {
        return $pay_id_name = '熟练';
    } else if ($id == 4) {
        return $pay_id_name = '精通';
    }
}


/**
 * @param $id 1 身份证 2护照  3营业执照
 */
function typeficate_name($id)
{
    if ($id == 1) {
        return $pay_id_name = '身份证';
    } else if ($id == 2) {
        return $pay_id_name = '护照';
    } else if ($id == 3) {
        return $pay_id_name = '营业执照';
    }
}

/**
 * @param $array
 * @return array 数组
 */
//删除数组中相同元素，只保留一个相同元素
function formatArray($array)
{
    sort($array);
    $tem = "";
    $temarray = array();
    $j = 0;
    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i] != $tem) {
            $temarray[$j] = $array[$i];
            $j++;
        }
        $tem = $array[$i];
    }
    return $temarray;
}

//测试 调用函数
/**
 * @param $base64    data:image/png;base64 -图片上传
 * @return bool|string
 */
function base64_upload($base64)
{
    $base64_image = str_replace(' ', '+', $base64);
    //post的数据里面，加号会被替换为空格，需要重新替换回来，如果不是post的数据，则注释掉这一行
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image, $result)) {
        //匹配成功
        if ($result[2] == 'jpeg') {
            $image_name = uniqid() . '.jpg';
            //纯粹是看jpeg不爽才替换的
        } else {
            $image_name = uniqid() . '.' . $result[2];
        }
        $image_file = "./Public/update/nameimg/{$image_name}";
        //服务器文件存储路径
        if (file_put_contents($image_file, base64_decode(str_replace($result[1], '', $base64_image)))) {
            return "/Public/update/nameimg/" . $image_name;
        } else {
            return false;
        }
    } else {
        return $base64;
    }

}


function randpw($len = 8, $format = 'ALL')
{
    $is_abc = $is_numer = 0;
    $password = $tmp = '';
    switch ($format) {
        case 'ALL':
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
        case 'CHAR':
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            break;
        case 'NUMBER':
            $chars = '0123456789';
            break;
        case 'character':
            $chars = '什么样的主义关键要看这个主义耳主义本质的认识对中国特色社会主义规律的把握已创新以新的思路新的战略新的举措决胜全面建成小康社会夺取中国特色社会主义新的伟大胜利';
            break;
        default :
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
    } // www.jb51.net
    mt_srand((double)microtime() * 1000000 * getmypid());
    while (strlen($password) < $len) {
        $tmp = substr($chars, (mt_rand() % strlen($chars)), 1);
        if (($is_numer <> 1 && is_numeric($tmp) && $tmp > 0) || $format == 'CHAR') {
            $is_numer = 1;
        }
        if (($is_abc <> 1 && preg_match('/[a-zA-Z]/', $tmp)) || $format == 'NUMBER') {
            $is_abc = 1;
        }
        $password .= $tmp;
    }
    if ($is_numer <> 1 || $is_abc <> 1 || empty($password)) {
        $password = randpw($len, $format);
    }
    return $password;
}


/**
 *判断数字的范围
 */
function Determinetherangeofnumbers($foo)
{
    if ($foo > 0 && $foo < 1) return $bar = 1;
    elseif ($foo > 1 && $foo < 3) return $bar = 2;
    elseif ($foo > 3 && $foo < 5) return $bar = 3;
    elseif ($foo > 5 && $foo < 10) return $bar = 4;
    elseif ($foo > 10) return $bar = 5;
    elseif ($foo = 0) return $bar = 6;
}

/**
 * 去除字符串内部空格 和 换行符
 */
function trimall($str)
{
    $qian = array(" ", "　", "\t", "\n", "\r");
    return str_replace($qian, '', $str);
}


/**
 * 去除字符串中特殊符号
 * @param $str
 * @return string
 */
function strFilter($str)
{
    $str = str_replace('`', '', $str);
    $str = str_replace('·', '', $str);
    //$str = str_replace('~', '', $str);
    $str = str_replace('!', '', $str);
    $str = str_replace('！', '', $str);
    $str = str_replace('@', '', $str);
    $str = str_replace('#', '', $str);
    $str = str_replace('$', '', $str);
    $str = str_replace('￥', '', $str);
    $str = str_replace('%', '', $str);
    $str = str_replace('^', '', $str);
    $str = str_replace('……', '', $str);
    $str = str_replace('&', '', $str);
    $str = str_replace('*', '', $str);
    $str = str_replace('(', '', $str);
    $str = str_replace(')', '', $str);
    $str = str_replace('（', '', $str);
    $str = str_replace('）', '', $str);
    $str = str_replace('-', '', $str);
    $str = str_replace('_', '', $str);
    $str = str_replace('——', '', $str);
    $str = str_replace('+', '', $str);
    $str = str_replace('=', '', $str);
    $str = str_replace('|', '', $str);
    $str = str_replace('\\', '', $str);
    $str = str_replace('[', '', $str);
    $str = str_replace(']', '', $str);
    $str = str_replace('【', '', $str);
    $str = str_replace('】', '', $str);
    $str = str_replace('{', '', $str);
    $str = str_replace('}', '', $str);
    $str = str_replace(';', '', $str);
    $str = str_replace('；', '', $str);
    $str = str_replace(':', '', $str);
    $str = str_replace('：', '', $str);
    $str = str_replace('\'', '', $str);
    $str = str_replace('"', '', $str);
    $str = str_replace('“', '', $str);
    $str = str_replace('”', '', $str);
    $str = str_replace(',', '', $str);
    $str = str_replace('，', '', $str);
    $str = str_replace('<', '', $str);
    $str = str_replace('>', '', $str);
    $str = str_replace('《', '', $str);
    $str = str_replace('》', '', $str);
    $str = str_replace('.', '', $str);
    $str = str_replace('。', '', $str);
    $str = str_replace('/', '', $str);
    $str = str_replace('、', '', $str);
    $str = str_replace('?', '', $str);
    $str = str_replace('？', '', $str);
    return trim($str);
}


/**
 * @param $id 1餐饮品牌 2餐饮开店 3餐饮供应链 4商业服务 5餐饮人才 6餐饮商学院 7移动拍客  8总餐匠责任
 */
function Mealmakerresponsibility($id)
{
    if ($id == 1) {
        return $pay_id_name = '餐饮品牌';
    } else if ($id == 2) {
        return $pay_id_name = '餐饮开店';
    } else if ($id == 3) {
        return $pay_id_name = '餐饮供应链';
    } else if ($id == 4) {
        return $pay_id_name = '商业服务';
    } else if ($id == 5) {
        return $pay_id_name = '餐饮人才';
    } else if ($id == 6) {
        return $pay_id_name = '餐饮商学院';
    } else if ($id == 7) {
        return $pay_id_name = '移动拍客';
    } else if ($id == 8) {
        return $pay_id_name = '总餐匠责任';
    }
}

/**
 * 取出数据表的字段
 * @param $mod M() mode
 * @return string
 */
function getModelField($mod, $first)
{
    $value = $mod->find();
    $key = array_keys($value);
    array_walk($key, function (&$v) use ($first) {
        $v = $first . '.' . $v;
    });
    return implode(',', $key);
}


/**
 * [releasetime 发布时间 转换]
 * @param  [type] $id [id]
 * @return [type]     [description]
 */
function releasetime($id)
{
    if ($id == 1) {
        return $pay_id_name = '不限';
    } else if ($id == 2) {
        return $pay_id_name = '今天';
    } else if ($id == 3) {
        return $pay_id_name = '最近三天';
    } else if ($id == 4) {
        return $pay_id_name = '最近一周';
    } else if ($id == 5) {
        return $pay_id_name = '最近一个月';
    }
}


/**
 * PHP获取一段代码中指定文字后的内容
 * @param $input  //截取的字符
 * @param $start  //要截取的字符串
 */
function get_between($input, $start)
{
    $arr = explode($input, $start);
    return $arr[count($arr) - 1];
}


/**
 * @param $kw1   需要截取的字符串
 * @param $mark1 开始的字符串
 * @param $mark2 结束的字符串
 * @return 返回   $mark1和$mark2字符串
 */
function getNeedBetween($kw1, $mark1, $mark2)
{
    $kw = $kw1;
    $kw = '123' . $kw . '123';
    $st = stripos($kw, $mark1);
    $ed = stripos($kw, $mark2);
    if (($st == false || $ed == false) || $st >= $ed)
        return 0;
    $kw = substr($kw, ($st + 1), ($ed - $st - 1));
    return $kw;
}

/**
 * 格式化-图片属性--title-alt
 */
function formattingImage($title = '餐将官网', $alt = '餐将官网')
{
    $str = <<<str
    <script type="text/javascript">
        $(function(){
            $('img').attr('title',"餐匠-{$title}");
            $('img').attr('alt',"餐匠-{$alt}");
        })
    </script>
str;
    echo $str;
}


//处理人气
function views_p($foo)
{
    if ($foo > 10000)
        return $bar = '★★★★★';
    elseif ($foo > 6000 && $foo < 10000)
        return $bar = '★★★★';
    elseif ($foo > 4000 && $foo < 6000)
        return $bar = '★★★';
    elseif ($foo > 2000 && $foo < 4000)
        return $bar = '★★';
    elseif ($foo > 0 && $foo < 2000)
        return $bar = '★';
}

/**
 * 格式化供应链-产品供求类型
 *
 */
function getProviderMamentCode($num)
{
    $str = '';
    switch ($num) {
        case 0:
            $str = '二手转让';
            break;
        case 1:
            $str = '采购招标';
            break;
    }
    return $str;
}

/**
 * 格式化供应链-店铺供求
 *
 */
function getPorviderFacadeCode($num)
{
    $str = '';
    switch ($num) {
        case 0:
            $str = '求租店铺';
            break;
        case 1:
            $str = '出租店铺';
            break;
    }
    return $str;
}





    /*浏览量处理采用thinkphp*********************/
    /**浏览量处理采用thinkphp   自动加一的方法
     * @param $mysql      数据库名字
     * @param $star_id    主键id
     * @param $id         主键id的值
     * @param $field      字段
     */
function addviews($mysql, $star_id, $id, $field)
    {
        $where = [
            $star_id => $id
        ];
        M("$mysql")->where($where)->setInc("$field", 1);

    }

?>