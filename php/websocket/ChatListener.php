<?php

namespace Chatbox;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class ChatListener implements MessageComponentInterface {
    protected $clienti;
    protected $legaturi = array(0 => null); // resID => array(nume=> .. , id => .. )

    public function __construct() {
        $this->clienti = new \SplObjectStorage;
        echo 'ChatListener initializat' ;
    }

    public function onOpen(ConnectionInterface $conexiune) {
        // Store the new connection to send messages to later
        $this->clienti->attach($conexiune);
        
        echo "Conexiune noua! resourceID: " . $conexiune->resourceId;

        echo "\n";
    }

    public function onMessage(ConnectionInterface $expeditor, $msg) {
        
        $resId = $expeditor->resourceId;
        $date = json_decode($msg, true);
        
        echo "onMessage($resId, $msg) : \n";
        
        print_r($date);
        switch($date['operatie']) {
            case 'trimitere': 
                $trimis = false;
                foreach ($this->clienti as $client) {
                    if ($this->legaturi[$client->resourceId]['id'] === $date['id_destinatar']) {
                        $client->send($msg);
                        $trimis = true;
                    }
                }
                if($trimis) {
                    echo "MESAJ [ {$this->legaturi[$resId]['nume']} --> {$date['nume_destinatar']} ]\n";
                    echo "TEXT: {$date['text']}\n";
                } else {
                    echo "MESAJUL [ {$this->legaturi[$resId]['nume']} --> {$date['nume_destinatar']} ]";
                    echo " NU A PUTUT FOST TRANSMIS";
                }
                break;
            
            case 'initializare': 
                $date_utilizator = array(
                    'id' => $date['id_utilizator'], 
                    'nume'=> $date['nume_utilizator']);
                $this->legaturi[$expeditor->resourceId] = $date_utilizator;
                
                //TODO baze de date: login

                $transmisie = array(
                    'id' => $date['id_utilizator'],
                    'operatie' => 'stare_utilizator',
                    'tip' => 'online');
                $transmisie_text = json_encode($transmisie);
                foreach($this->clienti as $client) {
                    if($expeditor !== $client) {
                        $client->send($transmisie_text);
                    }
                }
                break;
        }

        
    }

    public function onClose(ConnectionInterface $conexiune) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clienti->detach($conexiune);
        
        //TODO: baza de date - offline
        
        $transmisie = array(
                    'id' => $this->legaturi[$conexiune->resourceId]['id'],
                    'operatie' => 'stare_utilizator',
                    'tip' => 'online');
        
        $transmisie_text = json_encode($transmisie);
        foreach($this->clienti as $client) {
            if($conexiune !== $client) {
                $client->send($transmisie_text);
            }
        }

        echo "Conexiunea [ \n\t"
        . "resId={$conexiune->resourceId}, \n\t"
        . "nume={$this->legaturi[$conexiune->resourceId]['nume']}, \n\t"
        . "id={$this->legaturi[$conexiune->resourceId]['id']} \n s-a sfarsit. \n";
        
        unset($this->legaturi[$conexiune->resourceId]);
    }

    public function onError(ConnectionInterface $conexiune, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conexiune->close();
    }
}