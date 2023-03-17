@extends('adminlte::page')

@section('title', 'Material - Editar')

@section('content_header')
    <h2 class="m-0 text-dark">Editar Material</h2>
@stop

@section('content')
    @include('layouts.alert')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('material.update', $material->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-10">
                                <div class="form-group">
                                    <label for="name">Nome do Material</label>
                                    <input type="text"
                                           class="form-control"
                                           name="name"
                                           required
                                           id="name"
                                           value="{{ $material->name }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <div class="form-group">
                                    <label for="quantity">Quantidade</label>
                                    <input type="number"
                                           class="form-control"
                                           name="quantity"
                                           required
                                           id="quantity"
                                           min="1"
                                           value="{{ $material->quantity }}">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-md mb-0" type="submit">Cadastrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
