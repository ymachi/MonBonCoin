<?php

use App\Db;
use Models\Users;
require_once('autoloader.php');
// test de l'autoloader
// $test = new Db;
// $test::getDb();

 
?>


<h1>Index : fichier de test</h1>
<p>C'est ici que nous allons tester tous nos CRUD</p>
<!-- Pour utliser les méthodes des CRUD il faut faire un require de class dont nous aurons besoin -->
<!-- Comme nous ne voulons pas faire de require toutes les deux minutes nous alons utliser l'autoloader -->


<h2>Utilisation de la méthode findAll sur users </h2>

<?php
$users = Users::findAll();
var_dump($users);
?>

<h2>Utilisation de la méthode findById</h2>

<?php
$user = Users::findById(2);
var_dump($user);
?>
<h2>Utilisation de la méthode findByLogin</h2>

<?php
// $login = Users::findByLogin($login);
// var_dump($login);
?>

<h2>Utilisation de la méthode create() sur users</h2>
<?php
$pass = password_hash('12345678', PASSWORD_DEFAULT);

$data = ['amydiawara75@gmail.com', $pass, 'aminata','diawara', '17 rue eugene fourniere', '75018','paris'];
 // users::create($data);
?>

<h2>Utilisation de la méthode delete</h2>

<?php
//$id = users::delete($data);