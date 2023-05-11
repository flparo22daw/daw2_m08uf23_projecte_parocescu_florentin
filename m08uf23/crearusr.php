<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);
#Dades de la nova entrada
#
if(isset($_POST['uid']) && isset($_POST['uo']) && isset($_POST['uid_num']) && isset($_POST['gid_num']) && isset($_POST['directori']) && isset($_POST['shell']) && isset($_POST['cn']) && isset($_POST['sn']) && isset($_POST['given']) && isset($_POST['mobil']) && isset($_POST['postal']) && isset($_POST['telefon']) && isset($_POST['titol']) && isset($_POST['descripcio'])) {
    $uid=$_POST['uid'];
    $unorg=$_POST['uo'];
    $num_id=$_POST['uid_num'];
    $grup=$_POST['gid_num'];
    $dir_pers=$_POST['directori'];
    $sh=$_POST['shell'];
    $cn=$_POST['cn'];
    $sn=$_POST['sn'];
    $nom=$_POST['given'];
    $mobil=$_POST['mobil'];
    $adressa=$_POST['postal'];
    $telefon=$_POST['telefon'];
    $titol=$_POST['titol'];
    $descripcio=$_POST['descripcio'];
    $objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');
    #
    #Afegint la nova entrada
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-flopar.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $nova_entrada = [];
    Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
    Attribute::setAttribute($nova_entrada, 'uid', $uid);
    Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
    Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
    Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
    Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
    Attribute::setAttribute($nova_entrada, 'cn', $cn);
    Attribute::setAttribute($nova_entrada, 'sn', $sn);
    Attribute::setAttribute($nova_entrada, 'givenName', $nom);
    Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
    Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
    Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
    Attribute::setAttribute($nova_entrada, 'title', $titol);
    Attribute::setAttribute($nova_entrada, 'description', $descripcio);
    $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
    if($ldap->add($dn, $nova_entrada)) echo "Usuari creat";
}
?>
<html>
<head>
<title>
CREAR USUARIS
</title>
</head>
<body>
<h2>Creació d'usuaris</h2>
<form action="./crearusr.php" method="POST">
usuario: <input type="text" name="uid"><br>
unidad organizada: <input type="text" name="uo"><br>
id de unidad: <input type="number" name="uid_num"><br>
gid: <input type="number" name="gid_num"><br>
directorio personal: <input type="text" name="directori"><br>
Shell: <input type="text" name="shell"><br>
nombre completo: <input type="text" name="cn"><br>
apellido: <input type="text" name="sn"><br>
apodo: <input type="text" name="given"><br>
codigo postal: <input type="text" name="postal"><br>
mobil: <input type="text" name="mobil"><br>
numero telefonico: <input type="text" name="telefon"><br>
Title: <input type="text" name="titol"><br>
Description: <input type="text" name="descripcio"><br>
<input type="submit"/>
<input type="reset"/>
</form>
<a href="menu.php">Tornar al menú </a>
</body>
</html>