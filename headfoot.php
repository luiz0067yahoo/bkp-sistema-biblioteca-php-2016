<?php  

function cabecalho($index_menu, $int_nivel_arquivo)
{
    echo '<!DOCTYPE html>
    <html>
    
    <head>
      <title>OneBib</title>
      <meta name="description" content="Gerenciador das biliotecas das escolas municipais de Toledo Paraná" />
      <meta name="keywords" content="biblioteca, biblioteca toledo" />
      <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
      <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
    </head>
    
    <body>
      <div id="main">
        <div id="header">
          <div id="logo">
            <div id="logo_text">
              <h1>';
              echo $int_nivel_arquivo.'</h1>
              
            </div>
          </div>
          <div id="menubar">
            <ul id="menu">';
            switch ($int_nivel_arquivo){
                case 0:
                    echo '<li '; if($index_menu == 0) {echo 'class="selected"';} echo '><a href="index.php">Empréstimo</a></li>
                    <li '; if($index_menu == 1) {echo 'class="selected"';} echo '><a href="devolucao.php">Devolução</a></li>
                    <li '; if($index_menu == 2) {echo 'class="selected"';} echo '><a href="cadastro.php">Cadastro</a></li>
                    <li '; if($index_menu == 3) {echo 'class="selected"';} echo '><a href="consulta.php">Consulta</a></li>
                    <li '; if($index_menu == 4) {echo 'class="selected"';} echo '><a href="impressao.php">Impressões</a></li>
                    <li '; if($index_menu == 5) {echo 'class="selected"';} echo '><a href="relatorio.php">Relatórios</a></li>
                    <li '; if($index_menu == 6) {echo 'class="selected"';} echo '><a href="adm.php">Admin</a></li>';
                break;
                case 1:
                    echo '<li '; if($index_menu == 0) {echo 'class="selected"';} echo '><a href="../index.php">Empréstimo</a></li>
                    <li '; if($index_menu == 1) {echo 'class="selected"';} echo '><a href="../devolucao.php">Devolução</a></li>
                    <li '; if($index_menu == 2) {echo 'class="selected"';} echo '><a href="../cadastro.php">Cadastro</a></li>
                    <li '; if($index_menu == 3) {echo 'class="selected"';} echo '><a href="../consulta.php">Consulta</a></li>
                    <li '; if($index_menu == 4) {echo 'class="selected"';} echo '><a href="../impressao.php">Impressões</a></li>
                    <li '; if($index_menu == 5) {echo 'class="selected"';} echo '><a href="../relatorio.php">Relatórios</a></li>
                    <li '; if($index_menu == 6) {echo 'class="selected"';} echo '><a href="../adm.php">Admin</a></li>';
                break;
            }

              
    echo '
            </ul>
          </div>
        </div>';
};


function rodape() 
{
   echo '<div id="content_footer"></div>
    <div id="footer">
      Criado por Rafael Albarello | Contato: rafael_albarello@hotmail.com
    </div>
  </div>
</body>
</html>';
}

?>