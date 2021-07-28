<form name="" action="index.php" method="POST">
    <table>
        <tr>
            <td colspan="2" align="center"><b>Регистрация</b></td>
        </tr>
        <tr>
            <td>Логин</td>
            <td><input name="Nikname" type="text" value=""></td>
        </tr>
        <tr>
            <td>Имя</td>
            <td><input name="Name" type="text" value=""></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input name="Email" type="text" value=""></td>
        </tr>
        <tr>
            <td>Пароль</td>
            <td><input name="Pass" type="password" value=""></td>
        </tr>
        <tr>
            <td>Повторить пароль</td>
            <td><input name="Pass2" type="password" value=""></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input name="Method" type="hidden" value="NewUser">
                <input type="submit" value="Зарегистрироваться">
            </td>
        </tr>
    </table>
</form>