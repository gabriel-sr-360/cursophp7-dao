<?php 
class Usuario{

private $idusuario;
private $deslogin;
private $dessenha;
private $dtcadastro;


public function getIdusuario(){
return $this->idusuario;
}

public function setIdusuario($idusuario){
$this->idusuario = $idusuario;
}

public function getDeslogin(){
return $this->deslogin;
}

public function setDeslogin($deslogin){
$this->deslogin = $deslogin;
}

public function getDessenha(){
return $this->dessenha;
}

public function setDessenha($dessenha){
$this->dessenha = $dessenha;
}

public function getDtcadastro(){
return $this->dtcadastro;
}

public function setDtcadastro($dtcadastro){
$this->dtcadastro = $dtcadastro;
}

public function __construct($login ="", $senha=""){
 $this->deslogin = $login;
 $this->dessenha = $senha; 
}

public function __toString(){	
return json_encode(array(
	"idusuario"=>$this->getIdusuario(),
	"deslogin"=>$this->getDeslogin(),
	"dessenha"=>$this->getDessenha(),
	"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
));
}

public function setData($data){
$this->setIdusuario($data['idusuario']);
$this->setDeslogin($data['deslogin']);
$this->setDessenha($data['dessenha']);
$this->setDtcadastro(new DateTime($data['dtcadastro']));
}

//Busca Usuario pelo ID
public function loadById($id){
$sql = new Sql();
$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
	":ID"=>$id 
));

if(count($results) > 0) {	
	$this->setData($results[0]);
}
}

//Listar Usuários
public static function listUsuarios(){
$sql = new Sql();

return $sql->select('SELECT * FROM tb_usuarios ORDER BY dtcadastro');
}

public static function search($login){
$sql = new Sql();

return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(':SEARCH'=>"%".$login."%"));
}


//Busca os dados do usuário a partir dp login e senha 
public function login($login, $pass){
$sql = new Sql();
$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN  and dessenha = :PASSWORD", array(
	":LOGIN"=>$login,
	":PASSWORD"=>$pass
));

if(count($results) > 0) {	
    $this->setData($results[0]);
}else{
	throw new Exception("Login ou Senha Inválidos");
}
}

//Inserir Usuario
public function inserirUsuario(){
$sql = new Sql();
//CALL para procedure em MYSQL, se fosse SQL seria EXECUTE
$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)",  array(
	':LOGIN'=>$this->getDeslogin(),
	':SENHA'=>$this->getDessenha() 
));
if(count($results) > 0){
$this->setData($results[0]);
}else{
	throw new Exception("Qualquer coisa");
}
}

//UPDATE
public function update($login, $password){
	$this->setDeslogin($login);
	$this->setDessenha($password);
  

    $sql = new Sql();

    $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
        ':LOGIN'=>$this->getDeslogin(),
        ':PASSWORD'=>$this->getDessenha(),
        ':ID'=>$this->getIdusuario()   
    ));
}

//DELETE
public function delete(){
	$sql = new Sql();

$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
     ':ID'=>$this->getIdusuario()
	));
$this->setIdusuario(0);
$this->setDeslogin("");
$this->setDessenha("");
$this->setDtcadastro(new DateTime());

}


}


?>