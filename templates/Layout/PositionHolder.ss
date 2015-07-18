<% include BreadCrumbs %>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <div class="content">$Content</div>
              <p>Эта страница предназначена для работников КБМ, желающих участвовать в программе формирования и развития кадрового резерва «Жаңа толқын».</p>
              <% if Message %>
                $Message
              <% end_if %>
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
            <h2>Выберите резервную должность</h2>
            <table id="position_holder" class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            Отдел
                        </th>
                        <th>
                            Резервная должность
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
        <p>Для того чтобы учавствовать программе, пожалуйста, зарегестрируйтесь на сайте, или выполните <a href="/Security/login">вход</a></p>
        <% end_if %>
    </div>
</div>
</div>
<div id="loading"></div>
