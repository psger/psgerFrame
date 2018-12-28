<?php
/**
 * Created by PhpStorm.
 * User: passengerray
 * Date: 2018-12-28
 * Time: 13:49
 */

//生成友好时间形式
function friendly_date($from)
{
    static $now = NULL;
    $now == NULL && $now = time();
    !is_numeric($from) && $from = strtotime($from);
    $seconds = $now - $from;
    $minutes = floor($seconds / 60);
    $hours = floor($seconds / 3600);
    $day = round((strtotime(date('Y-m-d', $now)) - strtotime(date('Y-m-d', $from))) / 86400);
    if ($seconds == 0) {
        return '刚刚';
    }
    if (($seconds >= 0) && ($seconds <= 60)) {
        return "{$seconds}秒前";
    }
    if (($minutes >= 0) && ($minutes <= 60)) {
        return "{$minutes}分钟前";
    }
    if (($hours >= 0) && ($hours <= 24)) {
        return "{$hours}小时前";
    }
    if ((date('Y') - date('Y', $from)) > 0) {
        return date('Y-m-d', $from);
    }

    switch ($day) {
        case 0:
            return date('今天H:i', $from);
            break;

        case 1:
            return date('昨天H:i', $from);
            break;

        default:
            //$day += 1;
            return "{$day} 天前";
            break;
    }
}

//获取任意行的内容
function get_line($file_name, $start, $limit)
{
    $f = new SplFileObject($file_name, 'r');
    $f->seek($start);
    $ret = "";
    for ($i = 0; $i < $limit; $i++) {
        $ret .= $f->current();
        $f->next();
    }
    return $ret;
}

//读取文件行数
function count_line($file)
{
    $fp = fopen($file, "r");
    $i = 0;
    while (!feof($fp)) {
        //每次读取2M
        if ($data = fread($fp, 1024 * 1024 * 2)) {
            //计算读取到的行数
            $num = substr_count($data, "\n");
            $i += $num;
        }
    }
    fclose($fp);
    return $i;
}

/**
 * Description:计算当前时间
 *
 * @return float
 */
function getCurrentTime ()
{
    list ($msec, $sec) = explode(" ", microtime());
    return (float)$msec + (float)$sec;
}

