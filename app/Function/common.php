<?php
/**
 * Created by PhpStorm.
 * User: shirley
 * Date: 2018/2/12
 * Time: 下午2:30
 */
/**
 * 将数组转换为url参数
 */
if(!function_exists('arrayBuildUrl')) {
    function arrayBuildUrl($array, $url = '')
    {
        if(!$array) {
            $urlString = '';
        } else {
            $urlString = http_build_query($array);
        }

        if($url) {
            $check = strpos($url, '?');
            //如果存在 ?
            if($check !== false) {
                //如果 ? 后面没有参数，如 http://www.baidu.com/index.php?
                if(substr($url, $check+1) == '') {
                    //可以直接加上附加参数
                    $new_url = $url;
                } else {//如果有参数，如：http://www.baidu.com/index.php?ID=12
                    $new_url = $url.'&';
                }
            } else { //如果不存在 ?
                $new_url = $url.'?';
            }
            $urlString = $new_url.$urlString;
        }
        $urlString = trim($urlString, '?');
        $urlString = trim($urlString, '&');
        return $urlString;
    }
}

/**
 * 给url链接上拼接参数
 */
if ( ! function_exists('urlAddParams')) {
    function urlAddParams($url, $params = []) {
        $url = urldecode(rtrim($url));
        $url = rtrim($url, '&?');
        if (stripos($url, '?') !== false) {
            $url = $url.'&';
        } else {
            $url .= '?';
        }

        if ($params) {
            foreach ($params as $key => $value) {
                if (is_array($value)){
                    foreach($value as $k=>$v){
                        $url .= $key.'['.$k.']='.urlencode($v).'&';
                    }
                } else {
                    $url .= $key.'='.urlencode($value).'&';
                }
            }
        }

        return rtrim($url, '&');
    }
}

/**
 * 修改url参数
 */
if ( ! function_exists('modifyUrlParam')) {
    function modifyUrlParam($url, $params){
        if ( ! $url) return $url;
        if ( ! $params) return $url;

        $queryInfo = parse_url($url, PHP_URL_QUERY);
        if ($queryInfo) {
            $queryInfo = convertUrlQuery($queryInfo);
        }

        if ($queryInfo) {
            foreach($queryInfo as $key => $value) {
                foreach($params as $k=>$v) {
                    if ($key == $k) {
                        $queryInfo[$key] = $v;
                    }
                }
            }
            foreach($params as $k=>$v){
                if ( ! in_array($k, array_keys($queryInfo)))
                    $queryInfo[$k] = $v;
            }
        } else {
            $queryInfo = $params;
        }

        //  dd($queryInfo);

        return explode('?', $url)[0].'?'.http_build_query($queryInfo);
    }
}

/**
 * query  转数组
 */
if ( ! function_exists('convertUrlQuery')) {
    function convertUrlQuery($query){
        $queryParts = explode('&', $query);
        $params = [];
        foreach ($queryParts as $param) {
            $item = explode('=', $param);
            $params[$item[0]] = $item[1];
        }
        return $params;
    }
}


/**
 * 生成ajax返回数据
 */
if (!function_exists('jsonMsg')) {
    function jsonMsg($info = 'ok', $data = []) {
        $json = ['info'=>$info];
        $json['data'] = $data;

        return response()->json($json);
    }
}



/**
 * curl
 * @param string $url
 * @param string $data
 * @param int $is_json 1:是json数据 0:非json
 * @param int $json_deep 1:需要json_decode时带上参数true 0:不需要带true
 * @return mixed
 */
if (!function_exists('laravelCurl')) {
    function laravelCurl($url, $data = null, $is_json = 0, $json_deep = 0, $headers = []) {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // 增加header头
        if($headers) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        $output = curl_exec($curl);

        curl_close($curl);

        if ($is_json) {
            if ($json_deep) {
                $output = json_decode($output, true);
            } else {
                $output = json_decode($output);
            }
        }

        return $output;
    }
}

if (!function_exists('priceExrate')) {
    function priceExrate($symbol = 'CNY')
    {
        $url = 'https://data.block.cc/api/v1/exrate?base=USD&symbol=CNY';
        $res = laravelCurl($url);
        $curlData = [];
        if($res) {
            $curlData = json_decode($res, true);
        }
        $rates = !empty($curlData['data']['rates']) ? $curlData['data']['rates'] : [];
        if('CNY' == $symbol) {
            return $rates['CNY'];
        }

        return !empty($symbol[$symbol]) ? $symbol[$symbol] : '';
    }
}

if (!function_exists('coinsPrice')) {
    function coinsPrice($coisnName = 'BTC')
    {
        $url = 'https://data.block.cc/api/v1/price?symbol='.$coisnName;
        $res = laravelCurl($url);
        $curlData = $res ? json_decode($res,true) : '';

        if(!$curlData || (!empty($curlData['code'])&&$curlData['code']>0)) {
            return '';
        }

        return !empty($curlData['data']) ? $curlData['data'] : [];
    }
}

/**
 * 截取N位小数,舍去后面的位数
 * @author lulijuan
 * @param $number 传入的数值
 * @param $length 保留的小数位数
 * @return float 返回值
 */
if(!function_exists('substrFloatNums')) {
    function substrFloatNums($number, $length=2)
    {
        //2位的时候
        if(2==$length) {
            return sprintf("%.2f",substr(sprintf("%.3f", $number), 0, -1));
        }
        //其它位数
        $number = (float)$number;
        $intStr = strstr($number, '.', True);
        $floatStr = substr(strstr($number, '.'),0,$length+1);
        $floatNumber = $intStr.$floatStr;
        return  (float)$floatNumber;
    }
}

if(!function_exists('priceForamt')) {
    function priceForamt($price = 0)
    {
        $ThenThousand = 10000;// 1万
        $hundredMillion = 100000000; // 1亿

        if($price<$ThenThousand) return substrFloatNums($price);

        if($price>=$hundredMillion) {
            $format = substrFloatNums($price/$hundredMillion).'亿';
        }else{
            $format = substrFloatNums($price/$ThenThousand).'万';
        }
        return $format;
    }
}
