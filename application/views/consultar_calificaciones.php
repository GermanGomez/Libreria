<?php 
$conn =mysql_connect("localhost","root","root");
mysql_select_db("moodle22");
mysql_query("SET NAMES 'utf8'");

if (!$conn){
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}
if (!mysql_select_db("moodle22")) {
    echo "Unable to select mydbname: " . mysql_error();
    exit;
}

$usuario=$_POST["usuario"];
$materias=$_POST["materias"];
print_r($materias);
var_dump($materias);
$in = implode("','", $materias);
echo implode("','", $materias);
$q=mysql_query("SELECT 
	materia.fullname as materia,
	unidad.fullname as unidad,
	oam.fullname as oam,
	quiz.itemname as quiz,
	FORMAT (calificacion.finalgrade/10,2) as calificacion
FROM mdl_course as materia
JOIN mdl_grade_categories as unidad ON materia.id = unidad.courseid
JOIN mdl_grade_categories as oam ON oam.parent = unidad.id
JOIN mdl_grade_items as quiz ON oam.id=quiz.categoryid
JOIN mdl_grade_grades as calificacion ON calificacion.itemid=quiz.id
JOIN mdl_user as usuario ON usuario.id=calificacion.userid
WHERE materia.fullname IN ('".$in."')
AND usuario.username='".$usuario."';");

if(!$q){
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

if(mysql_num_rows($q) == 0) {
    print_r($materias);
    echo "\n".$usuario."->'".implode("','", $materias)."'";exit;//"No rows found, nothing to print so am exiting";
    
}
while($e=mysql_fetch_assoc($q))
{
	$output[]=$e;
}


print(utf8_encode(json_encode($output)));

mysql_close();


?>