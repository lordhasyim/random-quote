<?php
/**
 * Created by PhpStorm.
 * User: hasyim
 * Date: 12/21/17
 * Time: 4:08 PM
 */
namespace App\Validators;

use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;

class RestValidator extends Validator {

    /**
     * Add an error message to the validator's collection of messages.
     *
     * @param string $attribute
     * @param string $rule
     * @param array $parameters
     * @return void
     */
    public function addError($attribute, $rule, $parameters)
    {
        $message = $this->getMessage($attribute, $rule);
        $message = $this->doReplacement($message, $attribute, $rule, $parameters);

        $customMessage = new MessageBag();
        $customMessage->merge([
            'code' => strtolower($rule . '_rule_error')
        ]);
        $customMessage->merge([
            'message' => $message
        ]);

        $this->message->add($attribute, $customMessage);
    }
}