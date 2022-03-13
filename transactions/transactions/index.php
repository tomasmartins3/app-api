<?php 
require( '../../inc/init.php' );

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER['REQUEST_METHOD'];

if( isset($_GET['id']) ) {
    $id = $_GET['id'];
}

$Transaction = new Element('transactions_data');

switch ($method) {
    
  case 'POST':
    $data = file_get_contents('php://input');

    $data = json_decode($data);

    $transactionData = $data -> data;

    // $r = $Transaction->insert($transactionData);

    echo json_encode( $data ); 
    break;

/*   case 'PUT':
    $data = file_get_contents('php://input');

    $data = json_decode($data);

    $postData = $data -> postData;

    $r = $Transaction->update($postData);

    echo json_encode( $r ); 
    break;
*/   
  case 'GET':
     
    if( isset($id) ) {
      $p = $Post-> get($id);

      $statusId = $p['status'];
      $p['status'] = get_status($statusId)['name'];

      $authorId = $p['author'];
      $p['author'] = json_decode(json_encode(get_author($authorId)), true);

    } else {
      $p = $Post-> getAll();

      for ($i=0; $i < count($p); $i++) { 

        $statusId = $p[$i]['status'];
        $p[$i]['status'] = get_status($statusId)['name'];

        $authorId = $p[$i]['author'];
        $p[$i]['author'] = json_decode(json_encode(get_author($authorId)), true);

      }
    }

    $r['posts'] = $p;
    $r['allData'] = $p;
    $r['total'] = isset($id) ? 1 : count($p);
    echo json_encode($r);
    break;
      
  default:
    $r['ok'] = false; 
    echo json_encode($r); 
    break;
}
/*
"array(12) {
  [0]=>
  int(1)
  [1]=>
  string(20) "Marketing de afiliad"
  [2]=>
  string(22) "marketing-de-afiliados"
  [3]=>
  string(29) "/static/media/06.1c554057.jpg"
  [4]=>
  object(stdClass)#5 (4) {
    ["name"]=>
    string(14) "Tomás Martins"
    ["role"]=>
    string(25) "CEO Atributo Prioritário"
    ["color"]=>
    string(13) "light-success"
    ["avatar"]=>
    string(37) "/static/media/avatar-s-9.e2785e7a.jpg"
  }
  [5]=>
  array(2) {
    [0]=>
    string(5) "quote"
    [1]=>
    string(7) "fashion"
  }
  [6]=>
  string(19) "2022-03-03 12:00:00"
  [7]=>
  string(9) "Published"
  [8]=>
  int(2345)
  [9]=>
  int(349)
  [10]=>
  int(74)
  [11]=>
  string(609) "<p>initialContent. ipsum dolor sit. Amet dessert donut candy chocolate bar cotton dessert candy chocolate. Candy muffin danish. Macaroon brownie jelly beans marzipan cheesecake oat cake. Carrot cake macaroon chocolate cake. Jelly brownie jelly. Marzipan pie sweet roll.&nbsp;</p>
<p>Liquorice dragée cake chupa chups pie cotton candy jujubes bear claw sesame snaps. Fruitcake chupa chups chocolate bonbon lemon drops croissant caramels lemon drops. Candy jelly cake marshmallow jelly beans dragée macaroon. Gummies sugar plum fruitcake. Candy canes candy cupcake caramels cotton candy jujubes fruitcake.</p>"
}
null"


"id = '1',title = 'Marketing de ',slug = 'marketing-de-afiliados',image = '/static/media/06.1c554057.jpg',date = '2022-03-03 12:00:00',status = 'Published',views = '2345',likes = '349',comments = '74',
content = '<p>initialContent. ipsum dolor sit. Amet dessert donut candy chocolate bar cotton dessert candy chocolate. Candy muffin danish. Macaroon brownie jelly beans marzipan cheesecake oat cake. Carrot cake macaroon chocolate cake. Jelly brownie jelly. Marzipan pie sweet roll.&nbsp;</p>
<p>Liquorice dragée cake chupa chups pie cotton candy jujubes bear claw sesame snaps. Fruitcake chupa chups chocolate bonbon lemon drops croissant caramels lemon drops. Candy jelly cake marshmallow jelly beans dragée macaroon. Gummies sugar plum fruitcake. Candy canes candy cupcake caramels cotton candy jujubes fruitcake.</p>'"

"title = 'Marketing de',slug = 'marketing-de-afiliados',image = '/static/media/06.1c554057.jpg',date = '2022-03-03 12:00:00',status = 'Published',views = '2345',likes = '349',comments = '74',content = '<p>initialContent. ipsum dolor sit. Amet dessert donut candy chocolate bar cotton dessert candy chocolate. Candy muffin danish. Macaroon brownie jelly beans marzipan cheesecake oat cake. Carrot cake macaroon chocolate cake. Jelly brownie jelly. Marzipan pie sweet roll.&nbsp;</p>
<p>Liquorice dragée cake chupa chups pie cotton candy jujubes bear claw sesame snaps. Fruitcake chupa chups chocolate bonbon lemon drops croissant caramels lemon drops. Candy jelly cake marshmallow jelly beans dragée macaroon. Gummies sugar plum fruitcake. Candy canes candy cupcake caramels cotton candy jujubes fruitcake.</p>'"

"Cannot add or update a child row: a foreign key constraint fails (`u617199672_tomas`.`blog_posts`, CONSTRAINT `blog_posts_ibfk_1` FOREIGN KEY (`status`) REFERENCES `blog_posts_status` (`id`))"
*/