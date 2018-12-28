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
        $fileName = '../needDeleteEntityIdsInEs.txt';
        $start = 0;
        $limit = 1000;
        for ($i = 0; $i < ceil(272650 / 1000); $i++) {
            $result = get_line($fileName, $start, $limit);
            $this->deleteIpaWithEntityId($result);
            $start += $limit;
        }
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

        var_dump($body['data']['result']);
        file_put_contents('results.txt', $body['data']['result'] . '|' .$first.'~'.$end.'|'.$sum . PHP_EOL, FILE_APPEND | LOCK_EX);
    }




}