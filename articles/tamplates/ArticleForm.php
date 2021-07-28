<form name="" action="index.php" method="POST">
    <table>
        <tr>
            <td colspan="2" align="center"><b>Новая заметка</b></td>
        </tr>
        <tr>
            <td></td>
            <td>Текст</td>
        </tr>
        <tr>
            <td></td>
            <td><textarea name="ArticleText" rows="10" cols="20" wrap="off"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input name="UserID" type="hidden" value="">
                <input name="Method" type="hidden" value="NewArticle">
                <input type="submit" value="Добавить">
            </td>
        </tr>
    </table>
</form>