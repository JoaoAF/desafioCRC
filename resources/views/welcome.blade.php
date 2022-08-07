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
      <!-- Aqui vai o resultado da API -->

      <?php

         $date = $OwmAPI->dateFormat();
                         
         $data = $OwmAPI->currentWeatherData('data/2.5/weather', @$_GET['city']);
         
         //Formula de Kelvin para Celsius: K − 273,15 = °C
         
         if($data){
         
            $icon = "<img src='http://openweathermap.org/img/wn/".$data['weather'][0]['icon'].".png'>";
         
            $city = $data['name'];
         
            $code = $data['sys']['country'];
            
            $temp = $data['main']['temp'] - 273.15;
            $desc = $data['weather'][0]['description'];
            $min_tmp = $data['main']['temp_min'] - 273.15;
            $max_tmp = $data['main']['temp_max'] - 273.15;
         
            echo $icon .' '. $city .', '. $code .' - '. $date .' - '. $temp .'°c '. ucfirst($desc) . ' - '. $min_tmp .'°c / '. $max_tmp .'°c ';
         }

      ?>
      <div class="container">
         <div class="row">
            <br>
            <div class="col s12">
               <div class="row">
                  <form method="post" action="/create">
                     @csrf
                     <div class="col s12">
                        <div class="row">
                           <div class="input-field col s4">
                              <input required id="data" type="date" class="validate" name="data">
                              <label for="data">Data</label>
                           </div>
                           <div class="input-field col s4">
                              <input required id="Nome" type="text" class="validate" name="nome">
                              <label for="Nome">Nome</label>
                           </div>
                           <div class="input-field col s4">
                              <input required id="telefone" type="text" class="validate" name="telefone">
                              <label for="telefone">Telefone</label>
                           </div>
                        </div>
                        <div class="row">
                           <div class="input-field col s4">
                              <input required id="email" type="email" class="validate col s12" name="email">
                              <label for="email">Email</label>
                           </div>
                           <div class="input-field col s4">
                              <input required id="cpf_cnpj" type="text" class="validate col s12" name="cpf_cnpj">
                              <label for="cpf_cnpj">CPF/CNPJ</label>
                           </div>
                           <div class="input-field col s4">
                              <textarea required id="textarea1" class="materialize-textarea" height="45" name="texto"></textarea>
                              <label for="textarea1">Mensagem</label>
                           </div>
                        </div>
                     </div>
                     <button type="submit" class="btn-large waves-effect waves-light btn">Cadastrar</button>
                  </form>
               </div>
               <h1>Últimos cadastros</h1>
               <table>
                  <tr>
                     <td><b>Data</b></td>
                     <td><b>Nome</b></td>
                     <td><b>Email</b></td>
                     <td><b>Telefone</b></td>
                     <td><b>CPF</b></td>
                     <td><b>Mensagem</b></td>
                     <td><b>Alterar</b></td>
                     <td><b>Excluir</b></td>
                  </tr>
                  @foreach($record as $r)
                  <tr>
                     <td>{{ $r->data }}</td>
                     <td>{{ $r->nome }}</td>
                     <td>{{ $r->email }}</td>
                     <td>{{ $r->telefone }}</td>
                     <td>{{ $r->cpf . $r->cnpj }}</td>
                     <td>{{ $r->texto }}</td>
                     <td><a href="form_update/{{$r->id}}"><i class="material-icons">edit</i></a></td>
                     <td><a href="delete/{{$r->id}}"><i class="material-icons">delete</i></a></td>
                  </tr>
                  @endforeach
               </table>
               {{$record->links()}}
            </div>
         </div>
      </div>
      <!-- Compiled and minified JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   </body>
</html>