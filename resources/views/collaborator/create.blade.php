@extends('adminlte::page')

@section('title', 'Colaborador - Cadastro')

@section('content_header')
    <h2 class="m-0 text-dark">Cadastrar Colaborador</h2>
@stop

@section('content')
    @include('layouts.alert')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Nome do Colaborador</label>
                                    <input type="text"
                                           class="form-control"
                                           name="name"
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
                                    @forelse($offices as $office)
                                            <option value="{{ $office->id }}">{{ $office->name }}</option>
                                        @empty
                                            <option value="">Nenhum cargo cadastrado</option>
                                        @endforelse
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
                                           required
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
                                           required
                                           id="password_confirmation"
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
