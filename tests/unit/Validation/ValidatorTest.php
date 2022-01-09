<?php

use Feather\Security\Validation\Validator;
use PHPUnit\Framework\TestCase;

/**
 * Description of ValidatorTest
 *
 * @author fcarbah
 */
class ValidatorTest extends TestCase
{

    /**
     * @test
     */
    public function willPassWhenDataMatchesRules()
    {
        $input    = ['name' => 'Steve', 'count' => ['a', 'b', 'c', 1, 2, 3]];
        $rules    = ['name' => 'required||alpha', 'count' => 'array_count:{3},numeric'];
        $messages = ['name.required' => 'Name is required'];

        $validator = new Validator($input, $rules, $messages);

        $res    = $validator->validate();
        $errors = $validator->errors();
        $this->assertTrue($res);
        $this->assertTrue($errors->count() == 0);
    }

    /**
     * @test
     */
    public function willFailWhenDataDoesNotMatchRule()
    {
        $input    = ['name' => 'Steve123'];
        $rules    = ['name' => 'required||alpha'];
        $messages = ['name.required' => 'Name is required'];

        $validator = new Validator($input, $rules, $messages);

        $res    = $validator->validate();
        $errors = $validator->errors();
        $this->assertFalse($res);
        $this->assertTrue($errors->count() == 1);
    }

    /**
     * @test
     */
    public function willReturnDefaultMessageForFailedValidation()
    {
        $input = ['name' => '', 'age' => 30];
        $rules = ['name' => 'requiredif:age'];

        $validator = Validator::create($input, $rules);

        $res    = $validator->validate();
        $errors = $validator->errors();
        $this->assertFalse($res);
        $hasStr = stripos('name is required', $errors->first('name')) !== false;
        $this->assertTrue($hasStr);
    }

    /**
     * @test
     */
    public function willReturnCustomMessageForFailedValidation()
    {
        $input    = ['name' => '', 'age' => 30];
        $rules    = [
            'name' => 'requiredif_rule:(greater_than:age,{25})',
            'age'  => ['numeric', 'greater_than:{30}']];
        $messages = [
            'name.requiredif_rule' => 'Name is required for age over 25',
            'age.numeric'          => 'Age should be a number',
        ];


        $validator = Validator::create($input, $rules, $messages);

        $res    = $validator->validate();
        $errors = $validator->errors();
        $this->assertFalse($res);

        $nameError = stripos($errors->get('name.requiredif_rule'), 'name is required') !== false;

        $ageIsNumeric = $errors->get('age.numeric');
        $ageError     = stripos($errors->first('age'), 'age is not greater than') !== false;

        $this->assertTrue($nameError);
        $this->assertNull($ageIsNumeric);
        $this->assertTrue($ageError);
    }

}
