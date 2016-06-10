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
    <?php foreach($character->specs as $spec):?>
        <li><?=$spec->name?></li>
    <?endforeach?>
</ul>

<a href="/">Назад</a>
<?// print_r($character)?>