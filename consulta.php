<?php
  require_once('cebecalhorodape.php');
  cabecalho(3,0);
?>
    <div id="site_content">
      <div id="content">

        <?php
		include 'action/escola.php';
        if(isset($_GET["id"]))
        {
          switch ($_GET["id"])
          {
            case 1: //consulta completa
            echo '<a href="consulta.php"><img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<form action="action/action-consulta.php" method="post">

                <p>Código Livro:&nbsp;
                <input type="text" name="codLivro" required autocomplete="off"><br>
                </p>
                <button type="submit" class="buttonenviar">Enviar</button>

              </form>';
              break;
            case 2: //consulta rapida
              echo '<a href="consulta.php"><img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<form action="action/action-consulta.php" method="post">

                <p>Título:&nbsp;
                <input type="text" name="titulo" autocomplete="off"><br>
                Autor:&nbsp;
                <input type="text" name="autor" autocomplete="off"><br>
                Área do Conhecimento:
              <select name="areaLivro" id="selectEscolas">
                <option disabled selected value> -- Escolha uma Área -- </option>
                <option value="Generalidade">Generalidade</option>
                <option value="Literatura Infantil">Literatura Infantil</option>
                <option value="Almanaques e Enciclopédias">Almanaques e Enciclopédias</option>
                <option value="Filosofia">Filosofia</option>
                <option value="Educacao">Educação</option>
                <option value="Folclore">Folclore</option>
                <option value="Línguas">Línguas</option>
                <option value="Matemática">Matemática</option>
                <option value="Artes">Artes</option>
                <option value="Historias em Quadrinhos">Historias em Quadrinhos</option>
                <option value="Literatura Americana">Literatura Americana</option>
                <option value="Literatura Brasileira">Literatura Brasileira</option>
                <option value="História">História</option>
                <option value="Geografia">Geografia</option>

              </select><br>
                Escola:&nbsp;
              <select name="Escola" id="selectEscolas" required>
              <option value="03">André Zenere</option>
				      <option value="00"> --TODAS-- </option>
                <option value="01">Alberto Santos Dumont</option>
                <option value="02">Amélio Dal Bosco</option>
                
                <option value="04">Anita Garibaldi</option>
                <option value="05">Antonio Scain</option>
                <option value="06">Ari Arcássio Gossler</option>
                <option value="07">Arsênio Heiss</option>
                <option value="08">Borges de Medeiros</option>
                <option value="09">Carlos Friedrich</option>
                <option value="10">Carlos João Treis</option>
                <option value="11">Duque de Caxias</option>
                <option value="12">Egon Werner Bercht</option>
                <option value="13">Henrique Brod</option>
                <option value="14">Ivo Welter</option>
	            	<option value="15">Jardim Concórdia</option>
                <option value="16">José Pedro Brum</option>
                <option value="17">Miguel Dewes</option>
                <option value="18">Norma Demeneck Belotto</option>
                <option value="19">Nossa Senhora das Graças</option>
                <option value="20">Olivo Beal</option>
                <option value="21">Orlando Luiz Bazei</option>
                <option value="22">Osvaldo Cruz</option>
                <option value="23">Princesa Isabel</option>
                <option value="24">Reinaldo Arrosi</option>
                <option value="25">Santo Antonio</option>
                <option value="26">São Dimas</option>
                <option value="27">São Francisco</option>
                <option value="28">São Luiz</option>
                <option value="29">São Pedro</option>
                <option value="30">Shirley Lorandi</option>
                <option value="31">Tancredo Neves</option>
                <option value="32">Tomé de Souza</option>
                <option value="33">Waldyr Becker</option>
                <option value="34">Walter Fontana</option>
                <option value="35">Washington Luiz</option>
                <option value="36">Walmir Grande</option>
              </select><br>
              Ordenar por:
              <select name="ordem">
                <option value="1">Título</option>
                <option value="2">Autor</option>
                <option value="3">Area do Conhecimento</option>
                <option value="4">Código</option>
              </select><br>
                </p>
                <button type="submit" class="buttonenviar">Enviar</button>

              </form>';
              break;
              case 3: //consulta aluno
                 echo '<a href="consulta.php"><img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<form action="action/action-consulta.php?id=1" method="post">

                <p>Nome Aluno:&nbsp;
                <input type="text" name="nomeAluno" autocomplete="off"><br>
                </p>

                <p><input type="hidden" name="Escola" value='.$id_escola_atual.'>
              <button type="submit" class="buttonenviar">Enviar</button>
              </p>
              </form>';
                break;
                case 4: //Consulta Professor
                  echo '<a href="consulta.php"><img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
              </a>';
              echo '<form action="action/action-consulta.php?id=2" method="post">

                <p>Nome Professor:&nbsp;
                <input type="text" name="nomeProfessor" autocomplete="off"><br>
                </p>

                <p><input type="hidden" name="Escola" value='.$id_escola_atual.'>

              <button type="submit" class="buttonenviar">Enviar</button>
              </p>
              </form>';
                  break;
                  
                case 5:  //Consulta Emprestimo
                echo '<a href="consulta.php"><img src="style/imagem-voltar.png" alt="Voltar" style="width:80px;height:42px;border:0;">
                </a>';
                echo '<form action="action/action-consulta-emprestimo.php" method="post">
  
                  <p>Numero Emprestimo:&nbsp;
                  <input type="text" name="numeroEmprestimo" autocomplete="off"><br>
                  </p>
  
                  <p><input type="hidden" name="Escola" value='.$id_escola_atual.'>
  
                <button type="submit" class="buttonenviar">Enviar</button>
                </p>
                </form>';
                  break;
            default:
               echo '<form method="post" action="consulta.php?id=1">
              <button  type="submit" class="botao">Consulta Completa</button></form>

              <form method="post" action="consulta.php?id=2">
              <button  type="submit" class="botao">Consulta Rápida</button></form>

              <form method="post" action="consulta.php?id=3">
              <button  type="submit" class="botao">Consulta Aluno</button></form>

              <form method="post" action="consulta.php?id=4">
              <button  type="submit" class="botao">Consulta Professor</button></form>
              
              <form method="post" action="consulta.php?id=5">
              <button  type="submit" class="botao">Consulta Emprestimo</button></form>';
              break;
          }
        }

        else {
          echo '<form method="post" action="consulta.php?id=1">
              <button  type="submit" class="botao">Consulta Completa</button></form>

              <form method="post" action="consulta.php?id=2">
              <button  type="submit" class="botao">Consulta Rápida</button></form>

              <form method="post" action="consulta.php?id=3">
              <button  type="submit" class="botao">Consulta Aluno</button></form>

              <form method="post" action="consulta.php?id=4">
              <button  type="submit" class="botao">Consulta Professor</button></form>
              
              <form method="post" action="consulta.php?id=5">
              <button  type="submit" class="botao">Consulta Emprestimo</button></form>';
        }

        ?>
      </div>
    </div>
<?php
  rodape();
?>


