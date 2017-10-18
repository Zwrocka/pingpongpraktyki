<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

    // Make sure composer dependencies have been installed
    require __DIR__ . '/vendor/autoload.php';

/**
 * chat.php
 * Send any incoming messages to all connected clients (except sender)
 */
class MyChat implements MessageComponentInterface {
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
                $score_update_inc=$this->points++;
                echo 'inc: '.$score_update_inc."\n";
                $client->send($score_update_inc);
            }
            else if ($msg=='decrement'){
                $this->points--;
                $score_update_dec=$this->points++;
                echo 'dec: '.$score_update_dec."\n";
                $client->send($score_update_dec);
            }
            else{
                echo 'Błąd ponieważ wartość $msg='.$msg;
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
    $app = new Ratchet\App('localhost', 8080);
    $app->route('/chat', new MyChat);
    $app->route('/echo', new Ratchet\Server\EchoServer, array('*'));
    $app->run();
