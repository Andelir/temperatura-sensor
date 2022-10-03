<?php
class ConnectionDB
{
    private $_connection;
    public function __construct($host, $user, $password, $db)
    {
        try {
            $this->_connection = new mysqli($host, $user, $password, $db);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        $this->getConnection();
    }

    private function getConnection()
    {
        return $this->_connection;
    }
}



