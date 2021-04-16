<?php

/*
=====================================================
 Вывод списка учителей из базы
 -------------------------------------
 Файл: teachers.php
=====================================================
*/

$tpl = new Template;

$teachers = [];

$query = $database->prepare( 'SELECT * FROM teachers' );
$query->execute();

while ( $row = $query->fetch() ) {

  $grow = strtotime( $row['experience'] );
  $grow = time() - $grow;

  $teachers[] = $tpl->load('teacher_item.tpl')
  ->set( '{name}', $row['name'] )
  ->set( '{experience}', yearSuffix( floor( $grow / 31536000 ) ) )
  ->set( '{bio}', $row['biography'] )
  ->set( '{photo}', '/template/images/teachers/' . $row['photo'] )
  ->compile();

}

$tpl = new Template;

$tpl->load('teachers.tpl');

if ( $teachers ) {
  $tpl->set( '{teachers}', implode( "", $teachers ) );
}
else {
  $tpl->set( '{teachers}', '' );
}

$page = $tpl->compile();


 ?>
