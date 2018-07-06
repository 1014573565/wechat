<?php

function del0($number)
{
    $number = trim(strval($number));
    if (preg_match('#^-?\d+?\.0+$#', $number)) {
        return preg_replace('#^(-?\d+?)\.0+$#', '$1', $number);
    }
    if (preg_match('#^-?\d+?\.[0-9]+?0+$#', $number)) {
        return preg_replace('#^(-?\d+\.[0-9]+?)0+$#', '$1', $number);
    }

    return $number;
}

function fileLock($filename)
{
    $lock_file = storage_path("file_lock_{$filename}.lock");
    $fp = null;
    if (!flock($fp = fopen($lock_file, 'w'), LOCK_NB | LOCK_EX)) {
        //无法取得锁就退出
        die("程序可能已经运行，执行失败\n");
    }
    register_shutdown_function('unlink', $lock_file);
    return $fp;
}

/**
 * 打印调试函数
 * @param mixed $var 打印的东西
 */
function p($var = null,$debugger = 0){
    $str = '<pre style="border:1px solid #ccc; padding:10px; font-size:16px; line-height:28px; border-radius:5px; background:#eaebe6;">%str%</pre>';
    $replace = print_r($var, true);
    if(is_null($var)){
        $replace = '__NULL__';
    }elseif(is_bool($var)){
        $var = $var === true ? 'true' : 'false';
        $replace = '(bool)'.$var;
    }elseif(is_string($var) && trim($var) === ''){
        $replace = '空';
    }
    $str = str_replace('%str%', $replace, $str);
    echo $str;
    if($debugger) exit;
}