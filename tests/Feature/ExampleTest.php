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
    TipoUsuarioRequest};

it('usuario', function () {
    $response = Siiau::send(new GetUsuarioRequest(codigo: '1234567890')); // Replace with a valid code

    dd($response->dto());
});

it('alumno', function () {
    $response = Siiau::send(new GetAlumnoRequest(codigo: '1234567890')); // Replace with a valid code

    dd($response->dto());
});

it('buscar-nrc', function () {

    $response = Siiau::send(new BuscarNrcRequest(
        claveMateria: 'I5915',
        seccion: 'D05', // TODO: Add seccion to the request
        ciclo: '2021B',
    ));

    dd($response->dto());
});

it('detalle-nrc', function () {

    $response = Siiau::send(new DetalleNrcRequest(
        nrc: '125213',
        ciclo: '2019B',
    ));

    dd($response->dto());
});

it('get carreras alumno', function () {

    $response = Siiau::send(new CarrerasAlumnoRequest(
        codigo: '1234567890',
    ));

    dd($response->dto());
});

it('kardex request', function () {

    $response = Siiau::send(new KardexRequest(
        codigo: '1234567890',
        carrera: 'INNI',
    ));

    dd($response->dto());
});

it('tipo de usuario', function () {

    $response = Siiau::send(new TipoUsuarioRequest(
        codigo: '1234567890',
        password: 'esta-es-una-contraseña-falsa',
    ));

    dd($response->dto());
});

it('horario', function () {

    $response = Siiau::send(new HorarioRequest(
        codigo: '1234567890',
        ciclo: '2022B',
    ));

    dd($response->dto());
});

it('carreras centro', function () {

    $response = Siiau::send(new GetCarrerasCentroRequest(
        siglas: 'CUCEI',
    ));

    dd($response->dto());
});
