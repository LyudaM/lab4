<?php

/*
=====================================================
 Некоторые функции для важной работы
 -------------------------------------
 Файл: functions.php
=====================================================
*/

#Возвращает суффик для года (например 2 года или 7 лет)
function yearSuffix( $year ) {

    $year = abs( $year );

    $t1 = $year % 10;
    $t2 = $year % 100;

    if ( $t1 == 1 AND $t2 != 11 ) {
      return "{$year} год";
    }
    elseif ( $t1 >= 2 AND $t1 <= 4 AND ($t2 < 10 || $t2 >= 20 ) ) {
      return "{$year} года";
    }
    else {
      return "{$year} лет";
    }
}

# Возвращает панель пользователя сверху
function returnPopUpProfile()
{

  global $user_data;

  if (isset( $_SESSION['logged_user'] ) ) {

    $tpl = new Template;
    return $tpl->load( 'user.tpl' )->set( '{username}', $user_data['login'] )->compile();

  }
  else {

    return '<a class="btn btn-primary" href="/login">Войти</a>';

  }

}

# Выводит окно с информацией на сайте
function returnInformationBox( $title, $info, $icon = '' )
{

  $tpl = new Template;

  $tpl->load( 'error.tpl' )->set( '{title}', $title );

  if ( $icon ) {
    $tpl->set( '{icon}', "<i class=\"{$icon} text-primary\"></i>" );
  }
  else {
    $tpl->set( '{icon}', '' );
  }

  return $tpl->set( '{info}', $info )->compile();

}


 ?>
