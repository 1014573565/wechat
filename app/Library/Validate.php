<?php

namespace app\Library;

class Validate
{
    /**
     * 验证 QQ.
     */
    public static function qq($str)
    {
        if (!is_numeric($str)) {
            return false;
        }
        if (strlen($str) < 4 || strlen($str) > 13) {
            return false;
        }

        return true;
    }

    /**
     * 验证 手机.
     */
    public static function mobile($pStr)
    {
        if (11 != strlen($pStr)) {
            return false;
        }

        return preg_match('/13[0-9]{9}|15[0-9]{9}|17[0-9]{9}|18[0-9]{9}|147[0-9]{8}|177[0-9]{8}/', $pStr);
    }

    /**
     * 验证 用户名.
     */
    public static function name($pStr)
    {
        return preg_match("/^[0-9a-zA-Z\x80-\xff]+$/", $pStr);
    }

    /**
     * 验证 身份证
     */
    public static function identify($pStr)
    {
        $id15 = '/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$/';
        $id18 = '/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}(\d|x|X)$/';
        if (preg_match($id15, $pStr)) {
            return true;
        } elseif (preg_match($id18, $pStr)) {
            return true;
        }

        return false;
    }

    /**
     * 验证护照.
     */
    public static function pidentify($pStr)
    {
        $str = '/^(P.?\d{7}|E\d{8}|G\d{8}|S.?\d{7,8}|D\d+|1[4,5]\d{7})$/';
        if (preg_match($str, $pStr)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 验证 字母数字.
     */
    public static function az09($pStr)
    {
        return preg_match('/^[0-9a-zA-Z-_]+$/', $pStr);
    }

    /**
     * 汉字字母数字_.
     */
    public static function vname($pStr)
    {
        return preg_match("/^(?!_)(?!.*?_$)[a-zA-Z0-9_\x80-\xff]+$/", $pStr);
    }

    /**
     * 危险字符(XSS, 注入).
     */
    public static function safe($pStr)
    {
        return preg_match("/^[0-9a-zA-Z\x80-\xff@_?&=:.\-]+$/", $pStr);
    }

    /**
     * ip地址查询确认是否国内.
     */
    public static function cnip($ip)
    {
        $url = "http://ip.taobao.com/service/getIpInfo.php?ip={$ip}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        if (!$ip_return = curl_exec($ch)) {
            return false;
        }
        $ip = json_decode($ip_return, true);
        if (!isset($ip['code']) || $ip['code'] == '1') {
            return false;
        }
        if ('中国' != $ip['data']['country'] || 'CN' != $ip['data']['country_id']) {
            return false;
        }

        return true;
    }

    # 验证金额
    public static function money($amt)
    {
        if (!preg_match("/^\d+(\.\d{1,2})?$/", $amt)) {
            return false;
        }

        return true;
    }

    # 验证银行卡
    public static function bank($bank)
    {
        if (!preg_match("/^(\d{16}|\d{19})$/", $bank)) {
            return false;
        }

        return true;
    }

    # 严格验证身份证号码
    public static function checkIdCard($idcard)
    {

        // 只能是18位
        if (strlen($idcard) != 18) {
            return false;
        }

        // 取出本体码
        $idcard_base = substr($idcard, 0, 17);

        // 取出校验码
        $verify_code = substr($idcard, 17, 1);

        // 加权因子
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);

        // 校验码对应值
        $verify_code_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');

        // 根据前17位计算校验码
        $total = 0;
        for ($i = 0; $i < 17; ++$i) {
            $total += substr($idcard_base, $i, 1) * $factor[$i];
        }

        // 取模
        $mod = $total % 11;

        // 比较校验码
        if ($verify_code == $verify_code_list[$mod]) {
            return true;
        } else {
            return false;
        }
    }

    // 验证钱包地址
    public static function isWallet($wallet)
    {
        $return = false;
        $wallet_length = strlen($wallet);
        if (!self::az09($wallet) || $wallet_length > 64 || $wallet_length < 23) {
            return false;
        }
        return $return;
    }
}
