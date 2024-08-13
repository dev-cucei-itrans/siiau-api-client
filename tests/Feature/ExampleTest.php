<?php

use Siiau\ApiClient\Requests\{BuscarNrcRequest,
    CarrerasAlumnoRequest,
    DetalleNrcRequest,
    GetCarrerasCentroRequest,
    HorarioRequest,
    KardexRequest,
    TipoUsuarioRequest, ValidarCredencialesRequest};
use Siiau\ApiClient\Objects\{Alumno, Usuario};

it('usuario', function () {
    $usuario = siiau()->usuario()->encontrar(codigo: '1234567890'); // Replace with a valid code.

    expect($usuario)->toBeInstanceOf(Alumno::class);
});

it('alumno', function () {
    $alumno = siiau()->alumno()->encontrar(codigo: '1234567890'); // Replace with a valid code

    expect($alumno)->toBeInstanceOf(Usuario::class);
});

it('buscar nrc', function () {

    $response = siiau()->send(new BuscarNrcRequest(
        claveMateria: 'I5915',
        seccion: 'D05', // TODO: Add seccion to the request
        ciclo: '2021B',
    ));

    expect($response->ok())->toBeTrue();
});

it('detalle-nrc', function () {

    $response = siiau()->send(new DetalleNrcRequest(
        nrc: '125213',
        ciclo: '2019B',
    ));

    expect($response->ok())->toBeTrue();
});

it('get carreras alumno', function () {

    $response = siiau()->send(new CarrerasAlumnoRequest(
        codigo: '1234567890',
    ));

    expect($response->ok())->toBeTrue();
});

it('kardex request', function () {

    $response = siiau()->send(new KardexRequest(
        codigo: '1234567890',
        carrera: 'INNI',
    ));

    expect($response->ok())->toBeTrue();
});

it('tipo de usuario', function () {

    $response = siiau()->send(new TipoUsuarioRequest(
        codigo: '1234567890',
        password: 'esta-es-una-contraseña-falsa',
    ));

    expect($response->ok())->toBeTrue();
});

it('horario', function () {

    $response = siiau()->send(new HorarioRequest(
        codigo: '1234567890',
        ciclo: '202220',
    ));

    expect($response->ok())->toBeTrue();
});

it('carreras centro', function () {

    $response = siiau()->send(new GetCarrerasCentroRequest(
        siglas: 'CUCEI',
    ));

    expect($response->ok())->toBeTrue();
});

it('validar credenciales', function () {

    $response = siiau()->send(new ValidarCredencialesRequest(
        codigo: '1234567890',
        password: 'esta-es-una-contraseña-falsa',
    ));

    expect($response->ok())->toBeTrue();
});
