<?php

/*
=====================================================
 Создание новых объектов
 -------------------------------------
 Файл: create.php
=====================================================
*/

if ( isset( $_SESSION['logged_user'] ) ) {

  if ( isset( $_POST['type'] ) ) {

    switch ( $_POST['type'] ) {

      case '1':

        $params = [];

        $params['date'] = strtotime( $_POST['date'] );

        if ( !$params['date'] ) {
          $error = 1;
        }
        else {

          if ( ( $params['date'] > strtotime( '2005-01-01' ) ) OR ( $params['date'] < strtotime( '1900-01-01' ) )  ) {
            $error = 1;
          }
          else {
            $params['date'] = date( "Y-m-d", $params['date'] );
          }

        }

        if ( !preg_match( '/^[а-яА-ЯЁёA-Za-z\s]+$/iu', $_POST['name'] ) OR mb_strlen( $_POST['name'] ) > 25 OR mb_strlen( trim( $_POST['name'] ) ) < 5 ) {
          $error = 1;
        }
        else {
          $params['name'] = preg_replace('/\s+/', ' ', $_POST['name'] );
        }

        if ( !preg_match( '/^[а-яА-ЯЁёA-Za-z0-9\s.,]+$/iu', $_POST['bio'] ) OR mb_strlen( $_POST['bio'] ) > 2000 OR mb_strlen( trim( $_POST['bio'] ) ) < 5 ) {
          $error = 1;
        }
        else {
          $params['bio'] = preg_replace('/\s+/', ' ', $_POST['bio'] );
        }

        if ( isset( $_FILES['photo'] ) AND !isset( $error ) ) {

          if ( $_FILES['photo']['type'] == 'image/png' ) {
            $type = 'png';
          }
          elseif( $_FILES['photo']['type'] == 'image/jpeg') {
            $type = 'jpg';
          }
          else {
            $error = 1;
          }

          if ( $_FILES['photo']['size'] > 1048576 ) {
            $error = 1;
          }

          if ( $_FILES['photo']['error'] != UPLOAD_ERR_OK ) {
            $error = 1;
          }

          if ( !isset( $error ) ) {

            do {

              $file = md5( basename( $_FILES["photo"]["name"] ) . time() ) . '.' . $type;
              $dir = ROOT_DIR . '/template/images/teachers/' . $file;

            } while ( file_exists( $dir ) );

            if ( move_uploaded_file( $_FILES["photo"]["tmp_name"], $dir ) ) {
              $params['photo'] = $file;
            }
            else {
              $error = 1;
            }

          }

        }
        else {
          $error = 1;
        }

        if ( !isset( $error ) ) {

          $query = $database->prepare( 'INSERT INTO teachers (name, biography, experience, photo) VALUES (:name, :bio, :date, :photo)' );
          $query->execute( $params );

          $page = returnInformationBox(
            'Готово',
            'Данные были успешно добавлены! Вы можете перейти на <a href="/">главную</a> страницу',
            'fas fa-check-circle'
          );

        }
        else {

          $page = returnInformationBox(
            'Ошибка',
            'Предоставленные данные заполнены в неправильной форме. Пожалуйста, <a href="/create">вернитесь</a> и заполните их в соотвествии с примерами.',
            'fas fa-times-circle'
          );

        }

      break;

      default:

        $page = returnInformationBox(
          'Ошибка',
          'Предоставленные данные заполнены в неправильной форме. Пожалуйста, <a href="/create">вернитесь</a> и заполните их в соотвествии с примерами.',
          'fas fa-times-circle'
        );

      break;
    }


  }
  else {

    $tpl = new Template;
    $page = $tpl->load('create.tpl')->compile();

  }

}
else {

  $page = returnInformationBox(
    'Вы не авторизованы',
    'Чтобы использовать эту страницу необходимо авторизоваться. Перейти на <a href="/login">страницу</a> авторизации',
    'fas fa-lock'
  );

}





 ?>
