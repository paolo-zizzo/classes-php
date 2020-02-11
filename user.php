<?php
class user
{
private $id;
public $login;
public $email;
private $password;
public $firstname;
public $lastname;

public $connected=false;



public function register ($login,$password,$email,$firstname,$lastname)
{
    $db=mysqli_connect("localhost","root","","classes");
    $requete="SELECT * FROM `user`WHERE login='$login'";
    $query= mysqli_query ($db,$requete);
    $resultat=mysqli_num_rows($query);


    if ($resultat>0){ 
        
         echo  "cet utilisateurs est déjà utilisé";
         
         }
         

else{
   
    $requete="INSERT INTO
     `user` VALUES (NULL ,'$login','$password','$email','$firstname','$lastname')";

    mysqli_query ($db,$requete);
    mysqli_close($db);
    return array ($login,$password,$email,$firstname,$lastname);
}
}





public function connect ($login,$password){

    $db=mysqli_connect("localhost","root","","classes");
    $requete="SELECT * FROM `user` WHERE login='$login'";
    $query= mysqli_query ($db,$requete);
    $resultat=mysqli_fetch_array($query);
    
    if ($resultat==0){
        echo "mot de passe ou login incorrect" ;


    }
else
{
    $this->id=$resultat['ID'];
    $this->login=$resultat['login'];
    $this->email=$resultat['email'];
    $this->firstname=$resultat['firstname'];
    $this->lastname=$resultat['lastname'];
    $_SESSION['login']="$login";
    return(var_dump($resultat));

}
}
public function disconnect(){
    
session_destroy();
return "tes déco";
}


public function delete(){
if(isset($_SESSION['login']))
{


    $db=mysqli_connect('localhost','root',"",'classes');
    $supp= "DELETE FROM user WHERE login='".$this->login."'";
    $query=mysqli_query($db,$supp);
}
}

public function update ($login,$password, $email, $firstname,$lastname)
{
    $db=mysqli_connect('localhost','root',"",'classes');
   $requete ="UPDATE user SET login = '$login',password='$password', email='$email',firstname='$firstname', lastname='$lastname' WHERE ID='$this->id'";
    echo $requete;
   $query=mysqli_query($db,$requete);
}   
    

public function isConnected()
{

	if(isset($_SESSION['login']))
	{
		$this->connected=true;
	}
	else
	{
		$this->connected=false;
	}

	return (var_dump($this->connected));
}


public function getAllInfos()
{
    $array = 
		array
		(
    		"id" =>$this->id ,
    		"login" =>$this->login ,
    		"password" => $this->password,
    		"firstname" => $this->firstname,
    		"lastname" => $this->lastname,
            "email" => $this->email
        );
        return ($array);
    

}
public function getLogin()
{
	 return($this->login);
}

public function getEmail()
{
	 return($this->email);
}

public function getFirstname()
{
	 return($this->firstname);
}

public function getLastname()
{
	 return($this->lastname);
}

public function refresh()
{
	$bdd=mysqli_connect("localhost", "root", "", "classes");
	$login=$_SESSION['login'];
	$queryuser="SELECT *from users WHERE login='$login'";
	$resultuser= mysqli_query($bdd, $queryuser);
	$tabuser=mysqli_fetch_array($resultuser);

	$this->id=$tabuser['id'];
	$this->login=$tabuser['login'];
	$this->email=$tabuser['email'];
	$this->firstname=$tabuser['firstname'];
	$this->lastname=$tabuser['lastname'];
}
}







session_start();

$_SESSION['user'] = new user;
// $_SESSION['user']->connect('admin','test');
$_SESSION['user']->getLogin();
// // var_dump($_SESSION['user']);
// // $_SESSION['user']->  ('admin','test','nanani','lolo','lololo1');
//  echo $user->isConnected();

//     $db=mysqli_connect("localhost","root","","classes");
//     $requete="SELECT *  FROM `user`WHERE login='$login'";
   
//     if ($resultat==0)
    


?>
