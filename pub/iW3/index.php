<?php

use Magento\Framework\App\Bootstrap;

require __DIR__ . '../../../app/bootstrap.php';

$params = $_SERVER;
$bootstrap = Bootstrap::create(BP, $params);

$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');

$cep = $_REQUEST['cep'];





$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
$priceHelper = $objectManager->create('Magento\Framework\Pricing\Helper\Data');
$connection = $resource->getConnection();
$tableName = $resource->getTableName('webshopapps_matrixrate');




// SELECT DATA
$sql = "SELECT * FROM " . $tableName;
$result = $connection->fetchAll($sql);

rsort($result);
$varretorno ='';
foreach($result as $item){
    if($cep >= $item['dest_zip'] && $cep <= $item['dest_zip_to'])
        $varretorno .= '<p>'. $item['shipping_method'].' &nbsp;&nbsp;  Valor: '.$priceHelper->currency($item['price'], true, false).'</p>';



}

if($varretorno)
    echo $varretorno;
else
echo 'Desculpe,só atendemos na regiao de São paulo!';




