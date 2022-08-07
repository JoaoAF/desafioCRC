<html>
   <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   </head>
   <title>Teste - CRC</title>
   <body>
      <nav>
         <div class="nav-wrapper">
            <form method="get">
               <div class="input-field">
                  <input id="search" placeholder="Digite o nome da cidade e precione Enter" type="search" required name="city">
                  <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                  <i class="material-icons">close</i>
               </div>
            </form>
         </div>
      </nav>
      <div class="container">
      <div class="row">
      <br>
      <div class="col s12">
      <div class="row">
         <form action="/update/{{ $record->id }}" method="post">
    @method("PUT")
    @csrf
    <?php $documento = empty($record->cpf) ? $record->cnpj : $record->cpf ?>
            <div class="col s12">
               <div class="row">
                  <div class="input-field col s4">
                     <input required id="data" type="date" class="validate" name="data" value="{{ $record->data }}">
                     <label for="data">Data</label>
                  </div>
                  <div class="input-field col s4">
                     <input required id="Nome" type="text" class="validate" name="nome" value="{{ $record->nome }}">
                     <label for="Nome">Nome</label>
                  </div>
                  <div class="input-field col s4">
                     <input required id="telefone" type="text" class="validate" name="telefone" value="{{ $record->telefone }}">
                     <label for="telefone">Telefone</label>
                  </div>
               </div>
               <div class="row">
                  <div class="input-field col s4">
                     <input required id="email" type="email" class="validate col s12" name="email" value="{{ $record->email }}">
                     <label for="email">Email</label>
                  </div>
                  <div class="input-field col s4">
                     <input required id="cpf_cnpj" type="text" class="validate col s12" name="cpf_cnpj" value="{{ $documento }}">
                     <label for="cpf_cnpj">CPF/CNPJ</label>
                  </div>
                  <div class="input-field col s4">
                  <textarea required id="textarea1" class="materialize-textarea" height="45" name="texto">{{ $record->texto }}</textarea>
                  <label for="textarea1">Mensagem</label>
               </div>
               </div>
            </div>
            <button type="submit" class="btn-large waves-effect waves-light btn">Atualizar</button>
            <a href="/" class="btn-large waves-effect waves-light btn">Voltar</a>
         </form>
      </div>

</div>
         </div>
      </div>
      <!-- Compiled and minified JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   </body>
</html>

