<?php
  require_once('cebecalhorodape.php');
  cabecalho(1,0);
?>
    <div id="site_content">
      <div id="content">
        <form action="action/action-devolucao.php" method="post">
          
          <p>Código Livro:&nbsp;
          <input type="text" name="codLivro" required autofocus autocomplete="off"><br>
          </p>
          <button type="submit" class="buttonenviar">Enviar</button>

        </form>  
        <br><br>
    <form method="post" action="action/action-pagamentomulta.php">
      <button  type="submit" class="buttonenviar" id="pagamento">Pagamento de Multa</button></form>
    </div>
      </div>
    </div>
    <?php
  rodape();
?>
