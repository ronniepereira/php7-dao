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
            $row = $result[0];

            $this->setIdusuario($row['user_id']);
            $this->setDeslogin($row['descr_login']);
            $this->setDessenha($row['descr_senha']);
            $this->setDtcadastro(new DateTime($row['dt_cadastro']));
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
}
?>