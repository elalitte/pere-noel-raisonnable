<?php

// Fonction de connexion à la base de données
// Renvoie un connecteur à la base
function db_connect()
{
    try
    {
      $bdd = new PDO('mysql:host=localhost;dbname=perenoel;charset=UTF8', 'perenoeluser', 'mdpPereNoelUser');
    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
    return($bdd);
}

// Fonction qui teste si le login et pass sont ok pour se logger
// Renvoie un tableau contenant les données de session (mail, id, nom complet)
function log_ok($login,$pass,$bdd)
{
    $cryptedPass = sha1($pass);
    $req = $bdd->prepare('SELECT * FROM users WHERE email = ? AND password = ? ');
    $req->execute(array($login,$cryptedPass));
    $infos_conn = $req->fetch();
    if ( $infos_conn['email'] == NULL )
    {
      echo "Les identifiants de connexion que vous avez entrés sont incorrects.<br /><br />";
	  echo '<a href="javascript:history.go(-1)"><button type="button" class="btn btn-primary">Retourner à la page de connexion</button></a>';
    }
    else
    {
      $session['email']=$infos_conn['email'];
      $session['id']=$infos_conn['idusers'];
    } 
    $req->closeCursor();
    return($session);
}

// Fonction qui teste si un mail existe déjà
// Renvoie un tableau contenant les infos correspondant au mail
function existenceAdresseMail($email,$bdd)
{
    $req = $bdd->prepare('SELECT * FROM users WHERE email = ? ');
    $req->execute(array($email));
    $infos_conn = $req->fetch();
    $req->closeCursor();
    return($infos_conn);
}

// Fonction qui teste si la question et la réponse secrète sont ok
// Renvoie un tableau contenant les infos correspondant à la personne
function questionReponseOk($adresse,$question,$reponse,$bdd)
{
    $reponseperso = addslashes($reponse);
    $req3 = $bdd->prepare('SELECT * FROM users WHERE email = ? AND questionperso = ? AND reponseperso = ? ');
    $req3->execute(array($adresse,$question,$reponseperso));
    $infos_conn2 = $req3->fetch();
    $req3->closeCursor();
    return($infos_conn2);
}

// Fonction qui met à jour le mot de passe dans la base aléatoirement et envoie un mail avec
// Renvoie rien
function miseAJourMotDePasse($contact,$email,$bdd)
{
    exec('sudo /root/scripts/recup_mdp.sh '.escapeshellcmd($contact).' '.escapeshellcmd($email), $output);
    $mdpGenereChiffre = sha1($output['0']);
    $req2 = $bdd->prepare('UPDATE users SET password = :password WHERE email = :adresseMail');
    $req2->execute(array(
      'password' => $mdpGenereChiffre,
      'adresseMail' => $email
      ));
    $req2->closeCursor();
}

// Fonction qui met à jour le mot de passe dans la base en fonction de l'utilisateur
// Renvoie rien
function miseAJourMotDePasseUser($email,$pass1,$bdd)
{
    $mdpGenereChiffre = sha1($pass1);
    $req2 = $bdd->prepare('UPDATE users SET password = :password WHERE email = :adresseMail');
    $req2->execute(array(
      'password' => $mdpGenereChiffre,
      'adresseMail' => $email
      ));
    $req2->closeCursor();
}

// Fonction qui met à jour le mot de passe au niveau imap sous unix
// Renvoie rien
function miseAJourMotDePasseUserImap($email,$passwd)
{
    system('sudo /root/scripts/change_pass_courier.sh '.escapeshellcmd($email).' '.escapeshellcmd($passwd));
}


// Fonction qui affiche tous les mails autorisés pour une personne donnée
// Renvoie rien
function affich_evenements($email,$bdd)
{
    $req2 = $bdd->prepare('SELECT nomevenement FROM users, evenements WHERE evenements.id_user = users.idusers AND users.email = ? ');
    $req2->execute(array($email));
    if ( $req2 == NULL )
    {
    echo "";
    }
    else
    {
      while ($donnees = $req2->fetch())
      {
	    echo "<table class='table table-bordered'>"; 
        echo "<tr>";
/*
        echo "<td>";
        echo '<form action="efface.php" method="post"><input type="hidden" name="erased2" value=' . htmlspecialchars($donnees['nomevenement']) . ' /><input border=0 src="vue/images/delete.gif" type=image value=submit /></form>';
        echo "</td>";
*/
        echo "<td>";
        echo '&nbsp;' . $donnees['nomevenement'];
        echo "</td>";
        echo "</tr>";
        echo "</table>"; 
      }
    $req2->closeCursor();
    }
}

// Fonction qui teste si un mail existe déjà
// Renvoie un tableau contenant les infos correspondant au mail
function genereVariablesSession($bdd,$session_entree,$post,$lang)
{
    if ( $session_entree['nom'] == NULL )
    {
      if ( $post['login'] != NULL AND $post['pass'] != NULL )
      {
        if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $post['login']))
        {
          $ret1 = log_ok($post['login'],$post['pass'],$bdd,$lang);
          $session['nom'] = $ret1['nom'];
          $session['id'] = $ret1['id'];
          $session['fullname'] = $ret1['fullname'];
          return($session);
        }
        else
        {
          header('Location: mauvais_login.php');
        }
      }
      else
      {
        header('Location: saisie_vide.php');
      }
    }
}

// Fonction qui teste et ajoute une adresse en whitelist
// Renvoie rien
function addAddrWhitelist($bdd,$post,$session)
{
if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $post['ajout_addr']))
      {
        // On commence à tester si l'adresse entrée n'existe pas déjà
        $req2 = $bdd->prepare('SELECT id FROM mailaddr WHERE email = ? ');
        $req2->execute(array($post['ajout_addr']));
        $donnees = $req2->fetch();
        if ( $donnees['id'] == NULL )
        // Si elle n'existe pas, on l'ajoute !
        {
          // On l'ajoute dans la base mails
          $req = $bdd->prepare('INSERT INTO mailaddr( priority, email ) VALUES( 7, :email)');
          $req->execute(array(
            'email' => $post['ajout_addr']
            ));
          $req->closeCursor();
          // On ajoute dans la base des whitelists
          $req5 = $bdd->prepare('SELECT id FROM mailaddr WHERE email = ? ');
          $req5->execute(array($post['ajout_addr']));
          $donnees2 = $req5->fetch();
          $req5->closeCursor();
          $req3 = $bdd->prepare('INSERT INTO wblist( rid, sid, wb ) VALUES( :rid, :sid, "W" )');
          $req3->execute(array(
            'rid' => $session['id'],
            'sid' => $donnees2['id']
            ));
          $req3->closeCursor();
        }
        else
        // Sinon, on n'ajoute une info que dans wblist 
        {
          $req4 = $bdd->prepare('INSERT INTO wblist( rid, sid, wb ) VALUES( :rid, :sid, "W" )');
          $req4->execute(array(
            'rid' => $session['id'],
            'sid' => $donnees['id']
            ));
          $req4->closeCursor();
        }
      $req2->closeCursor();
      }
else
	  {
        echo "$badaddress";
      }
}

// Fonction qui affiche toutes les adresses mail de MailForKids
// Renvoie rien
function affich_all_mails($bdd,$lang)
{
    include ('lang'.$lang.'.inc');
    $req2 = $bdd->prepare('SELECT email FROM users');
    $req2->execute(array());
    $req3 = $bdd->prepare('SELECT email FROM users');
    $req3->execute(array());
    if ( $req2 == NULL )
    {
    echo "$queryerror";
    }
    else
    {
      echo '<h2>'.$addresslist2.'</h2></p>';
      $increment = 0;
      $increment2 = 0;
      while ($donnees2 = $req3->fetch())
      {
        ++$increment2;
      }
    echo "<p>Il y a actuellement ". $increment2 ." inscrits sur mailfokids.net</p>";    
      while ($donnees = $req2->fetch())
      {
        echo "<table>";
        echo "<tr>";
        echo "<td>";
        echo '<form action="effacer_un_compte.php" method="post"><input type="hidden" name="erased3" value=' . htmlspecialchars($donnees['email']) . ' /><input border=0 src="vue/images/delete.gif" type=image value=submit /></form>';
        echo "</td>";
        echo "<td>";
        echo '&nbsp;' . htmlspecialchars($donnees['email']);
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        ++$increment;
      }
    $req2->closeCursor();
    $req3->closeCursor();
    }
}

// Fonction qui efface une adresse blacklistée dans la base
// Renvoie rien
function effaceAdresseBL($nom,$id,$erased2,$bdd,$lang)
{
include ('lang'.$lang.'.inc');
if (isset($nom)) 
    {
      $req = $bdd->prepare('SELECT id FROM mailaddr WHERE email = ? ');
      $req->execute(array($erased2));
      $donnees = $req->fetch();
      if ( $donnees['id'] != NULL )
      {
        $req2 = $bdd->prepare('DELETE FROM wblist WHERE sid = ? AND rid = ? ');
        $req2->execute(array($donnees['id'],$id));
        $req2->closeCursor();
      }
      else
      {
        echo "$wrongaddress";
      }
      echo ''.$address.'<strong>' . htmlspecialchars($_POST['erased2']) . '</strong>'.$waserased.'';
      echo '<br /><br /><a href="affichage_mfk.php">'.$backward.'</a>';
    }
}

// Fonction qui efface un compte MFK
// Renvoie rien
function effaceCompteMFK($erased3,$bdd,$lang)
{
      include ('lang'.$lang.'.inc');
      // récupération de l'id
      $infosUser=existanceAdresseMail($erased3,$bdd);
      // Effacement dans la table wblist
      $req = $bdd->prepare('DELETE FROM wblist WHERE rid = ? ');
      $req->execute(array($infosUser['id']));
      $req->closeCursor();
      // Effacement dans la table users
      $req2 = $bdd->prepare('DELETE FROM users WHERE email = ? ');
      $req2->execute(array($erased3));
      $req2->closeCursor();
      // Effacement des fichiers de configuration unix
      system('sudo /root/scripts/efface_adresse_mail.sh '.escapeshellcmd($infosUser['email']));
      echo ''.$address.'<strong>' . htmlspecialchars($erased3) . '</strong>'.$waserased.'';
      echo '<br /><br /><a href="efface_compte.php">'.$backward2.'</a>';
}

// Fonction qui autorise à un compte l'adresse root@mailforkids.net
// Renvoie rien
function AjoutMailParDefaut($adressemail,$bdd)
{
        $req5 = $bdd->prepare('SELECT id FROM users WHERE email = ? ');
        $req5->execute(array($adressemail));
        $donnees2 = $req5->fetch();
        //echo $donnees2['id'];
        $req5->closeCursor();
        $req3 = $bdd->prepare('INSERT INTO wblist( rid, sid, wb ) VALUES( :rid, 50, "W" )');
        $req3->execute(array(
          'rid' => $donnees2['id']
          ));
        $req3->closeCursor();
        $req4 = $bdd->prepare('INSERT INTO wblist( rid, sid, wb ) VALUES( :rid, 94, "W" )');
        $req4->execute(array(
          'rid' => $donnees2['id']
          ));
        $req4->closeCursor();
}

// Fonction qui ajoute une adresse mail au niveau unix
// Renvoie rien
function creationMailUnix($adressemail,$password)
{
		system('sudo /root/scripts/ajout_amavis.sh '.escapeshellcmd($adressemail));
		system('sudo /root/scripts/ajout_postfix.sh '.escapeshellcmd($adressemail));
        system('sudo /root/scripts/ajout_courier.sh '.escapeshellcmd($adressemail).' '.escapeshellcmd($password));
}

// Fonction qui ajoute une adresse mail au site
// Renvoie rien
function ajoutUser($prenom,$nom,$email,$password,$bdd)
{
        $req = $bdd->prepare('INSERT INTO users( nom, prenom, email, password ) VALUES( :nom, :prenom, :email, :password)');
        $req->execute(array(
          'nom' => $nom,
          'prenom' => $prenom,
          'email' => $email,
          'password' => $password
          ));
        $req->closeCursor();
}
