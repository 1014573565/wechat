<?php
/**
 * 返回可读性更好的文件尺寸
 */
function human_filesize($bytes, $decimals = 2)
{
    $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .@$size[$factor];
}

/**
 * 判断文件的MIME类型是否为图片
 */
function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}

/**
 * 将数据导出EXCEL
 * @param  [array 一维数组] $title   [标题]
 * @param  [array 二维数组] $content [导出内容]
 * @param  [string] $filename [文件名,默认为data.xls]
 */
function exportData($title , $content , $filename = 'data'){
//	$title = array('标题a' , '标题b' , '标题c');
//	$content = array(
//		array('aa' , 'bb' , 'cc'),
//		array('dd' , 'ee' , 'ff'),
//		array('gg' , 'hh' , 'ii'),
//	);
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename=' . $filename . '.xls');
    header('Pragma: no-cache');
    header('Expires: 0');
    echo iconv('utf-8', 'gbk', implode("\t", $title)), "\n";
    foreach ($content as $value) {
        echo iconv('utf-8', 'gbk', implode("\t", $value)), "\n";
    }
    exit();
}

function objectToArray($object) {
    //先编码成json字符串，再解码成数组
    return json_decode(json_encode($object), true);
}
function arrayToObject($arr){
    if(is_array($arr)){
        return (object) array_map(__FUNCTION__, $arr);
    }else{
        return $arr;
    }
}

function showImage($url){
    $image = new \App\Library\Image($url);
    $image->percent = 0.2;
    $image->openImage();
    $image->thumpImage();
    $image->showImage();
}