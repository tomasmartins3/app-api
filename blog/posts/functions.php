<?php
class Element {

  private $table = 'blog_posts';

  public function update( $data ) {  
	global $app_db;

	$array = (array) $data;
	$a =  [];

	foreach($array as $x => $y) {

		if (gettype($y)!= 'array' && gettype($y)!= 'object') {

			if($x != 'id') {

				array_push($a, "$x = '$y',");

			}
		}
	}

	$a = implode($a);
	$a = substr($a, 0, -1);

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
 *
 * @param $user
 * @param $amount
 
function insert_balance( $amount ) {
	global $app_db;

	$amount  = $app_db->real_escape_string( $amount );

	$query = "INSERT INTO users_balances
	( Amount ) VALUES ( '$amount' )";

	$result = $app_db->query( $query );
	return $result;
}
*/

function get_status( $id ) {
	global $app_db;

	$id = intval( $id );

	$query = "SELECT * FROM blog_posts_status WHERE Id = " . $id;
	$result = $app_db->query( $query );

	return $app_db->fetch_assoc( $result );
}

function get_author( $id ) {
	global $app_db;

	$id = intval( $id );

	$query = "SELECT * FROM blog_authors WHERE Id = " . $id;
	$result = $app_db->query( $query );

	return $app_db->fetch_assoc( $result );
}

