<?php
  require_once('cebecalhorodape.php');
  cabecalho(4,0);
?>
    <div id="site_content">
      <div id="content">
        

        <?php 
        if (isset($_GET["id"])) //Confirmado impressao
        {
          switch ($_GET["id"]) {
            case 1: //Impressao Etiqueta
              echo '<a href="impressao.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Impressao Etiqueta</h1>';
              echo '<form action="action/action-imprimeetiqueta.php" method="post" target="_blank"> ';
          
              echo '<p>Código Inicial*:&nbsp;
              <input type="text" name="codigo_inicial"  autocomplete="off"><br>
	      Código Final*:&nbsp;
              <input type="text" name="codigo_final"  autocomplete="off"><br>
              <p>Título*:&nbsp;
              <input type="text" name="tituloLivro"  autocomplete="off" style="text-transform: uppercase;"><br>
	      <button type="submit" class="buttonenviar">Enviar</button>';
              break;
            case 2: //Impressao Carteirinha
              echo '<a href="impressao.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Impressao Carteirinha</h1>';
              echo '<form action="action/action-imprimecarteirinha.php" method="get" target="_blank"> ';
          
              echo '<p>Código Aluno 1:&nbsp;
              <input type="text" name="codigo1" required autocomplete="off"><br>
              Código 2:&nbsp;
              <input type="text" name="codigo2" autocomplete="off"><br>
              Código 3:&nbsp;
              <input type="text" name="codigo3" autocomplete="off"><br>
              Código 4:&nbsp;
              <input type="text" name="codigo4" autocomplete="off"><br>
              Código 5:&nbsp;
              <input type="text" name="codigo5" autocomplete="off"><br>
              Código 6:&nbsp;
              <input type="text" name="codigo6" autocomplete="off"><br>
              Código 7:&nbsp;
              <input type="text" name="codigo7" autocomplete="off"><br>
              Código 8:&nbsp;
              <input type="text" name="codigo8" autocomplete="off"><br>
              
              

              
              </p>

              <button type="submit" class="buttonenviar">Enviar</button></form>';
              echo '<form method="post" action="action/action-imprimecarteirinha.php?id=1" target="_blank">
            <button  type="submit" class="buttonenviar" id="pagamento">Imprimir ultimos 8 cadastros</button></form>';
              break;
            
            case 3: // carteirinha professor
            	echo '<a href="impressao.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Impressao Carteirinha</h1>';
              echo '<form action="action/action-imprimecarteirinhaprofessor.php" method="get" target="_blank"> ';
          
              echo '<p>Código Professor 1:&nbsp;
              <input type="text" name="codigo1" required autocomplete="off"><br>
              Código 2:&nbsp;
              <input type="text" name="codigo2" autocomplete="off"><br>
              Código 3:&nbsp;
              <input type="text" name="codigo3" autocomplete="off"><br>
              Código 4:&nbsp;
              <input type="text" name="codigo4" autocomplete="off"><br>
              Código 5:&nbsp;
              <input type="text" name="codigo5" autocomplete="off"><br>
              Código 6:&nbsp;
              <input type="text" name="codigo6" autocomplete="off"><br>
              Código 7:&nbsp;
              <input type="text" name="codigo7" autocomplete="off"><br>
              Código 8:&nbsp;
              <input type="text" name="codigo8" autocomplete="off"><br>
              
              

              
              </p>

              <button type="submit" class="buttonenviar">Enviar</button></form>';
              echo '<form method="post" action="action/action-imprimecarteirinhaprofessor.php?id=1" target="_blank">
            <button  type="submit" class="buttonenviar" id="pagamento">Imprimir ultimos 8 cadastros</button></form>';
            	break;
			case 4:
			echo '<a href="impressao.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Impressao Emprestimo</h1>';
              echo '<form action="action/action-imprimeemprestimo.php" method="get" target="_blank"> ';
          
              echo '<p>Código Empréstimo:&nbsp;
              <input type="text" name="codigo" required autocomplete="off"><br>
   
              </p>
			 

              <button type="submit" class="buttonenviar">Enviar</button></form>';
			  
			   echo '<form method="post" action="action/action-imprimeemprestimo.php?id=1" target="_blank">
            <button  type="submit" class="buttonenviar" id="pagamento">Imprimir ultimo emprestimo</button></form>';
			break;
            default:
              header("Location: ./impressao.php");
              break;
          }
        }
        else
        {
          echo '<form method="post" action="impressao.php?id=1">
            <button type="submit" class="botao">Etiqueta</button>
          </form> <form method="post" action="impressao.php?id=2">
            <button type="submit" class="botao">Carteirinha Aluno</button>
          </form> <form method="post" action="impressao.php?id=3">
            <button type="submit" class="botao">Carteirinha Professor</button>
          </form> <form method="post" action="impressao.php?id=4">
            <button type="submit" class="botao">Empréstimo</button>
          </form>
          ';
        }

        ?>








        </form>  
      </div>
    </div>
    <?php
  rodape();
?>


