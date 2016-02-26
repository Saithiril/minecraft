<div class="info">
<h2>Вход на сайт</h2>
<form action="/<?=$_SESSION['config']['host']?>auth/userAdd" method="post">
    <div class="b-table auth">
        <div class="b-table-row">
            <div class="b-table-cell  right half">
                <label for="username">Игровой ник</label>
            </div>
            <div class="b-table-cell  left">
                <input type="text" name="username"/>
            </div>
        </div>
        <div class="b-table-row">
            <div class="b-table-cell  right">
                <label for="password">Пароль</label>
            </div>
            <div class="b-table-cell  left">
                <input type="password" name="password"/>
            </div>
        </div>
        <div class="b-table-row">
            <div class="b-table-cell  right">
            </div>
            <div class="b-table-cell  left">
                <input type="submit" value="Войти">
            </div>
        </div>
    </div>
</form>
</div>