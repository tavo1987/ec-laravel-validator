<?php

namespace Tavo\EcLaravelValidator;

use Exception;
use Illuminate\Validation\Validator as LaravelValidator;
use Tavo\ValidadorEc as ValidatorEcPackage;

class ValidatorEc extends LaravelValidator
{
    private $isValid = false;

    public function validateEcuador($attribute, $value, $parameters)
    {
        $validatorEc = new ValidatorEcPackage();

        if ( $parameters[0] == 'ci' ) {
            $this->isValid = $validatorEc->validarCedula($value);
        } elseif ( $parameters[0] == 'ruc' ) {
            $this->isValid = $validatorEc->validarRucPersonaNatural($value);
        } elseif ( $parameters[0] == 'ruc_spub' ) {
            $this->isValid = $validatorEc->validarRucSociedadPublica($value);
        } elseif($parameters[0] == 'ruc_spriv'){
            $this->isValid = $validatorEc->validarRucSociedadPrivada($value);
        }else{
            throw new Exception('Custom validation rule does not exist');
        }

        if ( !$this->isValid ) {
            $this->setCustomMessages([$attribute => $validatorEc->getError()]);
            return $this->isValid;
        }

        return $this->isValid ;
    }
}