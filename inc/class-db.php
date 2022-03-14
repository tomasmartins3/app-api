<?php

class Db
{

  private $app_db = false;

  public function __construct($host, $user, $password, $database)
  {
    $this->app_db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if ($this->app_db === false) {
      die('Database connection error');
    }
  }

  public function query($query)
  {
    $result = mysqli_query($this->app_db, $query);
    if (!$result) {
      die($this->get_last_error());
    }

    return $result;
  }

  public function get_last_error()
  {
    return mysqli_error($this->app_db);
  }

  public function fetch_all($result)
  {
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }

  public function fetch_assoc($result)
  {
    return mysqli_fetch_assoc($result);
  }

  public function real_escape_string($string)
  {
    return mysqli_real_escape_string($this->app_db, $string);
  }
  public function insert_id()
  {
    return mysqli_insert_id($this->app_db);
  }
}
