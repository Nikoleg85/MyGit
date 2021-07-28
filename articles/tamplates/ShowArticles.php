<style>
   .size {
    white-space: nowrap; /* Отменяем перенос текста */
    overflow: hidden; /* Обрезаем содержимое */
    padding: 5px; /* Поля */
    /*background: #fc0; /* Цвет фона */
    position: relative; /* Относительное позиционирование */
    width: 300px; 
   }
   .size::after {
    content: ''; /* Выводим элемент */
    position: absolute; /* Абсолютное позиционирование */
    right: 0; top: 0; /* Положение элемента */
    width: 40px; /* Ширина градиента*/
    height: 100%; /* Высота родителя */
    /* Градиент 
    background: -moz-linear-gradient(left, rgba(255,204,0, 0.2), #fc0 100%);
    background: -webkit-linear-gradient(left, rgba(255,204,0, 0.2), #fc0 100%);
    background: -o-linear-gradient(left, rgba(255,204,0, 0.2), #fc0 100%);
    background: -ms-linear-gradient(left, rgba(255,204,0, 0.2), #fc0 100%);
    background: linear-gradient(to right, rgba(255,204,0, 0.2), #fc0 100%);
    */
   }
  </style>

<table width="100%">
    <tr>
        <th>№</th>
        <th>Автор</th>
        <th>Дата</th>
        <th>Превью</th>
        <th>Действия</th>
    </tr>

    <?php for ($i=0;$i<count($data); $i++){?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data[$i]["User"]["Name"]; ?></td>
            <td><?php echo $data[$i]["DateTimeCreate"]; ?></td>
            <td><div class="size"><?php echo $data[$i]["ArticleText"]; ?></div></td>
            <td></td>
        </tr>
    <?php  } ?>
</table>