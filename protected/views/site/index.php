<?php if($guild):?>
<h1><?= $guild->name?></h1>
<p>Достижения: <?=$guild->achievementPoints?></p>
<p>Количество игроков: <?= count($characters)?></p>

<table border="1px" width="100%" class="character_list">
    <theader>
        <tr>
            <th>Аватар</th>
            <th>Имя</th>
            <th>Класс</th>
            <th>Раса</th>
            <th>Уровень</th>
            <th>Очки достижений</th>
<!--            <th>Специализация</th>-->
<!--            <th>Роль</th>-->
            <th>Ранг</th>
        </tr>
    </theader>
    <tbody>
        <?php foreach($characters as $member):?>
            <tr>
                <td><img src="http://render-api-eu.worldofwarcraft.com/static-render/eu/<?=$member->thumbnail?>" alt="Аватар"></td>
                <td><?=$member->name?></td>
                <td><?=$member->class?></td>
                <td><?=$member->race?></td>
                <td><?=$member->level?></td>
                <td><?=$member->achievementPoints?></td>
<!--                <td>--><?//=isset($member->character->spec) ? $member->character->spec->name : "-"?><!--</td>-->
<!--                <td>--><?//=isset($member->character->spec) ? $member->character->spec->role : "-"?><!--</td>-->
<!--                <td>--><?//=$member->rank?><!--</td>-->
            </tr>
        <?php endforeach?>
    </tbody>
</table>
<?php endif?>
<?php //var_dump($guild_info->members[0]); ?>