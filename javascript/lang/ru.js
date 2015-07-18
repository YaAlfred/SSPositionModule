/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (typeof (ss) == "underfined" || typeof (ss.i18n) == "undefined") {
    console.error('Class ss.i18n not defined');
} else {
    ss.i18n.addDictionary('ru', {
        "POSITION_MODULE.FILL_ALL_INPUTS": "Пожалуйста заполните и сохрание все поля вашей анкеты!",
        "POSITION_MODULE.NO_TESTS_YET": "Тестов в данном разделе пока нет!",
        "POSITION_MODULE.SORRY_YOU_CANNOT_ORDER": "Приносим свои извинения, на данный момент вы не можете претендовать на занятие данной должности!",
        "POSITION_MODULE.ORDER_ACCEPT": 'После загрузки письма, нажмите кнопку "Отправить на рассмотрение", чтобы отправить заявку'
    });
}


