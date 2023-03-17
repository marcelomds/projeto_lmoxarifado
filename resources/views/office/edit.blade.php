@extends('adminlte::page')

@section('title', 'Cargo - Editar')

@section('content_header')
    <h2 class="m-0 text-dark">Editar Cargo</h2>
@stop

@section('content')
    @include('layouts.alert')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('office.update', $office->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Nome do Cargo</label>
                                    <input type="text"
                                           class="form-control"
                                           name="name"
                                           required
                                           id="name"
                                           value="{{ $office->name }}">
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
