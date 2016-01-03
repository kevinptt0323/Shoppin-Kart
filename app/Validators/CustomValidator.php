<?php

namespace App\Validators;

use Validator;

class CustomValidator extends \Illuminate\Validation\Validator {

    public function validateEachExists($attribute, $value, $parameters)
    {
        foreach ($value as $arrayIndex => $arrayValue) {
            foreach ($parameters as $existIndex => $existValue) {
                $this->validate($attribute.'.'.$arrayIndex.'.'.$existValue, 'required');
            }
        }

        return true;
    }

    protected function getAttribute($attribute)
    {
        // Get the second to last segment in singular form for arrays.
        // For example, `group.names.0` becomes `name`.
        if (str_contains($attribute, '.'))
        {
            $segments = explode('.', $attribute);

            $attribute = str_singular($segments[count($segments) - 2]);
        }

        return parent::getAttribute($attribute);
    }
}
