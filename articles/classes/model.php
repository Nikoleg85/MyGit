<?php

class Model{
    private $dbName = "demo";

    private $dbUserName = "demo";

    private $dbUserPass = "demo";

    //private $dbTableName = "";

    private $mysqli = null;

    public function __construct(){
        $this->mysqli = new mysqli("localhost", $this->dbUserName, $this->dbUserPass, $this->dbName);
        if ($this->CheckExistsTable("UsersTable") === false) $this->Create_UsersTable();
        if ($this->CheckExistsTable("ArticlesTable") === false) $this->Create_ArticlesTable();
    }

    private function CheckExistsTable($TableName){
        $result = $this->mysqli->query("SHOW TABLES FROM `".$this->dbName."`");
        if ($result)
            while ($row = $result->fetch_array()){
                if ($TableName == $row[0]) {
                    return true;
                }
            }
        return false;
    }

    private function Create_UsersTable(){
        $query = "CREATE TABLE `UsersTable` ( "; 
        $query .= "ID int( 11 ) NOT NULL AUTO_INCREMENT ,";
        $query .= "Nikname BLOB,";
        $query .= "Pass BLOB,";
        $query .= "Name BLOB,";
        $query .= "Email BLOB,";
        $query .= "PRIMARY KEY(ID));";
        $this->mysqli->query($query);
    }

    private function Create_ArticlesTable(){
        $query = "CREATE TABLE `ArticlesTable` ( "; 
        $query .= "ID int( 11 ) NOT NULL AUTO_INCREMENT ,";
        $query .= "DateTimeCreate BLOB,";
        $query .= "ArticleText BLOB,";
        $query .= "UserId BLOB,";
        $query .= "PRIMARY KEY(ID));";
        $this->mysqli->query($query);
    }

    public function CheckData($data = array()){
        $r_data = array();
        foreach ($data as $key => $value) {
            $r_data[$key] = str_replace("'","&prime;",$value);//&prime;
        }
        return $r_data;
    }

    public function Add_UserToTable($user = array()){
        //$user = $this->CheckData($user);
        $query = "INSERT INTO `UsersTable` VALUES (null, '".$user["Nikname"]."', '".$user["Pass"]."', '".$user["Name"]."', '".$user["Email"]."');";
        $this->mysqli->query($query);
    }

    public function Update_UserInTable($user = array()){
        $user = $this->CheckData($user);
        //$query = "UPDATE `UsersTable` SET Nikname = '".$user["Nikname"]."', Pass = '".$user["Pass"]."', Name = '".$user["Name"]."', Email = '".$user["Email"]."' WHERE ID = ".$user["ID"].";";
        $query = "UPDATE `UsersTable` SET Nikname = '".$user["Nikname"]."', Name = '".$user["Name"]."', Email = '".$user["Email"]."' WHERE ID = ".$user["ID"].";";
        $this->mysqli->query($query);
    }
    
    public function get_UserByLP($user = array()){
        $user = $this->CheckData($user);
        $query = "SELECT * FROM `UsersTable` WHERE (Nikname = '".$user["Nikname"]."') AND (Pass = '".$user["Pass"]."');";
        $Users = $this->mysqli->query($query);
        if ($User = $Users->fetch_array()){
            return $User;
        }
        return false;
    }

    public function Add_ArticleToTable($article = array()){
        $article = $this->CheckData($article);
        $query = "INSERT INTO `ArticlesTable` VALUES (null, '".$article["DateTimeCreate"]."', '".$article["ArticleText"]."', '".$article["UserId"]."');";
        $this->mysqli->query($query);
    }

    public function Update_ArticleInTable($article = array()){
        $article = $this->CheckData($article);
        $query = "UPDATE `ArticlesTable` SET DateTimeCreate = '".$article["DateTimeCreate"]."', ArticleText = '".$article["ArticleText"]."', UserId = '".$article["UserId"]."' WHERE ID = ".$user["ID"].";";
        $this->mysqli->query($query);
    }

    public function get_ListArticles($parametrs=array()){
        $result = array();
        $query = "SELECT * FROM `ArticlesTable`;";
        $Articles = $this->mysqli->query($query);
        if ($Articles)
            while ($Article = $Articles->fetch_array()){
                $query = "SELECT * FROM `UsersTable` WHERE ID = ".$Article["UserId"].";";
                $Users = $this->mysqli->query($query);
                if ($User = $Users->fetch_array()){
                    $Article["User"] = $User;
                }
                $result[] = $Article;
            }
        return $result;
	}
}