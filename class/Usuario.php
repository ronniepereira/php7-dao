<?php

class Usuario {

    //Atributos
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;


    //GETTERS e SETTERS
    public function getIdusuario(){
        return $this->idusuario;
    }

    public function setIdusuario($value){
        $this->idusuario = $value;
    }

    public function getDeslogin(){
        return $this->deslogin;
    }

    public function setDeslogin($value){
        $this->deslogin = $value;
    }

    public function getDessenha(){
        return $this->dessenha;
    }

    public function setDessenha($value){
        $this->dessenha = $value;
    }

    public function getDtcadastro(){
        return $this->dtcadastro;
    }

    public function setDtcadastro($value){
        $this->descadastro = $value;
    }

    //METODOS
    public function loadById($id) {
        $sql = new Sql();
        $result = $sql->select("SELECT * FROM tb_usuarios WHERE user_id = :ID", array(
            ":ID"=>$id
        ));

        if (count($result) > 0) {
            $this->setData($result[0]);
        }
    }

    public static function getList(){
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY descr_login");
    }

    public static function search($login){
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE descr_login LIKE :SEARCH ORDER BY descr_login", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }

    public function login($login, $password){
        $sql = new Sql();
        $result = $sql->select("SELECT * FROM tb_usuarios WHERE descr_login = :LOGIN AND descr_senha = :SENHA", array(
            ":LOGIN"=>$login,
            ":SENHA"=>$password
        ));

        if (count($result) > 0) {
            $this->setData($result[0]);
        }
        else {
            throw new Exception("Login e/ou senha invalidos.");
        }
    }

    public function __toString(){
        return json_encode(array(
            "user_id"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()
        ));
    }

    public function __construct($login = "", $password=""){
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }

    public function setData($data){
        $this->setIdusuario($data['user_id']);
        $this->setDeslogin($data['descr_login']);
        $this->setDessenha($data['descr_senha']);
        $this->setDtcadastro(new DateTime($data['dt_cadastro']));
    }

    public function insert(){

        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha()
        ));

        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }

    public function update($login, $senha){
        $this->setDeslogin($login);
        $this->setDessenha($senha);

        $sql = new Sql();

        $sql->query("UPDATE tb_usuarios SET descr_login = :LOGIN, descr_senha = :PASSWORD WHERE user_id = :ID", array(
            ":LOGIN"=>$this->getDeslogin(),
            ":PASSWORD"=>$this->getDessenha(),
            ":ID"=>$this->getIdusuario()
        ));

    }

    public function delete(){
        $sql = new Sql();

        $sql->query("DELETE FROM tb_usuarios WHERE user_id = :ID", array(
            ':ID'=>$this->getIdusuario()
        ));

        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());
        
    }
}
?>