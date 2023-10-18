<?php

use Siiau\ApiClient\Facades\Siiau;
use Siiau\ApiClient\Requests\GetUsuarioRequest;

it('can retrieve user info', function () {
    $response = Siiau::send(new GetUsuarioRequest(codigo: '123456789')); // Replace with a valid code

    expect($response->ok())->toBeTrue();
});
