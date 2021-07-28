<form name="" action="index.php" method="POST">
    <table>
        <tr>
            <td colspan="2" align="center"><b>Вход</b></td>
        </tr>
        <tr>
            <td>Логин</td>
            <td><input name="Nikname" type="text" value=""></td>
        </tr>
        <tr>
            <td>Пароль</td>
            <td><input name="Pass" type="password" value=""></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input name="Method" type="hidden" value="EnterUser">
                <input type="submit" value="Войти">&nbsp;<a href="index.php?reg=1">Регистрация</a>
            </td>
        </tr>
    </table>
</form>