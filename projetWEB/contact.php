<?php 
	$url_en_cours=$_SERVER['REQUEST_URI'];
	$url_en_cours=substr($url_en_cours,strripos($url_en_cours,"/")+1);
	$url_en_cours = str_replace(".php","",str_replace("-"," ",$url_en_cours));
	$url_en_cours = strtoupper(substr($url_en_cours,0,1)).substr($url_en_cours,1);

	$titre=""; $styles="styles/mef.css";
	if(isset($url_en_cours) && $url_en_cours!="" && $url_en_cours!="Index" && $url_en_cours!="Index?OUT=true")
		$titre=$url_en_cours;
	else
	{
		$titre = "Formulaire de contact";
		$styles="styles/mef_id.css";
	}
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title><?php echo $titre; ?></title>
<meta name="description" content="Contr�ler et valider les saisies d'un formulaire d'inscription Web par le code client Javascript" />
<meta name="robots" content="index,follow" />
<meta http-equiv="content-language" content="fr" />
<link href='<?php echo $styles; ?>' rel='stylesheet' type='text/css' />
</head>
<body>

	<div class="div_conteneur_parent">
	
		<div class="div_conteneur_page">
			<a href="http://www.bonbache.fr/" target="_self">
			<img src="images/le_formateur.png" style="width:50px;border:none;" align="left" alt="formateur informatique" />
			</a>		
			<div class="titre_page"><h1><?php echo $titre; ?></h1></div>
			
			<div class="div_int_page">

            <script language="javascript" type="text/javascript">

function validation_avt_envoi()
{
	var lancer="oui";
	
	if(document.getElementById("msg_mail").value=="")
	{
		alert("Vous devez saisir votre mail");
		lancer="non";
	}
	else if(document.getElementById("msg_mail").value.indexOf("@")==-1 || document.getElementById("msg_mail").value.indexOf(".")==-1)
	{
		alert("Votre mail ne semble pas correct, corrigez-le");
		lancer="non";
	}	
	else if(document.getElementById("msg_sujet").value=="")
	{
		alert("Vous devez entrer le sujet de votre message");
		lancer="non";
	}	
	else if((document.getElementById("msg_contenu").value=="" || document.getElementById("msg_contenu").value.length<10))
	{
		alert("Vous devez renseigner le contenu du message");
		lancer="non";
	}
	else if(document.getElementById("msg_code").value=="")
	{
		alert("Veuillez saisir le code anti-spam");
		lancer="non";	
	}
	else if(document.getElementById("msg_code").value.toLowerCase()!=document.getElementById("mem_code").value.toLowerCase())
	{
		alert("Le code anti-spam est incorrect");
		lancer="non";	
	}	
	
	if(lancer=="oui")
		document.getElementById("contact").submit();
}

</script>	


<div style="width:100%;display:block;text-align:center;">
			</div>
			
			<div class="div_saut_ligne" style="height:10px;">
			</div>						
			
			<div style="float:left;width:10%;height:40px;"></div>
			<div style="float:left;width:80%;height:40px;text-align:center;">
			<div id="GTitre">
			<h1>Contacter le support technique</h1>
			</div>
			</div>
					
			<div style="float:left;width:10%;height:40px;"></div>
			
			<div class="div_saut_ligne">
			</div>		
			
			<div style="width:100%;height:auto;text-align:center;">
						
			<div style="width:800px;display:inline-block;" id="conteneur">
			
				<div class="centre">
					<div class="titre_centre" id="titre" style="text-align:left;padding-left:10px;">
					Veuillez renseigner les informations requises.
					</div>	
				</div>
			
				<div class="colonne" id="liste">
					<div id="grille">
						<form id="contact" name="contact" method="post" action="index.php">
							<div class="div_txt_form">
							Votre Mail :
							</div>
							<div class="div_input_form">
							<input type="text" name="msg_mail" id="msg_mail" maxlength="70" />
							</div>
							<div class="div_txt_form">
							Sujet :
							</div>
							<div class="div_input_form">
							<input type="text" name="msg_sujet" id="msg_sujet" maxlength="70" />	
							</div>
							<div class="div_msg">
							<br /><strong>Votre message :<strong><br />
							<textarea id="msg_contenu" name="msg_contenu" cols="20" rows="5" class="zone_msg"></textarea>	
							</div>
							<div class="div_txt_form">
							&nbsp;
							</div>
							<div class="div_input_form">
							<input type="button" style="text-align:center;" name="msg_envoyer" id="msg_envoyer" value="Envoyer le message" onclick="validation_avt_envoi();" />
							</div>	
						</form>
					</div>
					<div class="div_msg">
					<img id="mem_image" /><br />
					<strong>Code anti-spam :<strong><br />		
					<input type="text" name="msg_code" id="msg_code" maxlength="10" class="input_form" />		
					<input type="text" name="mem_code" id="mem_code" maxlength="10" class="input_form" style="visibility:hidden;" />
					</div>
					<br />
					<span style="font-size:14px;font-weight:normal;">Vous devez reproduire le <strong>code de l'image</strong><br />avant d'envoyer le message.</span>
				</div>
				
				<div class="centre">
					<div class="titre_centre" id="apercu">
					<?php 

					?>
					</div>	
				</div>					
				
			</div>
			
			</div>

			<div class="div_saut_ligne" style="height:50px;">
			</div>

<script language="javascript" type="text/javascript">
//1 à 10
var nombre= Math.floor(Math.random() * 6)+1;

switch (nombre)
{
	case 1:
		document.getElementById("mem_image").src = "images/01.jpg";
		document.getElementById("mem_code").value = "TU54FP";                                     
		break;
	case 2:
		document.getElementById("mem_image").src = "images/02.jpg";
		document.getElementById("mem_code").value = "QK717R";                    
		break;
	case 3:
		document.getElementById("mem_image").src = "images/03.jpg";
		document.getElementById("mem_code").value = "QNH8K8";                    
		break;
	case 4:
		document.getElementById("mem_image").src = "images/04.jpg";
		document.getElementById("mem_code").value = "ZX263V";
		break;
	case 5:
		document.getElementById("mem_image").src = "images/05.jpg";
		document.getElementById("mem_code").value = "M7L2VH";                    
		break;
	case 6:
		document.getElementById("mem_image").src = "images/06.jpg";
		document.getElementById("mem_code").value = "AJ2L6B";                    
		break;
	default:
		document.getElementById("mem_image").src = "images/01.jpg";
		document.getElementById("mem_code").value = "TU54FP";                    
		break;
}
</script>

			<!---->
			</div>
			<div class="pied_page">

			</div>				
		</div>
	
	</div>
	
</body>
<script type="text/javascript" language="javascript">
	//alert(document.getElementById("civilite").value);
</script>
</html>
<?php 
	include("commun/fermer.php");
?>