<?php

/* * * 
 * chatbox
 * 
 * Copyright (c) Gabriel Vîjială: 2014, 2015 
 * 
 * Acest proiect a fost asamblat pentru Atestatul Profesional 
 * la terminarea liceului, pentru gradul de Programator Ajutor.
 * 
 */

namespace Chatbox;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require dirname(dirname(__FILE__)) . '/bd_functii.php';
require dirname(dirname(__FILE__)) . '/functii.php';

class ChatListener implements MessageComponentInterface {

    protected $clienti;
    protected $legaturi = array(0 => null); 

    public function __construct() {
        $this->clienti = new \SplObjectStorage;
        echo 'ChatListener initializat!' . "\n" . \acum() . "\n\n";
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

        $q = 'SELECT u.id AS "id", u.nume AS "nume", s.cheie_sesiune AS "cheie" '
                . 'FROM utilizatori u JOIN sesiuni s '
                . 'ON (u.id = s.id_utilizator) '
                . 'WHERE s.cheie_sesiune = ? '
                . 'ORDER BY s.inceput DESC';

        $date_utilizator = interogare_bd($q, $cheie);

        if (!$date_utilizator) {
            deconectare_baza_date();
            return;
        }
        $id = $date_utilizator['id'];

        $this->legaturi[$utilizator->resourceId] = $date_utilizator;

        $transmisie = array(
            'id' => $id,
            'operatie' => 'stare_utilizator',
            'stare' => 'online',
            'nume' => $date_utilizator['nume']);
        $transmisie_text = json_encode($transmisie);
        foreach ($this->clienti as $client) {
            if ($utilizator !== $client) {
                $client->send($transmisie_text);
            }
        }

        $q = "UPDATE utilizatori SET activ = 1 WHERE id = ?";
        inserare_bd($q, $id);

        deconectare_baza_date();
    }

    function sfarseste_sesiune($conexiune, $id, $cheie) {

        $transmisie = array(
            'id' => $id,
            'operatie' => 'stare_utilizator',
            'stare' => 'offline');

        $transmisie_text = json_encode($transmisie);
        foreach ($this->clienti as $client) {
            if ($conexiune !== $client) {
                $client->send($transmisie_text);
            }
        }

        $q = "UPDATE utilizatori SET activ = 0 WHERE id = ?";
        inserare_bd($q, $id);

        $q = "UPDATE sesiuni SET sfarsit = ? WHERE cheie_sesiune = ?";
        inserare_bd($q, array(\acum(), $cheie));

        deconectare_baza_date();
    }

    public function onOpen(ConnectionInterface $conexiune) {
        $this->clienti->attach($conexiune);

        echo "Conexiune noua! resourceID: " . $conexiune->resourceId . "\n";
    }

    public function onMessage(ConnectionInterface $expeditor, $mesaj) {

        $resId = $expeditor->resourceId;
        $date = json_decode($mesaj, true);

        echo "onMessage($resId, $mesaj) : \n";

        print_r($date);
        switch ($date['operatie']) {
            case 'trimitere':

                $trimis = $this->trimite_mesaj($expeditor, $date);

                if ($trimis) {
                    echo "MESAJ [ {$this->legaturi[$resId]['nume']} --> {$date['nume_destinatar']} ]\n";
                    echo "TEXT: {$date['text']}\n";
                } else {
                    echo "MESAJUL [ {$this->legaturi[$resId]['nume']} --> {$date['nume_destinatar']} ]\n";
                    echo " NU A PUTUT FOST TRANSMIS\n";
                }
                break;

            case 'initializare':
                $this->initializeaza_sesiune($expeditor, $date['cheie']);
                break;
        }
    }

    public function onClose(ConnectionInterface $conexiune) {
        $this->clienti->detach($conexiune);

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
