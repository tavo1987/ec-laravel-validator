<?php

namespace Tavo\EcLaravelValidator;

use Exception;
use Illuminate\Validation\Validator as LaravelValidator;
use Tavo\ValidadorEc as ValidatorEcPackage;

class ValidatorEc extends LaravelValidator
{
    public function validateEcuador($attribute, $value, $parameters)
    {
        $validatorEc = new ValidatorEcPackage();

        if ( $parameters[0] == 'ci' ) {
            $result = $validatorEc->validarCedula($value);
            $this->setCustomMessages([$validatorEc->getError()]);
        } elseif ( $parameters[0] == 'ruc' ) {
            $result = $validatorEc->validarRucPersonaNatural($value);
            $this->setCustomMessages([$validatorEc->getError()]);
        } elseif ( $parameters[0] == 'ruc_spub' ) {
            $result = $validatorEc->validarRucSociedadPublica($value);
            $this->setCustomMessages([$validatorEc->getError()]);
        } elseif($parameters[0] == 'ruc_spriv'){
            $result = $validatorEc->validarRucSociedadPrivada($value);
            $this->setCustomMessages([$validatorEc->getError()]);
        }else{
            throw new Exception('Custom validation rule does not exist');
        }

        return $result;
    }
}