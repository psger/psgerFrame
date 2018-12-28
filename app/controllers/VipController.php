<?php
/**
 * Created by PhpStorm.
 * User: passengerray
 * Date: 2018-12-26
 * Time: 16:13
 */

//use app\modelds\BasicUserInfoVip;

class VipController
{
    public function index()
    {
        $request = $_GET;
        $tutu_uid = $request['tutuid'];
        $date = intval($request['date']);
        if (empty($tutu_uid) || empty($date)) {
            echo "ID || 天数 不能为空";
            exit;
        }
        $now = time();
        $vipExpire = $now + 24 * 3600 * $date;

        $user = BasicUserInfo::where('tutu_uid', '=', $tutu_uid)->first();
        if (!$user) {
            echo "没有该用户";
            exit;
        }
        $userId = $user->user_name;

        $vip = BasicUserInfoVip::where('user_id', '=', $userId)->first();
        if (!$vip) {
            $vipNew = new BasicUserInfoVip();
            $vipNew->user_id = $userId;
            $vipNew->vip_expire_date = $vipExpire;
            $vipNew->create_date = $now;
            $vipNew->save();
            echo "新增会员:" . $userId . PHP_EOL . $date . '天';
        } else {
            $vipExpire = $vip->vip_expire_date + 24 * 3600 * $date;
            $vip->vip_expire_date = $vipExpire;
            $vip->save();
            echo "更新会员:" . $userId . PHP_EOL . $date . '天';
        }
    }
}