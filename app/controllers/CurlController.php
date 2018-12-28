<?php
/**
 * Created by PhpStorm.
 * User: passengerray
 * Date: 2018-12-27
 * Time: 12:02
 */

class CurlController
{
    public function del()
    {
        $begin = getCurrentTime();

        $start = 0;
        $limit = 1000;
        $fileName = '../newNeedDeleteEntityIdsInEs.txt';
        $line = count_line($fileName);
        for ($i = 0; $i <= ceil($line / 1000); $i++) {
            $result = get_line($fileName, $start, $limit);
            $this->deleteIpaWithEntityId($result);
            $start += $limit;
        }

        $end = getCurrentTime();
        $spend = $end-$begin;
        echo "执行时间为:".$spend."\n";

    }

    public function deleteIpaWithEntityId($result)
    {
//        {
//            "entityIds": ["165","168","175"]
//        }
        $params['entityIds'] = explode("\r\n", trim($result));
        $first = current($params['entityIds']);
        $end = end($params['entityIds']);
        $sum = count($params['entityIds']);

        $options = json_encode($params);
//        echo $options;exit;
        $data = [
          'body' => $options,
          'headers' => ['content-type' => 'application/json']
        ];

        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://192.168.182.182:8000/search/bulkdelrows', $data);
        $body = json_decode($response->getBody(), true);

        file_put_contents('result.txt', $body['data']['result'] . '|' .$first.'~'.$end.'|'.$sum . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

}