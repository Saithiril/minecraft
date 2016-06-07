<h1><?= $guild_info->name?></h1>
<p>Достижения: <?=$guild_info->achievementPoints?></p>
<p>Количество игроков: <?= count($guild_info->members)?></p>

<table border="1px" width="100%" class="character_list">
    <theader>
        <tr>
            <th>Аватар</th>
            <th>Имя</th>
            <th>Класс</th>
            <th>Раса</th>
            <th>Уровень</th>
            <th>Очки достижений</th>
            <th>Специализация</th>
            <th>Роль</th>
            <th>Ранг</th>
        </tr>
    </theader>
    <tbody>
        <?php foreach($guild_info->members as $member):?>
            <tr>
                <td><img src="http://render-api-eu.worldofwarcraft.com/static-render/eu/<?=$member->character->thumbnail?>" alt="Аватар"></td>
                <td><?=$member->character->name?></td>
                <td><?=$member->character->class?></td>
                <td><?=$member->character->race?></td>
                <td><?=$member->character->level?></td>
                <td><?=$member->character->achievementPoints?></td>
                <td><?=isset($member->character->spec) ? $member->character->spec->name : "-"?></td>
                <td><?=isset($member->character->spec) ? $member->character->spec->role : "-"?></td>
                <td><?=$member->rank?></td>
            </tr>
        <?php endforeach?>
    </tbody>
</table>

<?php //var_dump($guild_info->members[0]); ?>