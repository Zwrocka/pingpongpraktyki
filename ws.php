<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

//include('conf.php');

// Make sure composer dependencies have been installed
require __DIR__ . '/vendor/autoload.php';

class Points implements MessageComponentInterface {
    protected $clients;
    protected $points;
    
    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->myObj = new stdClass();
        $this->myObj->data = new stdClass();
        $this->pointsone=0;
        $this->pointstwo=0;
        
        //$this->$connect = mysqli_connect($host, $db_user, $password, $db_name);
       
        echo "Server is started \n";
    }
    
    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        $this->gameHistory = array();
        
        $this->myObj->action = 'initialScore';
        $this->myObj->data->pointsone = $this->pointsone;
        $this->myObj->data->pointstwo = $this->pointstwo;

        $myJSON = json_encode($this->myObj);
        
        $conn->send($myJSON);
        echo "client connected \n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // reagujesz na dwa nowe wiadomosc - startMatch i endMatch
        $msg_json = json_decode($msg);
        if($msg_json->action=='startGame'){

            $this->pointsone = 0;
            $this->pointstwo = 0;
            $this->current_team_one = $msg_json->data->team_one;
            $this->current_team_two = $msg_json->data->team_two;

            $this->myObj->action = 'startGame';
            $this->myObj->data->team_one = $this->current_team_one;
            $this->myObj->data->team_two = $this->current_team_two;
            
            echo "Start game is succesfull \n";
        }
        else if($msg_json->action=='stopGame'){
            $lastMatch = new stdClass();
            $lastMatch->team_one = $this->current_team_one;
            $lastMatch->team_two = $this->current_team_two;
            $lastMatch->pointsone = $this->pointsone;
            $lastMatch->pointstwo = $this->pointstwo;
            $this->myObj->action = 'stopGame';

            array_push($this->gameHistory, $lastMatch);
            
            echo "log: ".json_encode($lastMatch)."\n";
            
            //mysqli_query($connect, "SET CHARSET utf8");
	        //mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            //mysqli_query($connect, "INSERT INTO math VALUES (NULL, '$lastMatch->team_one', '$lastMatch->team_two', '$lastMatch->pointsone', '$lastMatch->pointstwo')");
            
            $this->pointsone = 0;
            $this->pointstwo = 0;
            
            echo "Stop game is succesfull \n";

        } else {
            if($msg_json->action=='incrementFirst'){
                $this->pointsone++;
                echo 'inc: '.$this->pointsone."\n";
            }
            else if ($msg_json->action=='decrementFirst'){
                $this->pointsone--;
                echo 'dec: '.$this->pointsone."\n";
            }
            else if ($msg_json->action=='incrementSecond'){
                $this->pointstwo++;
                echo 'inc: '.$this->pointstwo."\n";
            }
            else if ($msg_json->action=='decrementSecond'){
                $this->pointstwo--;
                echo 'dec: '.$this->pointstwo."\n";
            }
            else{
                echo 'Error: value message is '.$msg." ! \n";
            }
            $this->myObj->action = 'scoreUpdate';
        }

        //$myObj->action = 'scoreUpdate';
        $this->myObj->data->pointsone = $this->pointsone;
        $this->myObj->data->pointstwo = $this->pointstwo;
        $this->myObj->data->teamone = $msg_json->data->team_one;
        $this->myObj->data->teamtwo = $msg_json->data->team_two;

        $myJSON = json_encode($this->myObj);
        
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
