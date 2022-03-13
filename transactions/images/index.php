<?php 
require( '../../inc/init.php' );

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class Upload {

  public $name;
  public $path;
  // public $extension;

  function __construct($name) {
    $this->name = strtolower( str_replace(" ","-",$name) ); 
    $this->path = realpath(dirname(getcwd())) . '/images/'; 
    // $this->extension = pathinfo($this->name, PATHINFO_EXTENSION);
  }

/*   public function update_name() {
    $this->name = str_replace('.' . $this->extension,"",$this->name);
    $this->name = $this->name . '(1).' . $this->extension;
  } */

  public function check_extension($valid_extensions) {
    $extension = pathinfo($this->name, PATHINFO_EXTENSION);
    return in_array($extension, $valid_extensions);
  }

  public function file_exists() {
    return file_exists($this->name);
  }

  public function move_file($tmp_name) {
    return move_uploaded_file($tmp_name, $this->path . $this->name);
  }

}

$res['ok'] = false;

if (isset($_FILES['file']['name'])) {

  $Image = new Upload($_FILES['file']['name']);

  if ($Image->check_extension( array("jpg","jpeg","png") )) {

    if (!$Image->file_exists()) {

      $res['ok'] = $Image->move_file($_FILES['file']['tmp_name']);
      $res['name'] = $Image->name;
  
    } else {
      $res['name'] = false;
      $res['message'] = 'O nome já existe';
    }

  } else {
    $res['message'] = 'Only .jpg, .jpeg and .png Image allowed to upload';
  }

  
}

echo json_encode($res); 