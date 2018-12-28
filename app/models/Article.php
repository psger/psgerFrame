<?php
/**
 * Created by PhpStorm.
 * User: passengerray
 * Date: 2018-12-22
 * Time: 21:51
 */
class Article extends Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
//    public static function first()
//    {
////        $dsn = 'mysql:host=127.0.0.1;port=8889;dbname=psger';
////        $username = 'root';
////        $password = 'passenger';
////        $driver_options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8',);
////        $pdo = new PDO($dsn,$username,$password,$driver_options);
////
////        $sth = $pdo->prepare(
////            "SELECT id, title, content FROM articles where id = 1"
////        );
////        $sth->setFetchMode(PDO::FETCH_ASSOC);
////        $sth->execute();
////        while ($row = $sth->fetchAll()) {
////            return $row;
////        }
//
//
//    }
}