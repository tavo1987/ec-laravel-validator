<?php

namespace Tavo\EcLaravelValidator;

use Illuminate\Validation\Validator;
use Tavo\ValidadorEc;

class ValidatorEc extends Validator
{
    private $isValid = false;

    public function validateEcuador($attribute, $value, $parameters)
    {
        $validatorEc = new ValidadorEc();

        if ( $parameters[0] == 'ci' ) {
            $this->isValid = $validatorEc->validarCedula($value);
        } elseif ( $parameters[0] == 'ruc' ) {
            $this->isValid = $validatorEc->validarRucPersonaNatural($value);
        } elseif ( $parameters[0] == 'ruc_spub' ) {
            $this->isValid = $validatorEc->validarRucSociedadPublica($value);
        } elseif($parameters[0] == 'ruc_spriv'){
            $this->isValid = $validatorEc->validarRucSociedadPrivada($value);
        }

        if ( !$this->isValid ) {
            $error = strtolower($validatorEc->getError());
            $this->setCustomMessages(["{$attribute} : {$error}"]);

            return $this->isValid;
        }

        return $this->isValid ;
    }
}
