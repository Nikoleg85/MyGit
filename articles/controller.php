<?php
class Controller {
	
	public $Model;
	
    public $View;

    private $UserId;
	
	public function __construct(){
        $this->Model = new Model();
        $this->View = new View();
        $this->UserId = 0;
        if (isset($_SESSION['ArticleUserID']) && ($_SESSION['ArticleUserID'] > 0) && is_numeric($_SESSION['ArticleUserID']))
            $this->UserId = $_SESSION['ArticleUserID'];
    }

    private function CheckUser(){
        if ($this->UserId == 0) return false;
        return true;
    }

    private function RegNewUser(){
        $data = $this->Model->CheckData($_POST);

        if (isset($data["Nikname"]) && (strlen($data["Nikname"]) > 3)
        && isset($data["Pass"]) && isset($data["Pass2"]) 
        && ($data["Pass"] == $data["Pass2"]) && (strlen($data["Pass"]) > 3)){
            $this->Model->Add_UserToTable($data);
            echo "Вы успешно зарегистрировались";
        } else echo "Ошибка в веденных данных";
        echo "<br>";
    }

    private function EnterUser(){
        $User = $this->Model->get_UserByLP($_POST);
        if (isset($User["ID"]) && is_numeric($User["ID"]) && ($User["ID"] > 0)){
            $this->UserId = $User["ID"];
            $_SESSION['ArticleUserID'] = $User["ID"];
            echo "Enter Ok ";
        } else {
            $this->UserId = 0;
            $_SESSION['ArticleUserID'] = 0;
            echo "Enter Bad";
        }
    }

    private function NewArticle(){
        //DateTimeCreate UserId ArticleText
        $data = array();
        $data["ArticleText"] = htmlspecialchars($_POST["ArticleText"]);
        $data["UserId"] = $this->UserId;
        $data["DateTimeCreate"] = date("Y-m-d H:i:s", time());
        $this->Model->Add_ArticleToTable($data);        		
    }
	
	public function action_index(){
        if ($_POST["Method"] == "NewUser") $this->RegNewUser();
        if (($_POST["Method"] == "EnterUser") || ($_GET["exit"] == "1")) $this->EnterUser();

        if ($this->CheckUser()){
            if ($_POST["Method"] == "NewArticle") {
                $this->NewArticle();
            }
        }
        $this->View->generate("ShowArticles", $this->Model->get_ListArticles());
        if ($this->CheckUser()){
            $this->View->generate("ArticleForm");
            echo '<a href="index.php?exit=1">Выйти</a>';
        } else {
            if ($_GET["reg"] == "1") $this->View->generate("RegistrationForm");
            else $this->View->generate("EnterForm");
        }
    }
}?>