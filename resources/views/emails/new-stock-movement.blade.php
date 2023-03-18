<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nova movimentação de estoque</title>
</head>
<body>
<h1>Nova movimentação de estoque</h1>

<p>Uma nova movimentação de estoque foi registrada para o material: {{ $materialName }}.</p>

<ul>
    <li>Tipo de movimentação: {{ $type == 'out' ? 'Retirada' : 'Devolução' }}</li>
    <li>Quantidade: {{ $quantity }}</li>
    <li>Data: {{ $date->format('d/m/Y - H:i') }}</li>
    <li>Colaborador: {{ $collaboratorName }}</li>
</ul>
</body>
</html>
