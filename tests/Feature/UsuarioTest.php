<?php

it('can retrieve user info', function () {
    $response = siiau()->usuario()->obtener(codigo: '121212');
    expect($response->ok())->toBeTrue();
});
