<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type"/>
    <link rel="stylesheet" type="text/css" href="/<?=$_SESSION['config']['host']?>style/style.css"/>
</head>
<body>
<div class="content">
    <div class="b-header b-table">
        <div class="b-table-row">
            <div class="b-table-cell">
                <img src="/<?=$_SESSION['config']['host']?>img/header.png" alt="technomagik"/>
            </div>
            <?if(isset($_SESSION['user'])): ?>
                <div class="b-table-cell right top">
                    <a href="/auth/userInfo?id=<?=$_SESSION['user']['id']?>"><?=$_SESSION['user']['username']?></a>
                    <a href="/auth/logout">Выход</a>
                </div>
            <?else: ?>
                <div class="b-table-cell right top">
                    <a href="/auth/">Войти</a>
                    <span>(Регистрация возможна только в игре)</span>
                </div>
            <?endif?>
        </div>
    </div>
    <div>
        <div class="b-left">
            <ul>
                <li>
                    <a href="/<?=$_SESSION['config']['host']?>">Главная страница</a>
                </li>
                <li>
                    <a href="/">Особенности сервера</a>
                </li>
                <li>
                    <a href="/">Правила</a>
                </li>
                <li>
                    <a href="/">Скачать клиент</a>
                </li>
                <li>
                    <a href="/">Запрещенные вещи</a>
                </li>
                <li>
                    <a href="/">Конфигурации модов</a>
                </li>
                <li>
                    <a href="/">База знаний</a>
                </li>
                <li>
                    <a href="/">Города</a>
                </li>
                <li>
                    <a href="/">Помощь</a>
                </li>
                <li>
                    <a href="/">Группы игроков</a>
                </li>
                <li>
                    <a href="/">Поддержка</a>
                </li>
                <li>
                    <a href="/">Игроки</a>
                </li>
                <li>
                    <a href="/">Администрация</a>
                </li>
                <li>
                    <a href="/">Для модераторов</a>
                </li>
                <li>
                    <a href="/">Доп. услуги</a>
                </li>
                <li>
                    <a href="/">Пополнить счет</a>
                </li>
            </ul>
        </div>
        <div class="b-center">
            <?php echo $content; ?>
        </div>
    </div>
</div>
</body>
</html>