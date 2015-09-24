jQuery(function ($) {

    //Устанавливаем куку, если пользователь заходит в первый раз - показываем справку
    document.cookie ="visit=not_first_time";
    if(document.cookie.indexOf("not_first_time") >= 0){
        $('.modal').modal('show');
    }
    
    //Hide pop messages on click
    $(document).click(function () {
        $('.message').hide();
    });

    //Bootstrap styles to the table
    $('#Form_anketaForm :input').each(function(){
      if($(this).is(':submit')){
        $(this).addClass('action btn btn-primary').css('margin-top','1em');
      }else{
        $(this).addClass('requiredField form-control');
      }
    });

    //Check anket fields to hide it, if they are filled
    var checkAnketFieds = $("#Form_anketaForm :input").filter(function() {
        return $.trim(this.value).length === 0;
    }).length > 0;

    if (checkAnketFieds) {
      //Nothing to do!
    }else{
      $('.zayavka').addClass('col-md-12').removeClass('col-md-8');
      $('.anketa').hide();
    }

    //Тестирование(Testing function)
    $('#position_holder td a').on('click', function () {
        //Проверка на заполненность анкеты пользователя
        var anyFieldIsEmpty = $("#Form_anketaForm :input").filter(function() {
            return $.trim(this.value).length === 0;
        }).length > 0;

        if (anyFieldIsEmpty) {
            alertify.alert(ss.i18n._t('POSITION_MODULE.FILL_ALL_INPUTS'));
        }else{
            if ($(this).next().text() == '') {
                alertify.set({labels: {ok: "Ok", cancel: "Нет"}});
                alertify.alert(ss.i18n._t('POSITION_MODULE.NO_TESTS_YET'));
                return false;
            }
            //Создаем массив элемнтов вопросов, запускаем функцию вопросов, предаем количество элементов и первый элемент
            var questions = $(this).parents("td").find(".question").toArray();
            //id позиции(должности)
            var posId = $(this).attr('id');
            answerTheQuestion(questions, questions.length, 0, posId);
        }
        return false;
    });

    function answerTheQuestion(questions, num, pos, posId) {
        //Если количество вопросов равно нулю останавливаем тестирование, запускаем функцию установки статуса заяки пользователя
        if (num == 0) {
            addingStatus(posId);
            return false;
        }
        console.log(questions, num, pos, posId);
        var currentQuestion = questions[pos];
        alertify.set({labels: {ok: "Да", cancel: "Нет"}});
        alertify.confirm($(currentQuestion).text(), function (e) {
            if (e) {
                // user clicked "ok"
                //Запускаем функцию вопросов, количество уменьшаем на 1, а позицию преедвигаем на 1
                answerTheQuestion(questions, num - 1, pos + 1, posId);
            } else {
                // user clicked "cancel"
                alertify.set({labels: {ok: "Ok", cancel: "Нет"}});
                alertify.alert(ss.i18n._t('POSITION_MODULE.SORRY_YOU_CANNOT_ORDER'));
            }
        });
    }

    //Функция установки статуса пользователя при успешном прохождении теста
    function addingStatus(positionId) {
        $.ajax({
            beforeSend: function () {
                $("#loading").show();
            },
            complete: function () {
                $("#loading").hide();
            },
            url: window.location.href.match(/^[^\#\?]+/)[0] + '/addingStatus/' + positionId,
            type: "POST",
            data: positionId,
            success: function (data) {
                var message = ss.i18n.inject(ss.i18n._t('POSITION_MODULE.ORDER_ACCEPT'), {position: data});
                alertify.set({labels: {ok: "Ok", cancel: "Нет"}});
                alertify.alert(message);
                $("#zayavka").html('<h3>' + message + '</h3>');
                $("#letterUploadField").css('display', 'block');
                $("#Form_formSetOrder_PositionID").val(positionId);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alertify.set({labels: {ok: "Ok", cancel: "Нет"}});
                alertify.alert("ajax request addingStatus function, evaluates an error!");
            }
        });
    }

});
