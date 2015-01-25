<?php

namespace Chatbox;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require '../db_functii.php';

class ChatListener implements MessageComponentInterface {
    protected $clienti;
    protected $legaturi = array(0 => null); // resID => array(nume=> .. , id => .. )

    public function __construct() {
        $this->clienti = new \SplObjectStorage;
        echo 'ChatListener initializat' ;
    }
    
    function trimite_mesaj($id_destinatar, $mesaj) {
        $trimis = false;
        foreach ($this->clienti as $client) {
            if ($this->legaturi[$client->resourceId]['id'] === $id_destinatar) {
                $client->send($mesaj);
                $trimis = true;
            }
        }
        return $trimis;
    }
    
    function initializare_utilizator($utilizator, $id, $nume) {
        
    
        $this->legaturi[$utilizator->resourceId] = array(
            'id' => $id, 
            'nume'=> $nume);

        //TODO baze de date: login

        $transmisie = array(
            'id' => $id,
            'operatie' => 'stare_utilizator',
            'stare' => 'online');
        $transmisie_text = json_encode($transmisie);
        foreach($this->clienti as $client) {
            if($utilizator !== $client) {
                $client->send($transmisie_text);
            }
        }
        
        $q = "UPDATE utilizatori SET activ = 1 WHERE id = ?";
        inserare_bd($q, $id);
        
    }

    public function onOpen(ConnectionInterface $conexiune) {
        // Store the new connection to send messages to later
        $this->clienti->attach($conexiune);
        
        echo "Conexiune noua! resourceID: " . $conexiune->resourceId;

        echo "\n";
    }

    public function onMessage(ConnectionInterface $expeditor, $mesaj) {
        
        $resId = $expeditor->resourceId;
        $date = json_decode($mesaj, true);
        
        echo "onMessage($resId, $mesaj) : \n";
        
        print_r($date);
        switch($date['operatie']) {
            case 'trimitere': 
                
                $trimis = $this->trimite_mesaj($date['id_destinatar'], $mesaj);
                
                if($trimis) {
                    echo "MESAJ [ {$this->legaturi[$resId]['nume']} --> {$date['nume_destinatar']} ]\n";
                    echo "TEXT: {$date['text']}\n";
                } else {
                    echo "MESAJUL [ {$this->legaturi[$resId]['nume']} --> {$date['nume_destinatar']} ]";
                    echo " NU A PUTUT FOST TRANSMIS";
                }
                break;
            
            case 'initializare': 
                $this->initializare_utilizator($expeditor, $date['id_utilizator'], $date['nume_utilizator']);
                break;
        }

        
    }

    public function onClose(ConnectionInterface $conexiune) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clienti->detach($conexiune);
        
        //TODO: baza de date - offline
        $id = $this->legaturi[$conexiune->resourceId]['id'];
        $transmisie = array(
                    'id' => $id,
                    'operatie' => 'stare_utilizator',
                    'tip' => 'online');
        
        $transmisie_text = json_encode($transmisie);
        foreach($this->clienti as $client) {
            if($conexiune !== $client) {
                $client->send($transmisie_text);
            }
        }
        
        $q = "UPDATE utilizatori SET activ = 1 WHERE id = ?";
        inserare_bd($q, $id);

        echo "Conexiunea [ \n\t"
        . "resId={$conexiune->resourceId}, \n\t"
        . "nume={$this->legaturi[$conexiune->resourceId]['nume']}, \n\t"
        . "id=$id \n s-a sfarsit. \n";
        
        unset($this->legaturi[$conexiune->resourceId]);
    }

    public function onError(ConnectionInterface $conexiune, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conexiune->close();
    }
}