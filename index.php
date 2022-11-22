<?php
  require_once('cebecalhorodape.php');
  cabecalho(0,0);
?>
    <div id="site_content">
      <div id="content">
        <form action="action/action-emprestimo.php" method="post">
          
          <p>Código Livro:&nbsp;
          <input type="text" name="codLivro" required autocomplete="off" autofocus><br>
          Código Aluno:
          <input type="text" name="codAluno" required autocomplete="off"><br>
          Prazo:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <?php 
		  include 'action/escola.php';
		  include 'action/database.php';
		  $sql_query = "SELECT prazo_padrao FROM Escola WHERE id_escola = '$id_escola_atual';";
		  $result_query = $conn->query($sql_query);
		  $row_escola = $result_query->fetch_assoc();
	      $valor_prazo = $row_escola["prazo_padrao"];
          echo '<input type="number" name="prazo" value="'.$valor_prazo.'" required autocomplete="off" step="1" min="1"><br>';
		  ?>
          </p>
          <button type="submit" class="buttonenviar">Enviar</button>

        </form>  
      </div>
    </div>
<?php
  rodape();
?>

