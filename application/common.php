<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function get( $url, $_header = NULL )
{
    $curl = curl_init();
    //curl_setopt ( $curl, CURLOPT_SAFE_UPLOAD, false);
    if( stripos($url, 'https://') !==FALSE )
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    if ( $_header != NULL )
    {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $_header);
    }
    $ret	= curl_exec($curl);
    $info	= curl_getinfo($curl);
    curl_close($curl);

    if( intval( $info["http_code"] ) == 200 )
    {
        return $ret;
    }

    return false;
}
/*
 * post method
 */
function post( $url, $param )
{
    $oCurl = curl_init ();
    curl_setopt ( $oCurl, CURLOPT_SAFE_UPLOAD, false);
    if (stripos ( $url, "https://" ) !== FALSE) {
        curl_setopt ( $oCurl, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $oCurl, CURLOPT_SSL_VERIFYHOST, false );
    }

    curl_setopt ( $oCurl, CURLOPT_URL, $url );
    curl_setopt ( $oCurl, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt ( $oCurl, CURLOPT_POST, true );
    curl_setopt ( $oCurl, CURLOPT_POSTFIELDS, $param );
    $sContent = curl_exec ( $oCurl );
    $aStatus = curl_getinfo ( $oCurl );
    curl_close ( $oCurl );
    if (intval ( $aStatus ["http_code"] ) == 200) {
        return $sContent;
    } else {
        return false;
    }
}

function https_request($url, $data = null,$time_out=60,$out_level="s",$headers=array())
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_NOSIGNAL, 1);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    if($out_level=="s")
    {
        //超时以秒设置
        curl_setopt($curl, CURLOPT_TIMEOUT,$time_out);//设置超时时间
    }elseif ($out_level=="ms")
    {
        curl_setopt($curl, CURLOPT_TIMEOUT_MS,$time_out);  //超时毫秒，curl 7.16.2中被加入。从PHP 5.2.3起可使用
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    if($headers)
    {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);//如果有header头 就发送header头信息
    }
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}