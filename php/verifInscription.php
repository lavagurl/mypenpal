<?php
session_start();
include('connexionBDD.php');
{
	if(isset($_POST['envoyer']))
	{
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$email = htmlspecialchars($_POST['email']);
		$pwd = password_hash($_POST['mdp'],PASSWORD_DEFAULT);
		$date = htmlspecialchars($_POST['dateNaissance']);
		$gender = $_POST['civility'];
		$country = htmlspecialchars($_POST['country']);
		$avatar = "../images/avatar_default.png";


		$reqpseudo = $bdd->prepare("SELECT * FROM member WHERE name = ?");
		$reqpseudo->execute(array("$pseudo"));
		$pseudoexist = $reqpseudo->rowCount();
		if($pseudoexist == 0)
		{
			$reqemail = $bdd->prepare("SELECT * FROM member WHERE email = ?");
			$reqemail->execute(array("$email"));
			$emailexist = $reqemail->rowCount();
			if($emailexist == 0 )
			{
				$insertmbr = $bdd->prepare("INSERT INTO member(name,password,email,position,gender,birth_date,creation_date,avatar) VALUES(:pseudo,:mdp,:email,:country,:civility,:dateNaissance,NOW(),:avatar)");
				$insertmbr ->execute(array
				(	"pseudo"=> htmlspecialchars($_POST['pseudo']),
				"mdp"=>$pwd,
				"email"=> htmlspecialchars($_POST['email']),
				"country"=>$_POST['country'],
				"civility"=> $gender,
				"dateNaissance" =>htmlspecialchars($_POST['dateNaissance']),
				"avatar"=>$avatar,
			));
			header('Location: choixCentreInteret.php');
		}
		else
		{
					header('Location: inscription.php');

		}}
		else
		{
					header('Location: inscription.php');

		}

	}

}
?>
