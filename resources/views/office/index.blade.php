@extends('adminlte::page')

@section('title', 'Cargo')

@section('content_header')
    <h2 class="m-0 text-dark">Lista de Cargos</h2>
@stop

@section('content')
    @include('sweetalert::alert')

    <div class="d-flex justify-content-start m-2">
        <a href="{{ route('office.create') }}"
                class="btn btn-primary"
                >Novo Registro <i class="fa fa-plus"></i></a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th width="200">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($offices as $office)
                                <tr>
                                    <td>{{ $office->name }}</td>
                                    <td>
                                        <a href="{{ route('office.edit', $office->id) }}"
                                           class="btn btn-primary btn-sm"
                                           title="Editar"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- Button trigger modal -->
                                        <button type="button"
                                                class="btn btn-danger btn-sm"
                                                data-toggle="modal" data-target="#exampleModalCenter{{ $office->id }}"
                                                title="Excluir"
                                        ><i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="exampleModalCenter{{ $office->id }}"
                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Remover Cargo</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Deseja remover esse ítem?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('office.destroy', $office->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Nenhum registro cadastrado</td>
                                    </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
