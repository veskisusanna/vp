<?php
	require_once "../config_vp2022.php";
	
	//loome andmebaasiühenduse
	$conn = new mysqli($server_host, $server_user_name, $server_password, $database);
	//määrame suhtlemisel kasutatava kooditabeli
	$conn->set_charset("utf8");
	//valmistame ette SQL keeles päringu
	$stmt = $conn->prepare("SELECT comment, grade, added FROM vp_daycomment_1");
	echo $conn->error;
	//seome loetavad andmed muutujatega
	$stmt->bind_result($comment_from_db, $grade_from_db, $added_from_db);
	$stmt->execute();
	echo $stmt->error;
	//võtan andmeid
	//kui on oodata vaid üks võimalik kirje
	//if$stmt->fetch(){
		//kõik mida teha
	//}
	$comments_html = null;
	//kui on oodata mitut, aga teadmata arv
	while($stmt->fetch()){
		// <p>Kommentaar, hinne päevale: x, lisatud yyyyyy.</p>
		$comments_html .= "<p>" .$comment_from_db .", hinne päevale: " .$grade_from_db . ",lisatud " .$added_from_db .".</p> \n";	
	}
	$stmt->close();
	$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Susanna Veski, veebiprogrammeerimine</title>
</head>
<body>
    <img src="pics/vp_banner_gs.png" alt="bänner">
    <h1>Susanna Veski, veebiprogrammeerimine</h1>
	<p>See leht on loodud õppetöö raames ja ei sisalda tõsiselt võetavat sisu!</p>
	<p>Õppetöö toimus <a href="https://www.tlu.ee">Tallinna Ülikoolis</a>.</p>
	<?php echo $comments_html;?>
</body>
</html>