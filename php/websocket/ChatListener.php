<?php

namespace Chatbox;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require '../bd_functii.php';
require '../functii.php';

class ChatListener implements MessageComponentInterface {
    protected $clienti;
    protected $legaturi = array(0 => null); // resID => array(nume=> .. , id => .. )

    public function __construct() {
        $this->clienti = new \SplObjectStorage;
        echo 'ChatListener initializat' ;
    }
    
    function trimite_mesaj($expeditor, $mesaj) {
        $trimis = false;
        $mesaj['id_expeditor'] = $this->legaturi[$expeditor->resourceId]['id'];
        foreach ($this->clienti as $client) {
            if ($this->legaturi[$client->resourceId]['id'] === $mesaj['id_destinatar'] || 
                    ($this->legaturi[$client->resourceId]['id'] === $mesaj['id_expeditor'] &&
                    $client != $expeditor)) {
                $client->send(json_encode($mesaj));
                $trimis = true;
            }
        }
        return $trimis;
    }
    
    function initializeaza_sesiune($utilizator, $cheie) {
        /*$q = 'SELECT id, nume FROM utilizatori WHERE id IN '
                . '( SELECT id_utilizator FROM sesiuni '
                . 'WHERE cheie_sesiune = ?)'; */
        
        $q = 'SELECT u.id AS "id", u.nume AS "nume", s.cheie_sesiune AS "cheie" '
                . 'FROM utilizatori u JOIN sesiuni s '
                . 'ON (u.id = s.id_utilizator) '
                . 'WHERE s.cheie_sesiune = ? '
                . 'ORDER BY s.inceput DESC';
        
        $date_utilizator = interogare_bd($q, $cheie);
        $id = $date_utilizator['id'];
    
        $this->legaturi[$utilizator->resourceId] = $date_utilizator;

        //TODO baze de date: generare sesiune

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
    
    function sfarseste_sesiune($conexiune, $id, $cheie) {
        
        $transmisie = array(
                    'id' => $id,
                    'operatie' => 'stare_utilizator',
                    'stare' => 'offline');
        
        $transmisie_text = json_encode($transmisie);
        foreach($this->clienti as $client) {
            if($conexiune !== $client) {
                $client->send($transmisie_text);
            }
        }
        
        $q = "UPDATE utilizatori SET activ = 0 WHERE id = ?";
        inserare_bd($q, $id);
        
        $q = "UPDATE sesiuni SET sfarsit = ? WHERE cheie_sesiune = ?";
        inserare_bd($q, array(\acum(), $cheie));
        
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
                
                $trimis = $this->trimite_mesaj($expeditor, $date);
                
                if($trimis) {
                    echo "MESAJ [ {$this->legaturi[$resId]['nume']} --> {$date['nume_destinatar']} ]\n";
                    echo "TEXT: {$date['text']}\n";
                } else {
                    echo "MESAJUL [ {$this->legaturi[$resId]['nume']} --> {$date['nume_destinatar']} ]";
                    echo " NU A PUTUT FOST TRANSMIS";
                }
                break;
            
            case 'initializare': 
                $this->initializeaza_sesiune($expeditor, $date['cheie']);
                break;
        }

        
    }

    public function onClose(ConnectionInterface $conexiune) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clienti->detach($conexiune);
        
        //TODO: baza de date - offline
        $id = $this->legaturi[$conexiune->resourceId]['id'];
        $nume = $this->legaturi[$conexiune->resourceId]['nume'];
        $cheie = $this->legaturi[$conexiune->resourceId]['cheie'];
        
        $this->sfarseste_sesiune($conexiune, $id, $cheie);

        echo "Conexiunea [ \n\t"
        . "resId={$conexiune->resourceId}, \n\t"
        . "nume=$nume, \n\t"
        . "id=$id \n s-a sfarsit. \n";
        
        unset($this->legaturi[$conexiune->resourceId]);
    }

    public function onError(ConnectionInterface $conexiune, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conexiune->close();
    }
}