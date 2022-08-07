<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    private $key;
    private $error;

    function __construct($key)
    {
        if(!empty($key)){
            $this->key = $key;
        }
    }

    private function requestGeocoding($endpoint, $city)
    {
        if(empty($endpoint) or empty($city)){
            
            $this->error = true;
            return false; 
        
        }else{

            $uri = "https://api.openweathermap.org/". $endpoint ."?q=".$city.",BR&limit=1&appid=". $this->key ."";
      
            $response = file_get_contents($uri);
            $this->error = false; 
            
            return json_decode($response, true);
        }

    }

    function dateFormat()
    {
        $date = date('D');
        $mes = date('M');
        $dia = date('d');
        $ano = date('Y');
        
        $semana = array(
            'Sun' => 'Domingo', 
            'Mon' => 'Segunda-Feira',
            'Tue' => 'Terca-Feira',
            'Wed' => 'Quarta-Feira',
            'Thu' => 'Quinta-Feira',
            'Fri' => 'Sexta-Feira',
            'Sat' => 'Sábado'
        );
        
        $mes_extenso = array(
            'Jan' => 'Janeiro',
            'Feb' => 'Fevereiro',
            'Mar' => 'Marco',
            'Apr' => 'Abril',
            'May' => 'Maio',
            'Jun' => 'Junho',
            'Jul' => 'Julho',
            'Aug' => 'Agosto',
            'Nov' => 'Novembro',
            'Sep' => 'Setembro',
            'Oct' => 'Outubro',
            'Dec' => 'Dezembro'
        );

        $date = $semana["$date"] . ", {$dia} de " . $mes_extenso["$mes"] . " de {$ano}";
    
        return $date;
    }

    function isError()
    {
        return $this->error;
    }

    function currentWeatherData($endpoint, $city)
    {
        $data = $this->requestGeocoding('geo/1.0/direct', $city);
        
        $uri = "https://api.openweathermap.org/". $endpoint ."?appid=".$this->key ."&";

        if(empty($data)){
            
            $this->error = true;
            return false; 
        
        }else{

            foreach($data[0] as $key => $value){
                
                if($key == 'lat' or $key == 'lon'){
                    
                    $uri .= $key . '=' . urlencode($value) . '&';
                }
            }
        }

        $uri = substr($uri, 0, -1);
        $response = file_get_contents($uri);
        $this->error = false; 
    
        return json_decode($response, true);

    }
}
