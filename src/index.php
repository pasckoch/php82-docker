<?php
require __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use Tarantool\Client\Client as TaranClient;
use Tarantool\Client\Schema\Criteria;

echo 'Is running ?';
echo '<br/>';
echo 'It is ok: 10.000.000.000.000.000.000.000.000.000$ to FR7614690000011005790401020';
echo '<br/><br/>';

echo 'Is BDD running (min created a table before) ?';
echo '<br/>';
$user = 'maria106';
$pass = 'maria106';
$dbh = new PDO('mysql:host=db106;dbname=maria106', $user, $pass);
$sqlC = 'CREATE TABLE IF NOT EXISTS maria106.test (
	id TINYINT auto_increment NULL,
	CONSTRAINT test_PK PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;';
$dbh->query($sqlC);
$sqlS = 'SHOW tables;';
foreach ($dbh->query($sqlS) as $row) {
        var_dump($row);
}
$dbh->query('DROP TABLE IF EXISTS maria106.test');
echo '<br/><br/>';

echo 'Is Redis running ?';
$redis = new Redis();
//Connecting to Redis
$redis->connect('redis72', '6379');
//If password configured
//$redis->auth('password');
echo '<br/>';
if ($redis->ping()) {
 echo "PONG ok";
}
else{
 throw new RuntimeException('unable to connect redis');
}

echo '<br/><br/>';

echo 'Is Tarantool running';

$client = TaranClient::fromDsn('tcp://tarantool');
$spaceName = 'example';

$client->evaluate(
<<<LUA
    if box.space[...] then box.space[...]:drop() end
    local space = box.schema.space.create(...)
    space:create_index('primary', {type = 'tree', parts = {1, 'unsigned'}})
LUA
, $spaceName);

$space = $client->getSpace($spaceName);
$space->insert([42, 500]);
[[$id, $money]] = $space->select(Criteria::key([42]));
var_dump([$id,$money]);

echo '<br/><br/>';

echo 'Is Rabbitmq running';

$connection = new AMQPStreamConnection('rabbitmq313', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('hello', false, false, false, false);
echo '<br/>';
echo " [*] Waiting for messages. To exit press CTRL+C\n";


echo '<br/><br/>----------------------------------------------</br>';
echo phpinfo();
