<?php

namespace App\Exports;

use App\Models\Material\StockMovementFlow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StockMovementsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return StockMovementFlow::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Colaborador',
            'Cargo',
            'Tipo',
            'Material',
            'Quantidade',
            'Data',
        ];
    }

    public function map($movement): array
    {
        return [
            $movement->id,
            $movement->collaborator->name,
            $movement->collaborator->office->name,
            $movement->type == 'out' ? 'Retirada' : 'Devolução',
            $movement->material->name,
            $movement->quantity,
            date('d/m/Y H:i', strtotime($movement->created_at)),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}
