<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Validator;

use App\Validator\IsValidDNI;
use Doctrine\Common\Annotations\Annotation;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

/**
 * Description of DNIControlDigitValidator.
 *
 * @author ibilbao
 */

/**
 * @Annotation
 */
class IsValidDNIValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /** @var IsValidDNI $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        $return = $this->__valida_nif_cif_nie($value);

        if ($return <= 0) {
            $this->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }

    private function __valida_nif_cif_nie($cif)
    {
        //Copyright ©2005-2011 David Vidal Serra. Bajo licencia GNU GPL.
        //Este software viene SIN NINGUN TIPO DE GARANTIA; para saber mas detalles
        //puede consultar la licencia en http://www.gnu.org/licenses/gpl.txt(1)
        //Esto es software libre, y puede ser usado y redistribuirdo de acuerdo
        //con la condicion de que el autor jamas sera responsable de su uso.
        //Returns: 1 = NIF ok, 2 = CIF ok, 3 = NIE ok, -1 = NIF bad, -2 = CIF bad, -3 = NIE bad, 0 = ??? bad
        $cif = strtoupper((string) $cif);
        for ($i = 0; $i < 9; ++$i) {
            $num[$i] = substr($cif, $i, 1);
        }
        //si no tiene un formato valido devuelve error
        if (!preg_match('/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/', $cif)) {
            return 0;
        }
        //comprobacion de NIFs estandar
        if (preg_match('/(^[0-9]{8}[A-Z]{1}$)/', $cif)) {
            if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 0, 8) % 23, 1)) {
                return 1;
            } else {
                return -1;
            }
        }
        // algoritmo para comprobacion de codigos tipo CIF
        // Suma los números pares quitando la letra. Para el CIF A58818501
        // Suma = 8 + 1 + 5 = 14
        $suma = $num[2] + $num[4] + $num[6];
        for ($i = 1; $i < 8; $i += 2) {
            $double = 2 * intval($num[$i]);
            // Se suman los 2 cifras del resultado de multiplicar por 2 cada una de las posiciones impares. Para el CIF A58818501
            // Ejemplo: 
            // 5 * 2 = 10 ==> 1 + 0 = 1
            // 8 * 2 = 16 ==> 1 + 6 = 7
            // 8 * 2 = 16 ==> 1 + 6 = 7
            // 0 * 2 = 0 ==> 0
            // Y se suma con el resultado de la suma de los pares
            $suma += intval(substr((string)$double, 0, 1)) + intval(substr((string)$double, 1, 1));
        }
        // Suma = 14 + 1 + 7 + 7 + 0 = 29

        // Cálculo del dígito de control: 10 - las unidades del total de la suma en este caso 9 con lo cual el dígito de control sería 1
        $n = 10 - \substr($suma, \strlen($suma) - 1, 1);

        //comprobacion de NIFs especiales (se calculan como CIFs o como NIFs)
        if (preg_match('/^[KLM]{1}/', $cif)) {
            if ($num[8] == chr(64 + $n) || $num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 1, 8) % 23, 1)) {
                return 1;
            } else {
                return -1;
            }
        }
        //comprobacion de CIFs
        // Para las sociedad X y P habria que sumar un 64 al digito de control que hemos calculado para hallar el ASCII d
        if (preg_match('/^[ABCDEFGHJNPQRSUVW]{1}/', $cif)) {
            if ($num[8] == chr(64 + $n) || $num[8] == substr((string) $n, strlen((string) $n) - 1, 1)) {
                return 2;
            } else {
                return -2;
            }
        }
        //comprobacion de NIEs
        if (preg_match('/^[XYZ]{1}/', $cif)) {
            if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr(str_replace(['X', 'Y', 'Z'], ['0', '1', '2'], $cif), 0, 8) % 23, 1)) {
                return 3;
            } else {
                return -3;
            }
        }
        //si todavia no se ha verificado devuelve error
        return 0;
    }
}
