<?php

use Siiau\ApiClient\Facades\Siiau;
use Siiau\ApiClient\Requests\{BuscarNrcRequest,
    CarrerasAlumnoRequest,
    DetalleNrcRequest,
    GetAlumnoRequest,
    GetCarrerasCentroRequest,
    GetUsuarioRequest,
    HorarioRequest,
    KardexRequest,
    TipoUsuarioRequest, ValidarCredencialesRequest};

it('usuario', function () {
    $response = Siiau::send(new GetUsuarioRequest(codigo: '1234567890')); // Replace with a valid code

    expect($response->ok())->toBeTrue();
});

it('alumno', function () {
    $response = Siiau::send(new GetAlumnoRequest(codigo: '1234567890')); // Replace with a valid code

    expect($response->ok())->toBeTrue();
});

it('buscar-nrc', function () {

    $response = Siiau::send(new BuscarNrcRequest(
        claveMateria: 'I5915',
        seccion: 'D05', // TODO: Add seccion to the request
        ciclo: '2021B',
    ));

    expect($response->ok())->toBeTrue();
});

it('detalle-nrc', function () {

    $response = Siiau::send(new DetalleNrcRequest(
        nrc: '125213',
        ciclo: '2019B',
    ));

    expect($response->ok())->toBeTrue();
});

it('get carreras alumno', function () {

    $response = Siiau::send(new CarrerasAlumnoRequest(
        codigo: '1234567890',
    ));

    expect($response->ok())->toBeTrue();
});

it('kardex request', function () {

    $response = Siiau::send(new KardexRequest(
        codigo: '1234567890',
        carrera: 'INNI',
    ));

    expect($response->ok())->toBeTrue();
});

it('tipo de usuario', function () {

    $response = Siiau::send(new TipoUsuarioRequest(
        codigo: '1234567890',
        password: 'esta-es-una-contraseña-falsa',
    ));

    expect($response->ok())->toBeTrue();
});

it('horario', function () {

    $response = Siiau::send(new HorarioRequest(
        codigo: '1234567890',
        ciclo: '202220',
    ));

    expect($response->ok())->toBeTrue();
});

it('carreras centro', function () {

    $response = Siiau::send(new GetCarrerasCentroRequest(
        siglas: 'CUCEI',
    ));

    expect($response->ok())->toBeTrue();
});

it('validar credenciales', function () {

    $response = Siiau::send(new ValidarCredencialesRequest(
        codigo: '216508551',
        password: 'esta-es-una-contraseña-falsa'
    ));

    expect($response->ok())->toBeTrue();
});
