<!DOCTYPE html>
<html>
<head>
    <title>Nova Movimentação</title>
</head>
<body>
<h1>Nova Movimentação Registrada</h1>
<p>Uma nova movimentação foi registrada no sistema:</p>
<ul>
    <li><strong>ID:</strong> {{ $movement->id }}</li>
    <li><strong>Colaborador:</strong> {{ $movement->collaborator->name }}</li>
    <li><strong>Cargo:</strong> {{ $movement->collaborator->office->name }}</li>
    <li><strong>Tipo:</strong> {{ $movement->type == 'out' ? 'Retirada' : 'Devolução' }}</li>
    <li><strong>Material:</strong> {{ $movement->material->name }}</li>
    <li><strong>Quantidade:</strong> {{ $movement->quantity }}</li>
    <li><strong>Data:</strong> {{ date('d/m/Y H:i', strtotime($movement->created_at)) }}</li>
</ul>
</body>
</html>
