<?php
  require_once('cebecalhorodape.php');
  cabecalho(5,0);
?>
    <div id="site_content">
      <div id="content">


        <?php
		include 'action/escola.php';
        if (isset($_GET["id"])) //Confirmado relatorio
        {
          switch ($_GET["id"]) {
            case 1: //Livros mais emprestados
              echo '<a href="relatorio.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Livros mais emprestados</h1>';
              echo '<form action="action/action-relatorio.php?id=1" method="post"> ';

              echo '<p>Data inicial: <input type="date" name="dataInicial" required><br><br>
              Data final:&nbsp;&nbsp; <input type="date" name="dataFinal" required><br><br>
              <input type="hidden" name="Escola" value='.$id_escola_atual.'></p>
              <button type="submit" class="buttonenviar">Enviar</button></form>';
              break;
            case 2: //Alunos que mais emprestaram
              echo '<a href="relatorio.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Alunos que mais emprestaram</h1>';
              echo '<form action="action/action-relatorio.php?id=2" method="post"> ';

              echo '<p>Data inicial: <input type="date" name="dataInicial" required><br><br>
              Data final:&nbsp;&nbsp; <input type="date" name="dataFinal" required><br><br>
             <input type="hidden" name="Escola" value='.$id_escola_atual.'></p>
              <button type="submit" class="buttonenviar">Enviar</button></form>';
              break;
            case 3: //Generos mais emprestados
              echo '<a href="relatorio.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Generos mais emprestados</h1>';
              echo '<form action="action/action-relatorio.php?id=3" method="post"> ';

             echo '<p>Data inicial: <input type="date" name="dataInicial" required><br><br>
              Data final:&nbsp;&nbsp; <input type="date" name="dataFinal" required><br><br>
              <input type="hidden" name="Escola" value='.$id_escola_atual.'></p>
              <button type="submit" class="buttonenviar">Enviar</button></form>';
              break;
              case 4: //Livros para devolucao por data
                echo '<a href="relatorio.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Livros para devolucao</h1>';
              echo '<form action="action/action-relatorio.php?id=4" method="post"> ';

             echo '<p>Data inicial: <input type="date" name="dataInicial" required><br><br>
              Data final:&nbsp;&nbsp; <input type="date" name="dataFinal" required><br><br>
              <input type="hidden" name="Escola" value='.$id_escola_atual.'></p>
              <button type="submit" class="buttonenviar">Enviar</button></form>
              <br><br>
              <form method="post" action="action/action-relatorio.php?id=4&case=todos">
              <button  type="submit" class="buttonenviar" id="pagamento">Emprestimos de Professores</button></form>';
                break;
                case 5: //Total de multas arrecadadas
                  echo '<a href="relatorio.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Total de multas arrecadadas</h1>';
              echo '<form action="action/action-retornamulta.php" method="post"> ';

             echo '<p>Data inicial: <input type="date" name="dataInicial" required><br><br>
              Data final:&nbsp;&nbsp; <input type="date" name="dataFinal" required><br><br>
              <input type="hidden" name="Escola" value='.$id_escola_atual.'></p>
              <button type="submit" class="buttonenviar">Enviar</button></form>';
                  break;


              default:
                header("Location: ./relatorio.php");
              break;
            }
        }
        else
        {
          echo '<form method="post" action="relatorio.php?id=1">
            <button type="submit" class="botao">Livros mais emprestados</button>
          </form>
          <form method="post" action="relatorio.php?id=2">
            <button type="submit" class="botao">Alunos que mais emprestaram</button>
          </form>
          <form method="post" action="relatorio.php?id=3">
            <button type="submit" class="botao">Generos mais emprestados</button>
          </form>
          <form method="post" action="relatorio.php?id=4">
            <button type="submit" class="botao">Livros para devolução</button>
          </form>
          <form method="post" action="action/action-consulta.php">
          <input type="hidden" name="Escola" value="'.$id_escola_atual.'">
          <input type="hidden" name="ordem" value="1">
          <button type="submit" class="botao">Todos os Livros</button>
          </form>
          <form method="post" action="relatorio.php?id=5">
            <button type="submit" class="botao">Total de multas arrecadadas</button>
          </form>
		      <form method="post" action="action/action-relatorio.php?id=7">
            <button type="submit" class="botao">Total de multas a receber</button>
          </form>
		      <form method="post" action="action/action-relatorio.php?id=6">
            <button type="submit" class="botao">Escolas Municipais</button>
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