<?php  

function cabecalho($index_menu, $int_nivel_arquivo)
{
  $nivel_arquivo = '';
  for($i = 0; $i < $int_nivel_arquivo; $i++){
    $nivel_arquivo .= '../';
  }
    echo '<!DOCTYPE html>
    <html>
    
    <head>
      <title>OneBib</title>
      <meta name="description" content="Gerenciador das biliotecas das escolas municipais de Toledo Paraná" />
      <meta name="keywords" content="biblioteca, biblioteca toledo" />
      <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
      <link rel="stylesheet" type="text/css" href="'.$nivel_arquivo.'style/style.css" title="style" />
      <meta charset="utf-8"/>
    </head>
    
    <body>
      <div id="main">
        <div id="header">
          <div id="logo">
            <div id="logo_text">
              <h1>OneBib</h1>
              
            </div>
          </div>
          <div id="menubar">
            <ul id="menu">';
            
            echo '<li'; if($index_menu == 0) {echo ' class="selected"';} echo '><a href="'.$nivel_arquivo.'index.php">Empréstimo</a></li>
            <li'; if($index_menu == 1) {echo ' class="selected"';} echo '><a href="'.$nivel_arquivo.'devolucao.php">Devolução</a></li>
            <li'; if($index_menu == 2) {echo ' class="selected"';} echo '><a href="'.$nivel_arquivo.'cadastro.php">Cadastro</a></li>
            <li'; if($index_menu == 3) {echo ' class="selected"';} echo '><a href="'.$nivel_arquivo.'consulta.php">Consulta</a></li>
            <li'; if($index_menu == 4) {echo ' class="selected"';} echo '><a href="'.$nivel_arquivo.'impressao.php">Impressões</a></li>
            <li'; if($index_menu == 5) {echo ' class="selected"';} echo '><a href="'.$nivel_arquivo.'relatorio.php">Relatórios</a></li>
            <li'; if($index_menu == 6) {echo ' class="selected"';} echo '><a href="'.$nivel_arquivo.'adm.php">Admin</a></li>';
                

              
    echo '
            </ul>
          </div>
        </div>';
};


function rodape() 
{
   echo '<div id="content_footer"></div>
    <div id="footer">
    CRIADO POR RAFAEL ALBARELLO | CONTATO: rafael_albarello@hotmail.com
    </div>
  </div>
</body>
</html>';
}

?>