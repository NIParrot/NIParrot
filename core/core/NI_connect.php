<?php
class NI_connect extends ORM
{
    private $host;
    private $port;
    private $dbname;
    private $user;
    private $pass;

    public function __construct($host, $port, $dbname, $user, $pass)
    {
        $this->host = $host;
        $this->port = $port;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->pass = $pass;
    }

    public function connection()
    {
        try {
            $conn = new PDO(
                "mysql:host=$this->host;port=$this->port;dbname=$this->dbname",
                $this->user,
                $this->pass,
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                ]
            );
            return $conn;
        } catch (PDOException $e) {
            (print_r($e->getMessage()));
        }
    }

    public function mysql()
    {
        $this->configure("mysql:host=$this->host;port=$this->port;dbname=$this->dbname");
        $this->configure('username', $this->user);
        $this->configure('password', $this->pass);
        $this->configure(
            'driver_options',
            array(
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => true,
                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
                PDO::MYSQL_ATTR_LOCAL_INFILE => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
            )
        );
    }
    public function sqlsrv()
    {
        $this->configure("sqlsrv:Server=$this->host;Database=$this->dbname");
        $this->configure('username', $this->user);
        $this->configure('password', $this->pass);
        $this->configure(
            'driver_options',
            array()
        );
    }
    public function sqlite()
    {
        $this->configure("sqlite:$this->host");
        $this->configure(
            'driver_options',
            array()
        );
    }
}
