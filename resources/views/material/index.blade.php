@extends('adminlte::page')

@section('title', 'Material')

@section('content_header')
    <h2 class="m-0 text-dark">Estoque de Materiais</h2>
@stop

@section('content')
    @include('sweetalert::alert')

    <div class="d-flex justify-content-start m-2">
        <a href="{{ route('material.create') }}"
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
                            <th>Quantidades</th>
                            <th>Data de Cadastro</th>
                            <th>Data de Atualização</th>
                            <th width="200">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($materials as $material)
                            <tr>
                                <td>{{ $material->name }}</td>
                                <td>{{ $material->quantity }}</td>
                                <td>{{ $material->created_at->format('d/m/Y - H:i:s') }}</td>
                                <td>{{ $material->updated_at ? $material->updated_at->format('d/m/Y - H:i:s') : '-' }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('material.edit', $material->id) }}"
                                       class="btn btn-primary btn-sm"
                                       title="Editar"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Button trigger modal -->
                                    <button type="button"
                                            class="btn btn-danger btn-sm"
                                            data-toggle="modal" data-target="#exampleModalCenter{{ $material->id }}"
                                            title="Excluir"
                                        ><i class="fas fa-trash-alt"></i>
                                    </button>
                                        @if($material->is_active == 1)
                                            <button class="btn btn-info btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#exampleModalCenterStatus{{ $material->id }}"
                                                    title="Bloquear"
                                            ><i class='fa fa-check'></i></button>
                                        @else
                                            <button class="btn btn-secondary btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#exampleModalCenterStatus{{ $material->id }}"
                                                    title="Desbloquear"
                                            ><i class='fa fa-ban'></i></button>
                                        @endif
                                    </form>
                                </td>
                            </tr>

                            <!-- Status Modal -->
                            <div class="modal fade" id="exampleModalCenterStatus{{ $material->id }}"
                                 tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Status Material</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Deseja alterar status desse ítem?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('material.status', $material->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary">Confirmar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="exampleModalCenter{{ $material->id }}"
                                 tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Remover Material</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Deseja remover esse ítem?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Cancelar
                                            </button>
                                            <form action="{{ route('material.destroy', $material->id) }}" method="POST">
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
                                <td colspan="4" class="text-center">Nenhum registro cadastrado</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
