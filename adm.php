<?php
  require_once('cebecalhorodape.php');
  cabecalho(6,0);
?>
    <div id="site_content">
      <div id="content">
          
          <?php 
        if (isset($_GET["id"])) //Confirmado opcao
        {
			include 'action/database.php';
			include 'action/escola.php';
          switch ($_GET["id"]) {
            case 1: //Configuração de Multa
			
			  $sql_query = "SELECT valor_multa_dia, permitir_emprestimo_aluno_com_multa FROM Escola WHERE id_escola = '$id_escola_atual';";
			  $result_query = $conn->query($sql_query);
				$row_escola = $result_query->fetch_assoc();
				$valor_multa_atual = $row_escola["valor_multa_dia"];
				$permitir = $row_escola["permitir_emprestimo_aluno_com_multa"];
				
              echo '<a href="adm.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Configuração de Multa</h1>';
              echo '<form action="action/action-adm.php?id=1" method="post"> ';
			
              echo '<p>Valor diário da multa:&nbsp;
             <input type="number" name="valorMulta" required step="any" min="0" value='. $valor_multa_atual.' autocomplete="off"><br>
             
             
              <input type="hidden" name="Escola" value='.$id_escola_atual.'>';
			  
			  if ($permitir){ 
				echo '<input type="hidden" name="permitir_emprestimo_multa" value="0">
			   Permitir emprestimo de aluno com multa: <input type="checkbox" name="permitir_emprestimo_multa" value="1" checked>
                 </p>
              <button type="submit" class="buttonenviar">Enviar</button></form>';}
			  else {
				echo '<input type="hidden" name="permitir_emprestimo_multa" value="0">
			   Permitir emprestimo de aluno com multa: <input type="checkbox" name="permitir_emprestimo_multa" value="1">
                 </p>
              <button type="submit" class="buttonenviar">Enviar</button></form>';
			  }
              break;
            case 2: //Configuração de Emprestimo
			  $sql_query = "SELECT limite_emprestimos_aluno, prazo_padrao, imprimir_emprestimo FROM Escola WHERE id_escola = '$id_escola_atual';";
			  $result_query = $conn->query($sql_query);
			  $row_escola = $result_query->fetch_assoc();
			  $limite = $row_escola["limite_emprestimos_aluno"];
			  $prazo_padrao = $row_escola["prazo_padrao"];
              echo '<a href="adm.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Configuração de emprestimos</h1>';
              echo '<form action="action/action-adm.php?id=2" method="post"> ';
          
              echo '<p>Limite de emprestimos simultâneos:&nbsp;
             <input type="number" name="valorLimite" required step="1" min="0" value='.$limite.' autocomplete="off"><br>
			 
			 Prazo padrão:&nbsp; <input type="number" name="prazo" required step="1" min="1" value='.$prazo_padrao.' autocomplete="off"><br>
             
              <input type="hidden" name="Escola" id="selectEscolas" value='.$id_escola_atual.'>
			  Imprimir comprovante de emprestimo: ';
			  if ($row_escola["imprimir_emprestimo"]){
				  echo '<input type="hidden" name="imprimir_comprovante" value="0">
			   <input type="checkbox" name="imprimir_comprovante" value="1" checked><br>
			  </p>';}
			  else { 
			  echo '<input type="hidden" name="imprimir_comprovante" value="0">
			   <input type="checkbox" name="imprimir_comprovante" value="1"><br>';
			  }
              echo '<button type="submit" class="buttonenviar">Enviar</button></form>';
              break;
            case 3: //Exclusoes
              echo '<a href="adm.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Exclusões</h1>';
              echo '<form method="post" action="adm.php?id=6">
              <button type="submit" class="botao">Livro</button>
              </form>
              <form method="post" action="adm.php?id=7">
              <button type="submit" class="botao">Aluno</button>
              </form>
              <form method="post" action="adm.php?id=8">
              <button type="submit" class="botao">Professor</button>
              </form>
              <form method="post" action="adm.php?id=9">
              <button type="submit" class="botao">Empréstimo</button>
              </form>';
              break;
              case 4: //Exportar Banco de dados
                echo '<a href="adm.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Exportar banco de dados da escola</h1>';
              echo '<form action="action/action-exportDB.php" method="post"> ';
          
             echo '<button type="submit" class="buttonenviar">Exportar</button></form>';
                break;
                case 5: //Importar banco de dados
                  echo '<a href="adm.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Importar banco de dados</h1>';
              echo '<form action="action/action-importDB.php" method="post"> ';
          
             echo '<p>Atenção, esta opção só deve ser utilizada com autorização
              <input type="hidden" name="Escola" value="'.$id_escola_atual.'"></p>
              <button type="submit" class="buttonenviar">Importar</button></form>';
                  break;
                  case 6: // Exclusao livro
                  echo '<a href="adm.php?id=3">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Exclusão Livro</h1>';
                    echo '<form action="action/action-adm.php?id=6" method="post" onsubmit="return confirm(';
                      echo "'Você tem certeza em deletar o livro?');";
                      echo '">
          
                    <p>Código Livro:&nbsp;
                    <input type="text" name="codLivro" required autocomplete="off"><br>
                    </p>
                    <button type="submit" class="buttonenviar">Enviar</button>

                  </form>';
                    break;
                  case 7: //Exclusao Aluno
                  echo '<a href="adm.php?id=3">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Exclusão Aluno</h1>';
                    echo '<form action="action/action-adm.php?id=7" method="post"  onsubmit="return confirm(';

                      echo "'Você tem certeza em deletar o aluno?');";
                      echo '">
          
                    <p>Código Aluno:&nbsp;
                    <input type="text" name="codAluno" required autocomplete="off"><br>
                    </p>
                    <button type="submit" class="buttonenviar">Enviar</button>

                  </form>';

                    break;
                  case 8: //Exclusao Professor
                  echo '<a href="adm.php?id=3">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Exclusão Professor</h1>';
                    echo '<form action="action/action-adm.php?id=8" method="post"  onsubmit="return confirm(';

                      echo "'Você tem certeza em deletar o professor?');";
                      echo '">
          
                    <p>Código Professor:&nbsp;
                    <input type="text" name="codProfessor" required autocomplete="off"><br>
                    </p>
                    <button type="submit" class="buttonenviar">Enviar</button>

                  </form>';

                  break;
              
              case 9: //Exclusao Emprestimo
              echo '<a href="adm.php?id=3">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Exclusão Empréstimo</h1>';
                    echo '<form action="action/action-adm.php?id=9" method="post"  onsubmit="return confirm(';

                      echo "'Você tem certeza em deletar o emprestimo?');";
                      echo '">
          
                    <p>Código Emprestimo:&nbsp;
                    <input type="text" name="codEmprestimo" required autocomplete="off"><br>
                    </p>
                    <button type="submit" class="buttonenviar">Enviar</button>

                  </form>';

                    break;
              
              default:
                header("Location: ./adm.php");
              break;
            }
        }
        else
        {
          echo '<form method="post" action="adm.php?id=1">
            <button type="submit" class="botao">Configuração de multa</button>
          </form> 
          <form method="post" action="adm.php?id=2">
            <button type="submit" class="botao">Configuração de emprestimos</button>
          </form>
          <form method="post" action="adm.php?id=3">
            <button type="submit" class="botao">Exclusoes</button>
          </form>
          <form method="post" action="adm.php?id=4">
            <button type="submit" class="botao">Exportar banco de dados</button>
          </form>
          <form method="post" action="adm.php?id=5">
            <button type="submit" class="botao">Importar banco de dados</button>
          </form>
          ';
        }

        ?>
      </div>
    </div>
<?php
  rodape();
?>
