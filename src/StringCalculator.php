<?php

namespace Deg540\StringCalculatorPHP;

class StringCalculator
{

    private function getDelimitador(&$cadena) {
        if (strpos($cadena, "//") === 0) {
            list($delimitador, $cadena) = explode("\n", substr($cadena, 2), 2);
            return preg_quote($delimitador, '/');
        }
        return ",|\n";
    }

    private function obtenerNumeros($cadena, $delimitador) {
        return preg_split("/" . $delimitador . "/", $cadena);
    }

    private function convertirYSumar($numeros) {
        return array_sum(array_map('intval', $numeros));
    }

    private function add($cadena) {
        $delimitador = $this->getDelimitador($cadena);
        $numeros = $this->obtenerNumeros($cadena, $delimitador);
        return $this->convertirYSumar($numeros);
    }

    private function negative($numbers): bool{
        $delimitador = $this->getDelimitador($numbers);
        $numeros = $this->obtenerNumeros($numbers, $delimitador);
        foreach ($numeros as $numero) {
            if ($numero < 0) {
                return true;
            }
        }
        return false;
    }

    private function negativeNumbers($numbers): string
    {
        $delimitador = $this->getDelimitador($numbers);
        $numeros = $this->obtenerNumeros($numbers, $delimitador);
        $error = "Negativos no soportados:";
        foreach ($numeros as $numero) {
            if ($numero < 0) {
                $error .= " " . $numero;
            }
        }
        return $error;
    }


    public function intAdd(string $numbers): int|string{
        if (empty($numbers)) return 0;
        elseif ($this->negative($numbers)) return $this->negativeNumbers($numbers);
        elseif (strlen($numbers) < 2 ) return $numbers;
        else return $this->add($numbers);
    }
}