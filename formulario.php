<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="estilo.css">
  <title>Document</title>
</head>

<script type="text/javascript">
  window.history.pushState("", "", "formulario.php");
</script>

<body>
  <form method="get" onsubmit="(e)=>e.previneDefault()" action="#">
    <input type="text" name="cliente_box" placeholder="Cliente digite aqui!" /><br>
    <button type="submit" name="cliente_button" class="button">Cliente</button>
    <input type="submit" name="excluir" class="button" value="Excluir" /><br>
  </form>

  <form method="get" onsubmit="(e)=>e.previneDefault()" action="#">
    <input type="text" name="atendente_box" placeholder="Atendente digite aqui!" /><br>
    <button type="submit" name="Atendente_button" class="button">Atendente</button>
    <input type="submit" name="excluir2" class="button" value="Excluir" />
  </form>


  <?php
  $cliente = [];
  $arquivo_json = 'clientes.json';
  $atendente = [];
  $arquivo_json_atendente = 'atendente.json';

  function salvar_json(
    $nome_do_arquivo_json,
    $array_para_salvar,
    $input_get,
  ) {
    // salvar o json
    $jsonLocal = file_get_contents($nome_do_arquivo_json);
    $jsonLocal = json_decode($jsonLocal, true);
    foreach ($jsonLocal as $key => $value) {
      array_push($array_para_salvar, $value);
    }
    $array_para_salvar[] = $input_get;
    $json = json_encode($array_para_salvar);
    file_put_contents($nome_do_arquivo_json, $json);

    //salvar em um json fazendo spread
    $json = file_get_contents($nome_do_arquivo_json);
    $json = json_decode($json, true);

    // ler o json
    foreach ($json as $key => $value) {
      echo $value . '<br>';

    }
  }

  function remover_ultimo_item_do_json($nome_do_arquivo_json)
  {
    $json = file_get_contents($nome_do_arquivo_json);
    $json = json_decode($json, true);
    $apagar_json = array();
    foreach ($json as $key => $value) {
    array_push($apagar_json, $value);
    }
    array_shift($apagar_json);

    $json = json_encode($apagar_json);
    file_put_contents($nome_do_arquivo_json, $json);

    //salvar em um json fazendo spread
    $json = file_get_contents($nome_do_arquivo_json);
    $json = json_decode($json, true);

    // ler o json
    foreach ($json as $key => $value) {
      echo $value . '<br>';
      
    }
  }


  // chamar a função no onClick
  if (isset($_GET['cliente_button'])) {
    salvar_json($arquivo_json, $cliente, $_GET['cliente_box']);
  }

  // excluir no onClick
  if (isset($_GET['excluir'])) {
    remover_ultimo_item_do_json($arquivo_json);
  }

  if (isset($_GET['Atendente_button'])) {
    salvar_json($arquivo_json_atendente, $atendente, $_GET['atendente_box']);
  }

  // excluir no onClick
  if (isset($_GET['excluir2'])) {
    remover_ultimo_item_do_json($arquivo_json_atendente);
  }


  ?>
</body>

</html>