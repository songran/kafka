<?php
require __DIR__.'/vendor/autoload.php';
date_default_timezone_set('PRC');
 

$config = \Kafka\ProducerConfig::getInstance();
$config->setMetadataRefreshIntervalMs(10000);
$config->setMetadataBrokerList('localhost:9092');
$config->setBrokerVersion('0.9.0.1');
$config->setRequiredAck(1);
$config->setIsAsyn(false);
$config->setProduceInterval(500);
$producer = new \Kafka\Producer(function() {
	return array(
		array(
			'topic' => 'helloword',
			'value' => json_encode(array('id'=>888,'content'=>'ggggg')) ,
			'key'   => 'testkey',
			),
	);
});
 
$producer->success(function($result) {
	var_dump($result);
});
$producer->error(function($errorCode) {
		var_dump($errorCode);
});
$producer->send(true);