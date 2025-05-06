<?php

function validateInput($errors, $input, $value = null){
    if($errors->has($input)){
        return "is-invalid";
    }
    elseif (!$errors->has($input) && !empty($value)){
        return "is-valid";
    }
}