<?php
namespace Application\Service;

class FizzBuzz
{
    const CO_FIZZ = 'Fizz';
    const CO_BUZZ = 'Buzz';
    const CO_FIZZ_BUZZ = 'FizzBuzz';
    
    public function verificarFizzBuzz($intNumero)
    {
        if ($intNumero % 3 == 0 && $intNumero % 5 == 0) {
            return self::CO_FIZZ_BUZZ;
        }
        
        if ($intNumero % 3 == 0) {
            return self::CO_FIZZ;
        }
        
        if ($intNumero % 5 == 0) {
            return self::CO_BUZZ;
        }
        
        return $intNumero;
    }
}
