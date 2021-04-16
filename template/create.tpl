<div class="container">
    <h1 class="mt-5">Создать <a href="/create#start" id="start"><i class="fas fa-plus"></i></a></h1>
    <p class="lead mb-5">
      На этой странице вы можете создать новый объект и добавить его в нашу базу.
    </p>

    <form action="/create" method="POST" enctype="multipart/form-data">
      <div class="row">

        <div class="col-12">
          <div class="form-group">
          <label for="selectType">Тип объекта</label>
          <select class="form-control" name="type" id="selectType">
            <option value="0">--Выберите тип--</option>
            <option value="1" selected>Новый преподаватель</option>
          </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="inputName">Имя</label>
            <input type="text" class="form-control" name="name" id="inputName" minlength="5" maxlength="25" placeholder="Алексей Бишкеков" autocomplete="off" required>
            <div class="invalid-feedback">Допустимы только буквы из русского, английского алфавита и пробел. Минимум - 5 символов</div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="inputDate">Стаж преподавания (укажите дату начала работы)</label>
            <input type="date" class="form-control" min='1900-01-01' max='2005-01-01' name="date" id="inputDate" placeholder="гггг-мм-дд" autocomplete="off" required>
            <div class="invalid-feedback">Формат ввода даты гггг-мм-дд (например 2016-12-10)</div>
          </div>
        </div>


        <div class="col-md-12">
          <div class="form-group">
            <label for="inputPhoto">Загрузить аватар</label>
             <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fas fa-file"></i> </span>
              </div>
              <div class="custom-file">
                <input type="file" accept="image/jpeg, image/png" name="photo" class="custom-file-input" id="inputPhoto" required>
                <label class="custom-file-label" for="inputPhoto" data-browse="Аватар">.JPG или .PNG до 1MB</label>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group">
            <label for="inputBio">Введите биографию</label>
            <textarea class="form-control" name="bio" id="inputBio" rows="5" minlength="5" placeholder="Подробно опишите преподавателя. Его жизненные принципы, увлечения и т.д." maxlength="2000" style="resize:none" autocomplete="off" required></textarea>
            <div class="invalid-feedback">Разрешены только буквы английского или русского алфавита, а также запятая, пробел, точка и цифры от 0 до 9. Минимум - 5 символов</div>
          </div>
        </div>

      </div>


      <button type="submit" class="btn btn-primary btn-lg w-100 my-4 animate__animated animate__headShake" id="sendBtn">Отправить</button>
    </form>

    <p>Вернуться на <a href="/">главную страницу</a></p>
  </div>

  <script type="text/javascript">

  $('form').submit( function( event ) {

    event.preventDefault();

    let may_send = 1

    $('form').find(':input').removeClass('is-invalid');

    if ( !/^[А-Яа-яЁёA-Za-z\s]+$/iu.test($('#inputName').val()) || $("#inputBio")[0].length < 5 || $("#inputBio")[0].length > 25 ) {
      $('#inputName').addClass('is-invalid');
      may_send = 0
    }

    if ( !/^[А-Яа-яЁёA-Za-z0-9\s.,]+$/iu.test($('#inputBio').val()) || $("#inputBio")[0].length < 5 || $("#inputBio")[0].length > 2000 ) {
      $('#inputBio').addClass('is-invalid');
      may_send = 0
    }

    if ( !/^\d{4}-\d{2}-\d{2}$/.test($('#inputDate').val()) ) {
      $('#inputDate').addClass('is-invalid');
      may_send = 0
    }

    if ( $("#inputPhoto")[0].files.length === 0 ) {
      $('#inputPhoto').addClass('is-invalid');
      may_send = 0
    }

    if ( may_send ) {
      this.submit();
    }

  });

  </script>
