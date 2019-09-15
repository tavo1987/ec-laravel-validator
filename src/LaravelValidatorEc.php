<?php

namespace Tavo\EcLaravelValidator;

use Error;
use Illuminate\Validation\Validator;
use Tavo\ValidadorEc;

class LaravelValidatorEc extends Validator
{
    private $isValid = false;

    private $types = [
      'ci'        => 'validarCedula',
      'ruc'       => 'validarRucPersonaNatural',
      'ruc_spub'  => 'validarRucSociedadPublica',
      'ruc_spriv' => 'validarRucSociedadPrivada'
    ];

    public function validateEcuador($attribute, $value, $parameters)
    {
        $validator = new ValidadorEc();
        try {
            $this->isValid = $validator->{$this->types[$parameters[0]]}($value);
        } catch (\Exception $exception) {
            throw new Error("Custom validation rule ecuador:{$parameters[0]} does not exist");
        }


        if ( !$this->isValid ) {
            $error = strtolower($validator->getError());
            $this->setCustomMessages(["{$attribute} : {$error}"]);

            return $this->isValid;
        }

        return $this->isValid ;
    }
}
