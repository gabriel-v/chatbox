<?php

namespace Chatbox;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class ChatListener implements MessageComponentInterface {
    protected $clienti;

    public function __construct() {
        $this->clienti = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clienti->attach($conn);

        echo "Conexiune noua!\n";
        print_r($conn);
        echo "\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clienti) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        foreach ($this->clienti as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clienti->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}