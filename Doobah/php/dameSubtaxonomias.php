<?php
	//include("selects_db.php");
	require_once('DAO_General.php');
	$result=0;
$contenido="";

if($_POST["tema"])
{
   /* # se ha recibido el pais
    
    # comprobamos que exista dicho pais en la base de datos
    $sql="SELECT * FROM taxonomia WHERE taxo=?";
    $params=array($_POST["pais"]);
    $db=$dbh->prepare($sql);
    $db->execute($params);
    if($db->rowCount()==1)
    {
        # existe el pais... vamos a bucar las ciudades...
        $sql="SELECT * FROM subtaxonomia WHERE id_s IN(SELECT id_s from relacion_taxonomia WHERE id_t IN(SELECT id_t FROM taxonomia WHERE taxo=?))";
        $params=array($_POST["pais"]);
        $db=$dbh->prepare($sql);
        $db->execute($params);
	
        if($db->rowCount()>0)
        {
            $result=1;
            # creamos el contenido del select con todos los paises
            $contenido.="<option value='0'>Selecciona una ciudad</option>";
            foreach($db->fetchAll() as $row)
            {
                $contenido.="<option value='".$row["id_s"]."'>".$row["subtaxonomia"]."</option>";
            }
        }
    }*/
	$lista = dameSubtaxonomia(utf8_decode($_POST["tema"]));
	if (count($lista)>0){
		$result=1;
		$contenido.="<option value='0'>Detalle...</option>";
		foreach ($lista as $valor) {
			$contenido.="<option value=".$valor['subtaxonomia'].">".$valor['subtaxonomia']."</option>";
		}
	}
}else{
    $contenido.="<option value='0'></option>";
}

echo json_encode(
    array(  "result"=>$result,
            "contenido"=>utf8_encode($contenido)
         )
);
?>