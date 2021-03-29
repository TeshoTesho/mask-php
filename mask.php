<?php
/*

    API desenvolvida para solucionar problemas rápidos via php.
    Autor: Nicolas Leite Araujo
    Site: nicolasleitearaujo.onlie

    Obs: Me emprega :D

*/


    class API {



//===========================================================================================================================
        //MÁSCARA
//===========================================================================================================================

    //Criando Máscaras
    //Exemplo: mask('11111111111','###.###.###-##') - cpf
        function mask($val, $mask)
        {
        //$val = str_replace([' ','-','&',',','.','_','(',')'],'',$val);
            $val = preg_replace( '/[^0-9]/is', '', $val);
            $maskared = '';
            $k = 0;
            for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
                if ($mask[$i] == '#') {
                    if (isset($val[$k])) {
                        $maskared .= $val[$k++];
                    }
                } else {
                    if (isset($mask[$i])) {
                        $maskared .= $mask[$i];
                    }
                }
            }
            return $maskared;
        }


//===========================================================================================================================
        //Validação
//===========================================================================================================================

    //Validação de CPF
        function validaCPF($cpf) {
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf ); // Limpa string
        if (strlen($cpf) != 11) {return false; } // Verifica os 11 Dígitos
        if (preg_match('/(\d)\1{10}/', $cpf)) {return false;} //Verifica numeros repetidos
        // Calculo para validar
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
    return true; //CPF válido
}

//Função paraa Validação e Máscara de CPF
function cpf($cpf){
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf ); // Limpa string
        $valida = ($this->validaCPF($cpf)==true) ? $this->mask($cpf,'###.###.###-##') : "CPF Inválido";
        return $valida;
    }

//Função de Validação de DATA
    function validaDATA($date, $format = 'd/m/Y')
    {
        $date = @$this->data($date);
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

//Função para Validação e Máscara de Data
    function data($date, $format = 'd/m/Y'){
        setlocale(LC_TIME, 'pt_BR.utf-8');
        date_default_timezone_set('America/Sao_Paulo');
        try{
            $data = new DateTime($date);
        }catch(Exception $e){
            return false;
        }
        $formated = $data->format($format);
        return $formated;
    }

//===========================================================================================================================
        //Funções de Máscara
//===========================================================================================================================

//Função de Máscara para Dinheiro (R$ - Brasileiro)
    function money($money){
        $money = str_replace(",", ".", $money);
        $count = strlen(str_replace(".", "", $money));
        $mask="R$";
        $pos = strripos($money, ".");
        for ($i=0; $i < $count; $i++) { 
            if($pos == $i && $pos == true){$mask = $mask . ".#";}
            else{$mask = $mask . "#";}
        }
        $money = floatval($money);
        $response = $this->mask($money,$mask);
        return $response;
    }

//Função de Máscara para Telefone, contando se tem 8 ou 9 digitos
    function tel($tel)
    {
        $tel = str_replace([' ','-','&',',','.','_','(',')'],'',$tel);
        $response=(strlen($tel) >10) ? $this->mask($tel, '(##) #####-####') : $this->mask($tel, '(##) ####-####');
        return $response;
    }
//===========================================================================================================================
        //Funções de data
//===========================================================================================================================

 //Função para pegar a data de hoje
    function hoje(){
        $hoje = date("d/m/Y");
            //Já declarado no pt BR
        return $hoje;
    }

//Função para pegar a hora de agora
    function agora(){
        $agora = date("h:m");
        return $agora;
    }

//Função que define em array todos os campos de data e hora
    function date(){
        $agora = array(
            "short"=>array(
                "ano"=>date('y'),
                "mes"=>date('m'),
                "dia"=>date('d'),
                "hora"=>date('h'),
                "min"=>date('i'),
                "sec"=>date('s'),
                "ic"=>date('a'),
            ),
            "long"=>array(
                "ano"=>date('Y'),
                "mes"=>strftime('%b', strtotime('today')),
                "dia"=>strftime('%a', strtotime('today')),
                "hora"=>date('H'),
                "min"=>date('i'),
                "sec"=>date('s'),
                "ic"=>date('A'),
            ),
            "ample"=>array(
                "mes"=>strftime('%B', strtotime('today')),
                "dia"=>strftime('%A', strtotime('today')),
            ),
            "week_day"=>date("w"),
            "fuso"=>date("e"),
            "year_day" => date('z'),
            "mask" => array(
                "br" => date('d/m/Y'),
                "eua" => date('Y-m-d')
            )
        );
        return $agora;
    }





//Fim Classe
}

?>