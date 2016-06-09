<h3><?=$character->name?></h3>
<a href="/character/update?name=<?=$character->name?>">Обновить данные</a>
<div>
<!--    <img src="http://render-api-eu.worldofwarcraft.com/static-render/eu/--><?//=$character->thumbnail?><!--" alt="Аватар">-->
</div>
<p>Уровень: <?=$character->level?></p>
<p>Класс: <?=$character->className->name?></p>
<p>Раса: <?=$character->_race ?$character->_race->name : '-'?></p>
<p>Специализации: </p>
<ul>
    <li><?=isset($character->first_spec) ? $character->first_spec->name : 'нет'?></li>
    <li><?=isset($character->second_spec) ? $character->second_spec->name : 'нет'?></li>
</ul>

<a href="/">Назад</a>
<?// print_r($character)?>