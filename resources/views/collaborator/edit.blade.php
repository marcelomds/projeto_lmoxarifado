@extends('adminlte::page')

@section('title', 'Colaborador - Editar')

@section('content_header')
    <h2 class="m-0 text-dark">Editar Colaborador</h2>
@stop

@section('content')
    @include('layouts.alert')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('user.update', $collaborator->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Nome do Colaborador</label>
                                    <input type="text"
                                           class="form-control"
                                           name="name"
                                           value="{{ $collaborator->name }}"
                                           required
                                           id="name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email"
                                           class="form-control"
                                           name="email"
                                           value="{{ $collaborator->email }}"
                                           required
                                           id="email"
                                    >
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label for="office_id">Cargo</label>
                                    <select name="office_id" id="office_id" class="form-control">
                                        <option value="" disabled selected>-- Selecione --</option>
                                        @foreach($offices as $office)
                                            <option value="{{ $office->id }}"
                                                {{ $collaborator->office_id == $office->id ? 'selected' : '' }}>{{ $office->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="password">Senha</label>
                                    <input type="password"
                                           class="form-control"
                                           name="password"
                                           disabled
                                           id="password"
                                    >
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Repetir Senha</label>
                                    <input type="password"
                                           class="form-control"
                                           name="password_confirmation"
                                           id="password_confirmation"
                                           disabled
                                    >
                                </div>
                            </div>
                        </div>
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
