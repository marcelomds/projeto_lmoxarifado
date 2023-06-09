@extends('adminlte::page')

@section('title', 'Colaboradores')

@section('content_header')
    <h2 class="m-0 text-dark">Lista de Colaboradores</h2>
@stop

@section('content')
    @include('sweetalert::alert')

    <div class="d-flex justify-content-start m-2">
        <a href="{{ route('user.create') }}"
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
                            <th>Email</th>
                            <th>Cargo</th>
                            <th>Data de Cadastro</th>
                            <th width="200">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($collaborators as $collaborator)
                            <tr>
                                <td>{{ $collaborator->name }}</td>
                                <td>{{ $collaborator->email }}</td>
                                <td>{{ $collaborator->office->name }}</td>
                                <td>{{ $collaborator->created_at->format('d/m/Y - H:i:s') }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('user.edit', $collaborator->id) }}"
                                       class="btn btn-primary btn-sm"
                                        title="Editar"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Button trigger modal -->
                                    <button type="button"
                                            class="btn btn-danger btn-sm"
                                            data-toggle="modal" data-target="#exampleModalCenter{{ $collaborator->id }}"
                                            title="Excluir"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                        @if($collaborator->is_active == 1)
                                            <button class="btn btn-info btn-sm"
                                                    data-toggle="modal" data-target="#exampleModalCenterStatus{{ $collaborator->id }}"
                                                    title="Bloquear"
                                            ><i class='fa fa-check'></i></button>
                                        @else
                                            <button class="btn btn-secondary btn-sm"
                                                data-toggle="modal" data-target="#exampleModalCenterStatus{{ $collaborator->id }}"
                                                title="Desbloquear"
                                            ><i class='fa fa-ban'></i></button>
                                        @endif
                                    </form>
                                </td>
                            </tr>

                            <!-- Status Modal -->
                            <div class="modal fade" id="exampleModalCenterStatus{{ $collaborator->id }}"
                                 tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Status Colaborador</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Deseja alterar status desse colaborador?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('user.status', $collaborator->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary">Confirmar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="exampleModalCenter{{ $collaborator->id }}"
                                 tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Remover Colaborador</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Deseja remover esse colaborador?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('user.destroy', $collaborator->id) }}" method="POST">
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
