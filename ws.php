<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

    // Make sure composer dependencies have been installed
    require __DIR__ . '/vendor/autoload.php';

/**
 * chat.php
 * Send any incoming messages to all connected clients (except sender)
 */
class Points implements MessageComponentInterface {
    protected $clients;
    protected $points;
    
    public function __construct() {
        $this->clients = new \SplObjectStorage;
        echo "Hello world";
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);

        if(!isset($this->points)){
            $this->points=0;
        }
        echo 'client connected';
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        foreach ($this->clients as $client) {          
            if($msg=='increment'){
                $this->points++;
                echo 'inc: '.$this->points."\n";
                $client->send('score_update_inc');
            }
            else if ($msg=='decrement'){
                $this->points--;
                echo 'dec: '.$this->points."\n";
                $client->send('score_update_dec');
            }
            else{
                echo 'Błąd ponieważ wartość $msg='.$msg."\n";
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        $this->points = 0;
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}

    // Run the server application through the WebSocket protocol on port 8080
    $server = IoServer::factory(new HttpServer(new WsServer(new Points())), 8080);
    $server->run();
