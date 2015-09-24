<% include BreadCrumbs %>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <div class="content">$Content</div>
              <a class="btn btn-default" href="#" role="button" style="float:right;" data-toggle="modal" data-target="#Information">Справка</a>
              <p>Эта страница предназначена для работников КБМ, желающих участвовать в программе формирования и развития кадрового резерва «Жаңа толқын».</p>
              <% if Message %>
                $Message
              <% end_if %>
              <!-- Modal -->
                <div class="modal fade" id="Information" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Справка</h4>
                      </div>
                      <div class="modal-body">
                        <p>Уважаемые сотрудники АО «Каражанбасмунай» руководством компании утверждена программа кадрового резерва «Жана Толкын»
                        в рамках которой осуществляются следующие перемещения служащих:</p>
                        <img src="ss-position-module/images/grafic.jpg" style="width:100%;"/>
                        <ol>
                        <li>
                        Перемещение на один уровень (на одну должность) вверх в рамках «своего» СП;
                        Например, ведущий инженер ЦДН может встать в кадровый резерв на должность заместителя Начальника ЦДН
                         (ведущий инженер ЦДН не может претендовать на должность начальника ЦДН). 
                        </li>
                        <li>Перемещение на один уровень (на одну должность) вверх в другое СП;
                        Например, заместитель начальника ЦДН может встать в кадровый резерв на должность начальника ЦППН </li>
                        <li>Перемещение на должность, аналогичную занимаемой, в другое СП;
                        Например, ведущий инженер ЦДН может встать в кадровый резерв на должность ведущего инженера ЦППН
                        Примечание: При соответствии квалификационным требованиям к данной должности (согласно должностной инструкции), в том числе опыт работы и стаж (перейти к регистрации)
                        Решение принимается Комитетом по кадровому резерву с учетом ценности данного перемещения для компании.</li>
                        </ol>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        <% if CurrentMember %>
        <div class="col-md-4 anketa">
            <div id="anketa">
                <h2>Заполните вашу анкету</h2>
                $anketaForm
                <div style="clear:both;"></div>
            </div>
        </div>
        <div class="col-md-8 zayavka">
            <div id="zayavka"></div>
            <div id="letterUploadField" style="display:none;">
                <p><small>* Письмо должно быть в формате ms-word(doc, docx), 12 кегль шрифта TimesNewRoman</small></p>
                $formSetOrder
                <div style="clear:both;"></div>
            </div>
            <h2>Выберите должность на которую вы претендуете</h2>
            <table id="position_holder" class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            Структурное подразделение
                        </th>
                        <th>
                            Претендуемая должность
                        </th>
                        <th>
                            Подано заявок
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <% loop $Positions %>
                    $anketaForm
                    <tr><td>$Department.Name</td>
                        <td><a id="$ID" href="#">$Name</a>
                            <% loop $PositionQuestions %>
                            <div class="question">$Question</div>
                            <% end_loop %>
                        </td>
                        <td>
                            $Orders.Count
                        </td>
                    </tr>
                    <% end_loop %>
                </tbody>
            </table>
        </div>
        <% else %>
        <p>Для того чтобы учавствовать программе, пожалуйста, <a href="/profile-page">зарегестрируйтесь</a> на сайте, или выполните <a href="/Security/login">вход</a></p>
        <% end_if %>
    </div>
</div>
</div>
<div id="loading"></div>
