<?php if($guild):?>
<h1><?= $guild->name?></h1>
<p>Достижения: <?=$guild->achievementPoints?></p>
<p>Количество игроков: <?= $count_all?></p>

    <div class="pagination">
        <?if($page > 1):?>
            <div class="__item"><a href="?page=1">В начало</a></div><div class="__item"><a href="?page=<?= $page - 1 ?>">Назад</a></div>
        <?endif?>
        <div class="__item">Страница <?=$page?> из <?=$pagecount?></div>
        <?if($page < $pagecount):?>
            <div class="__item"><a href="?page=<?= $page + 1 ?>">Вперед</a></div><div class="__item"><a href="?page=<?=$pagecount?>">В конец</a></div>
        <?endif?>
    </div>
<table border="1px" width="100%" class="character_list">
    <theader>
        <tr>
            <th>Аватар</th>
            <th>Имя</th>
            <th>Класс</th>
            <th>Раса</th>
            <th>Уровень</th>
            <th>Очки достижений</th>
            <th>Ранг</th>
            <th>Активность</th>
            <th>На удаление</th>
        </tr>
    </theader>
    <tbody>
        <?php foreach($characters as $member):?>
            <tr>
<!--                <td><img src="http://render-api-eu.worldofwarcraft.com/static-render/eu/--><?//=$member->thumbnail?><!--" alt="Аватар"></td>-->
                <td></td>
                <td><?=$member->name?></td>
                <td><?=$member->class?></td>
                <td><?=$member->race?></td>
                <td><?=$member->level?></td>
                <td><?=$member->achievementPoints?></td>
                <td><?=$member->rank?></td>
                <td><input type="checkbox" <?=$member->is_active ? 'checked' : ''?> id="is_active_<?=$member->name?>" onchange="activeChange(this, '<?=$member->name?>')"><label for="is_active_<?=$member->name?>">Играет</label></td>
                <td><input type="checkbox"<?=$member->wait_delete? 'checked' : ''?> id="wait_delete_<?=$member->name?>" onchange="deleteChange(this, '<?=$member->name?>')"><label
                        for="wait_delete_<?=$member->name?>">На удаление</label></td>
            </tr>
        <?php endforeach?>
    </tbody>
</table>
<?php endif?>
<?php //var_dump($pagecount); ?>