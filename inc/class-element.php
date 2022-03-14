<?php
class Element {

    private $table;

    public function __construct($table) {
        $this->table = $table;
    }

    public function insert( $data ) {
        global $app_db;

        $array = (array) $data;
        $columns =  [];
        $values =  [];

        foreach($array as $x => $y) {

            if (gettype($y)!= 'array' && gettype($y)!= 'object') {

                array_push($columns, $x);
                array_push($values, "'" . $y . "'");
                
            }
        }

        $columns = implode(',', $columns);
        $values =  implode(',', $values);

        $query = "INSERT INTO $this->table
	        ( $columns ) VALUES ( $values )";
        
        $result = $app_db->query( $query );

        return $result;
    }

    public function update( $data ) {  
        global $app_db;

        $array = (array) $data;
        $a =  [];

        foreach($array as $x => $y) {

            if (gettype($y)!= 'array' && gettype($y)!= 'object') {

                if($x != 'id') {

                    array_push($a, "$x = '$y'");

                }
            }
        }

        $a = implode(",", $a);

        $id = intval( $data -> id );
        $query = "UPDATE $this->table
        SET  $a 
        WHERE Id =  $id";
        
        $result = $app_db->query( $query );
        return $result;

    }

    public function get( $id ) {
        global $app_db;

        $id = intval( $id );

        $query = "SELECT * FROM $this->table WHERE Id =  $id";
        
        $result = $app_db->query( $query );
        return $app_db->fetch_assoc( $result );
    }

    public function getAll() {
        global $app_db;

        $query = "SELECT * FROM $this->table";
        
        $result = $app_db->query( $query );
        return $app_db->fetch_all( $result );
    }

}

/**
 * Insert a new balance 
 
function insert_balance( $amount ) {
	global $app_db;

	$amount  = $app_db->real_escape_string( $amount );

	$query = "INSERT INTO users_balances
	( Amount ) VALUES ( '$amount' )";

	$result = $app_db->query( $query );
	return $result;
}
*/