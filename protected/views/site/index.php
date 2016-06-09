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
            <th><a href="?page=<?= $page?>&sort=name&dir=<?=(!$sort || $sort['field'] !== 'name') ? 'a' : $sort['dir']?>">Имя</a></th>
            <th><a href="?page=<?= $page?>&sort=class&dir=<?=(!$sort || $sort['field'] !== 'class') ? 'a' : $sort['dir']?>">Класс</a></th>
            <th><a href="?page=<?= $page?>&sort=race&dir=<?=(!$sort || $sort['field'] !== 'race') ? 'a' : $sort['dir']?>">Раса</a></th>
            <th><a href="?page=<?= $page?>&sort=level&dir=<?=(!$sort || $sort['field'] !== 'level') ? 'a' : $sort['dir']?>">Уровень</a></th>
            <th><a href="?page=<?= $page?>&sort=achievementPoints&dir=<?=(!$sort || $sort['field'] !== 'achievementPoints') ? 'a' : $sort['dir']?>">Очки достижений</a></th>
            <th><a href="?page=<?= $page?>&sort=rank&dir=<?=(!$sort || $sort['field'] !== 'rank') ? 'a' : $sort['dir']?>">Ранг</a></th>
            <th><a href="?page=<?= $page?>&sort=is_active&dir=<?=(!$sort || $sort['field'] !== 'is_active') ? 'a' : $sort['dir']?>">Активность</a></th>
            <th><a href="?page=<?= $page?>&sort=wait_delete&dir=<?=(!$sort || $sort['field'] !== 'wait_delete') ? 'a' : $sort['dir']?>">На удаление</a></th>
        </tr>
    </theader>
    <tbody>
        <?php foreach($characters as $member):?>
            <tr>
<!--                <td><img src="http://render-api-eu.worldofwarcraft.com/static-render/eu/--><?//=$member->thumbnail?><!--" alt="Аватар"></td>-->
                <td></td>
                <td><a href="/character?name=<?=$member->name?>"><?=$member->name?></a></td>
                <td><?=$member->className->name?></td>
                <td><?=$member->_race ? $member->_race->name : '-'?></td>
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