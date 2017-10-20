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
        $this->pointsone=0;
        $this->pointstwo=0;
       
        echo "Hello world";
    }
    
    public function startMatch() {
        // zerujesz wynik i wysylasz zaaktualizowany
    }
    
    public function endMatch() {
        // zerujesz wynik
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        
        $myObj = new stdClass();
        $myObj->pointsone = $this->pointsone;
        $myObj->pointstwo = $this->pointstwo;

        $myJSON = json_encode($myObj);
        
        $conn->send($myJSON);
        echo 'client connected';
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        
        // reagujesz na dwa nowe wiadomosc - startMatch i endMatch
        if($msg=='incrementFirst'){
                $this->pointsone++;
                echo 'inc: '.$this->pointsone."\n";
            }
            else if ($msg=='decrementFirst'){
                $this->pointsone--;
                echo 'dec: '.$this->pointsone."\n";
            }
            else if ($msg=='incrementSecond'){
                $this->pointstwo++;
                echo 'dec: '.$this->pointstwo."\n";
            }
            else if ($msg=='decrementSecond'){
                $this->pointstwo--;
                echo 'dec: '.$this->pointstwo."\n";
            }
            else{
                echo 'Błąd ponieważ wartość $msg='.$msg."\n";
            }
            
            if (!isset($res)) {
                $myObj = new stdClass();
            }
            
            $myObj->pointsone = $this->pointsone;
            $myObj->pointstwo = $this->pointstwo;
            
            $myJSON = json_encode($myObj);
        
        
        foreach ($this->clients as $client) {          
            
            $client->send($myJSON);
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);        
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}

    // Rurn the server application through the WebSocket protocol on port 8080
    $server = IoServer::factory(new HttpServer(new WsServer(new Points())), 8080);
    $server->run();
