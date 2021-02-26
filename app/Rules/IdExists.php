<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class IdExists implements Rule
{
    private $tableName;
    private $fieldName;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tableName , $fieldName)
    {
        $this->tableName = $tableName;
        $this->fieldName = $fieldName;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return DB::table($this->tableName)->where('id', '=', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->fieldName . ' ' . __("is incorrect");
    }
}
