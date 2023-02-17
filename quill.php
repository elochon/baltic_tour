<!DOCTYPE html>
<html lang="fr-fr">
  <head>
    <title>Mailer</title>
    <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
    <style>
.transfer {
	display:none;
 }
    </style>
  </head>
  <body>
    <form method="post" action="mail.php">
      <input type="text" name="title" placeholder="Titre du mail"/>
      <input type="text" class="transfer" id="transfer"/>

		<!-- Create the toolbar container -->
		<div id="toolbar">
			<button class="ql-bold">Bold</button>
  			<button class="ql-italic">Italic</button>
		</div>

		<!-- Create the editor container -->
		<div id="editor">
  			<p></p>
		</div>
      <input type="submit" value="Envoyer" />
      <h4>Personnes qui vont recevoir ce mail : </h4>
	
<?php
$host_name = 'db5009581507.hosting-data.io';
  $database = 'dbs8124341';
  $user_name = 'dbu651531';
  $password = 'Elias2023!';

  $link = new mysqli($host_name, $user_name, $password, $database);

  if ($link->connect_error) {
    die('<script>alert("La connexion au serveur MySQL a échoué: '. $link->connect_error .'");</script>');
    // } else {
    //echo '<p>Connexion au serveur MySQL établie avec succès.</p>';}
  }
      
      
      
  $sql = "SELECT * FROM mailing_list"; // ORDER BY comment_id
  $result = $link->query($sql);
  $mailing_list="webmaster@baltic-tour.fr";
  
  while ($ligne=$result->fetch_assoc()) {
  	$mailing_list=$mailing_list."<br/>".$ligne["mail"];
  };
  echo $mailing_list;
  $link->close();
      
      
      
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$title = $_POST['title'];
	$message = $_POST['content'];
}

if (isset($title)){
  $mailvar = mail($mailing_list,$title,$message,"From: webmaster@baltic-tour.fr\r\n"."Content-Type: text/html; charset=\"UTF-8\""."Reply-To: contacts@baltic-tour.fr\r\n");
  if($mailvar==1){
	  echo "<br/><p>Message envoyé</p>";
  }
  else{
	  echo "<br/><p>L'envoi a échoué</p>";
  };
};

?>
<!-- Main Quill library -->
		<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
		<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

<!-- Core build with no theme, formatting, non-essential modules -->
<link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
<script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>

<!-- Initialize Quill editor -->
<script>
  var editor = new Quill('#editor', {
    modules: { toolbar: '#toolbar' },
    placeholder: 'Le mail...',
    theme: 'snow',
  });
</script>

</body>
</html>      
