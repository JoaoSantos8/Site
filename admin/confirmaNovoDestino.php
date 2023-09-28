<?php
include_once ("../php/backOffice.php");
global $con;


$nome=addslashes($_POST['nome']);
$descricao=addslashes($_POST['descricao']);


if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
    $upload_dir = 'images/destinos/'; // Altere isso para a pasta de destino
    $file_name = $_FILES['image']['name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_ext = array('jpg', 'jpeg', 'png', 'gif'); // Adicione ou remova extensões de arquivo que você deseja permitir
    if(in_array($file_ext, $allowed_ext)){
        // Gere um nome de arquivo exclusivo para evitar a substituição de arquivos existentes
        $new_file_name = date('YmdHis') . '_' . uniqid('', true) . '.' . $file_ext;
        $file_tmp = $_FILES['image']['tmp_name'];
        if(move_uploaded_file($file_tmp, $upload_dir.$new_file_name)){
            // Imagem enviada com sucesso, armazene o link em uma variável
            $image_link = $upload_dir . $new_file_name;
        }else{
            echo "Erro ao enviar arquivo.";
        }
    }else{
        echo "Tipo de arquivo inválido.";
    }
}else{
    echo "Erro ao fazer upload do arquivo.";
}
$urlImagem = isset($image_link) ? $image_link : '';


$sql="Insert into destinos values(0,'$nome','$urlImagem','$descricao')";

//echo var_dump($_FILES['image']['name']);
mysqli_query($con,$sql);
header("location:listaDestinos.php");   