<? if($class_stat):?>
    <ul>
    <?foreach($class_stat as $stat) :?>
        <li><?=$stat->name?>: <?=$stat->count?></li>
    <?endforeach?>
    </ul>
<? endif?>
