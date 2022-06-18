<?php

use vipszx\antBlockchain\client;

require __DIR__.'/client.php';
require __DIR__.'/../vendor/autoload.php';

$client = new client([
            'accessId' => 'gsxl8oamCCGOXDXN',
            'privateKey' => 'access.key',
            'bizId' => 'a00e36c5',
            'tenantId' => 'CCGOXDXN',
            'gas' => 500000,
        ]);
       
//存证
// $client->deposit($orderId, $content, $account, $mykmsKeyId, $gas = null);

$orderId = "O".time();
$account = "zhihuiyunyi";
$mykmsKeyId = "KHO9kYtgCCGOXDXN1654001608116";
$contractName = "SmartCloudNFT1155_V3";
$methodSignature = "implementation()";
$inputParamListStr = "[]";
$outTypes = "[identity]";

//异步调用 Solidity 合约
/**
 * var_dump($response)
 * array(3) {
 *   ["success"]=> bool(true)
 *   ["code"]=> string(3) "200"
 *   ["data"]=> string(64) "676945b52eb52a07367f0697d60332dfc62f3f8e3d5728ec308fa2ea4c1dfebb"
 * }
 */
// $response = $client->callSolidityContract($orderId, 
//     $account, 
//     $mykmsKeyId, 
//     $contractName, 
//     $methodSignature, 
//     $inputParamListStr, 
//     $outTypes, 
//     300000
// );
// if ($response["success"] && $response["code"] == "200") {
//     $txHash = $response["data"];
// }

$txHash = "676945b52eb52a07367f0697d60332dfc62f3f8e3d5728ec308fa2ea4c1dfebb";

//查询交易
/**
 * Resonse : 
 * Array
 * (
    [success] => 1
    [code] => 200
    [data] => {"blockNumber":114519808,"hash":"676945b52eb52a07367f0697d60332dfc62f3f8e3d5728ec308fa2ea4c1dfebb","transactionDO":{"data":"XGDaGw==","timestamp":1655522214391,"txType":"TX_CALL_CONTRACT"}}
 * )
 */
$response = $client->queryTransaction($txHash);
print_r($response);

//查询交易回执
/**
 * Response
 * Array
 * (
 *    [success] => 1
 *     [code] => 200
 *     [data] => {"blockNumber":114519808,"code":0,"gasUsed":21042,"hash":"676945b52eb52a07367f0697d60332dfc62f3f8e3d5728ec308fa2ea4c1dfebb","logs":[{"from":{"data":"E3W64EmYuMSe5ffZAomR3PFfYydFIyRnf6eQTyJ1+MY=","empty":false,"value":"E3W64EmYuMSe5ffZAomR3PFfYydFIyRnf6eQTyJ1+MY="},"logData":"","to":{"data":"T4GLGh4uxjqKZD2ID26Y3XfP5QMfBHWR1jsZ9/craN8=","empty":false,"value":"T4GLGh4uxjqKZD2ID26Y3XfP5QMfBHWR1jsZ9/craN8="},"topics":["call_contract"]}],"output":"T4GLGh4uxjqKZD2ID26Y3XfP5QMfBHWR1jsZ9/craN8=","result":0,"txFinish":false,"txSuccess":false}
 * )
 */
$response = $client->queryReceipt($txHash);
print_r($response);
if ($response["success"] && $response["code"] == "200") {
    $data = json_decode($response["data"], true);
    $content = bin2hex(base64_decode($data['output']));
    echo $content,"\n";
}
//查询账户
//$client->queryAccount($account);

//解析合约返回值
//$content = bin2hex(base64_decode($output));
//$client->parseOutput($content, $abi, $type);