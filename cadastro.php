<?php
  require_once('cebecalhorodape.php');
  cabecalho(2,0);
?>
    <div id="site_content">
      <div id="content">
        

        <?php 
		include 'action/escola.php';
        if (isset($_GET["id"])) //Confirmado cadastro
        {
          switch ($_GET["id"]) {
            case 1: //Cadastro Aluno
              echo '<a href="cadastro.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Cadastro Aluno</h1>';
              echo '<form action="action/action-cadastroaluno.php" method="post"> ';
          
              echo '<p>Nome:&nbsp;
              <input type="text" name="nomeAluno" required autocomplete="off"><br>
              <input type="hidden" name="Escola" value='.$id_escola_atual.'>
              Data de Nascimento:
              <input type="date" name="bday"><br>
              </p>

              <button type="submit" class="buttonenviar">Enviar</button>';
              break;
            case 2: //Cadastro Professor
              echo '<a href="cadastro.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Cadastro Professor</h1>';
              echo '<form action="action/action-cadastroprofessor.php" method="post"> ';
          
              echo '<p>Nome:&nbsp;
              <input type="text" name="nomeProfessor" required autocomplete="off"><br>
              <input type="hidden" name="Escola" value='.$id_escola_atual.'><br>
              </p>

              <button type="submit" class="buttonenviar">Enviar</button>';
              break;
            case 3: //Cadastro Livro
              echo '<a href="cadastro.php">
              <img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<h1>Cadastro Livro</h1>';
              echo '<form action="action/action-cadastrolivro.php" method="post"> ';
          
              echo '<p>Título*:&nbsp;
              <input type="text" name="tituloLivro" required autocomplete="off"><br>
              Subtítulo:&nbsp;
              <input type="text" name="subtituloLivro" autocomplete="off"><br>
              Autor*:&nbsp;
              <input type="text" name="autorLivro" required autocomplete="off"><br>

              <input type="hidden" name="Escola" value='.$id_escola_atual.'>
              Tipo da Obra:
              <select name="tipoobraLivro">
                <option value="Livro">Livro</option>
                <option value="Revista">Revista</option>
                <option value="Gibi">Gibi</option>
                <option value="CD">CD</option>
                <option value="Dicionário">Dicionário</option>
                <option value="Enciclopédia">Enciclopédia</option>
              </select><br>
              Área do Conhecimento*:
              <select name="areaLivro" id="selectEscolas"; required>
                <option disabled selected value> -- Escolha uma Área -- </option>
                <option value="Generalidade">Generalidade</option>
                <option value="Literatura Infantil">Literatura Infantil</option>
                <option value="Almanaques e Enciclopedias">Almanaques e Enciclopédias</option>
                <option value="Filosofia">Filosofia</option>
                <option value="Educacao">Educação</option>
                <option value="Folclore">Folclore</option>
                <option value="Linguas">Línguas</option>
                <option value="Matematica">Matemática</option>
                <option value="Artes">Artes</option>
                <option value="Historias em Quadrinhos">Historias em Quadrinhos</option>
                <option value="Literatura Americana">Literatura Americana</option>
                <option value="Literatura Brasileira">Literatura Brasileira</option>
                <option value="Historia">História</option>
                <option value="Geografia">Geografia</option>

              </select><br>

              Origem:
              <select name="origemLivro">
                <option value="Compra">Compra</option>
                <option value="Doação">Doação</option>
                <option value="Convênio">Convênio</option>
              </select><br>

              Edição:
              <input type="text" name="edicaoLivro" autocomplete="off"><br>

              ISBN:
              <input type="text" name="isbnLivro" autocomplete="off"><br>

              Série:
              <input type="text" name="serieLivro" autocomplete="off"><br>

              </p>

              <button type="submit" class="buttonenviar">Enviar</button>';
              break;
            default:
              header("Location: ./cadastro.php");
              break;
          }
        }
        else
        {
          echo '<form method="post" action="cadastro.php?id=1">
            <button type="submit" class="botao">Cadastro Aluno</button>
          </form> <form method="post" action="cadastro.php?id=2">
            <button type="submit" class="botao">Cadastro Professor</button>
          </form> <form method="post" action="cadastro.php?id=3">
            <button type="submit" class="botao">Cadastro Livro</button>
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
