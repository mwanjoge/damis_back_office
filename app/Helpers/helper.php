<?php

function validateInput($errors, $input, $value = null){
    if($errors->has($input)){
        return "is-invalid";
    }
    elseif (!$errors->has($input) && !empty($value)){
        return "is-valid";
    }
}

function encode(...$args)
{
    return app(Sqids\Sqids::class)->encode(...$args);
}

function decode($enc)
{
    if (is_int($enc)) {
        return $enc;
    }

    return app(Sqids\Sqids::class)->decode($enc)[0];
}