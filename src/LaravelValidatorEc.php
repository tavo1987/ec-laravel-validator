<?php

namespace Tavo\EcLaravelValidator;

use Error;
use Illuminate\Validation\Validator;
use Tavo\ValidadorEc;

class LaravelValidatorEc extends Validator
{
    private bool $isValid = false;

    /**
     * Mapping of validation rule types to ValidadorEc methods.
     *
     * @var array<string, string>
     */
    private array $types = [
        'ci'        => 'validateCedula',
        'ruc'       => 'validateNaturalPersonRuc',
        'ruc_spub'  => 'validatePublicCompanyRuc',
        'ruc_spriv' => 'validatePrivateCompanyRuc',
    ];

    /**
     * Validate Ecuadorian identification numbers.
     *
     * @param string $attribute
     * @param mixed $value
     * @param array<int, string> $parameters
     * @return bool
     */
    public function validateEcuador(string $attribute, mixed $value, array $parameters): bool
    {
        $validator = new ValidadorEc();

        try {
            $type = $parameters[0] ?? '';
            if (!isset($this->types[$type])) {
                throw new Error("Custom validation rule ecuador:{$type} does not exist");
            }
            $this->isValid = $validator->{$this->types[$type]}($value);
        } catch (Error $error) {
            throw $error;
        } catch (\Throwable $throwable) {
            $this->isValid = false;
        }

        if (!$this->isValid) {
            $error = strtolower($validator->getError());
            $this->setCustomMessages(["{$attribute} : {$error}"]);
        }

        return $this->isValid;
    }
}
