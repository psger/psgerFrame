<?php
/**
 * Created by PhpStorm.
 * User: passengerray
 * Date: 2018-12-28
 * Time: 15:51
 */



class CsvController
{
    public function export()
    {
        $pdo = require BASE_PATH.'/config/pdo.php';
        $file = "./reslut.txt";
        $start = 0;
        $limit = 9999;
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['entity_id', 'app_name']);
        for ($i = 0; $i <= ceil(545299 / 9999); $i++) {
            $result = get_line($file, $start, $limit);
            $sth = $pdo->prepare(
                "SELECT entity_id, app_name FROM app_ios_flat WHERE entity_id IN ($result)"
            );
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute();
            $csv->insertAll($sth);
            $start += 10000;
            $limit = 9999;
        }
        $csv->output('data.csv');
        die;
    }
}