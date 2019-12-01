<?php

Class DBConnection {
    // Database Connection Configuration Parameters
    
    protected $_config;
    // Database Connection
    private $dbc;
    //the result object of the $sql sentence
    private $result = null;

    /* function __construct
     * Opens the database connection
     * @param $config is an array of database connection parameters
     */
    public function __construct( array $config ) {
        $this->_config = $config;
        $this->getPDOConnection();
    }
    /* Function __destruct
     * Closes the database connection
     */
    public function __destruct() {
		$this->dbc = NULL;
	}
    /* Function getPDOConnection
     * Get a connection to the database using PDO.
     */
    private function getPDOConnection() {
        // Check if the connection is already established
        if ($this->dbc == NULL) {
            // Create the connection
            $dsn = "" .
                $this->_config['driver'] .
                ":host=" . $this->_config['host'] .
                ";dbname=" . $this->_config['dbname'];
            try {
                $this->dbc = new PDO( $dsn, $this->_config[ 'username' ], $this->_config[ 'password' ] );
            } catch( PDOException $e ) {
                echo __LINE__.$e->getMessage();
            }
        }
    }
    /*delete later only for debugging purposes*/
    public function runQuery( $sql ) {
        try {
        	$count = $this->dbc->exec($sql) or print_r($this->dbc->errorInfo());
        } catch(PDOException $e) {
        	echo __LINE__.$e->getMessage();
        }
        return $count;
    }
    /*-------------------------------------------*/
    
    public function runQueryPDO($sql, $parameters = []) {
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute($parameters);
        return $stmt;
    }

    public function getObject($cls = "StdClass")
		{
			if (is_null($this->result)) return null ;
            
			// si tenemos un resultado, lo devolvemos
			return $this->result->fetchObject($cls) ;
		}

    
}