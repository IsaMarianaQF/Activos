<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activo;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BajasController extends Controller
{
    public function index()
    {
        $activos = Activo::where('estado', 'Baja')->get();
        return view('bajas.index')->with('activos', $activos);
    }

    public function store(Request $request)
    {
        $activosSeleccionados = $request->input('activos_seleccionados');
        if (!$activosSeleccionados || count($activosSeleccionados) == 0) {
            return redirect()->back()->with('error', 'No se han seleccionado activos para la baja.');
        }

        Activo::whereIn('id', $activosSeleccionados)->update(['estado' => 'Baja']);
        $filename = $this->generarExcel($activosSeleccionados);
        return response()->download(storage_path('app/' . $filename))->deleteFileAfterSend(true);
    }

    protected function generarExcel($activosSeleccionados)
    {
        $datosExcel = $this->obtenerDatosExcel($activosSeleccionados);
        $filename = 'activos_baja_' . now()->format('Ymd_His') . '.xlsx';
        $this->crearArchivoExcel($datosExcel, $filename);
        return $filename;
    }

    protected function obtenerDatosExcel($activosSeleccionados)
    {
        $datosExcel = [];
        foreach ($activosSeleccionados as $key => $activoId) {
            $activo = Activo::findOrFail($activoId);
            $datosExcel[] = [
                'Item' => $key + 1,
                'Código Activo' => $activo->codactivo,
                'Código EBS' => '',
                'Marca' => $activo->marca,
                'Modelo' => $activo->modelo,
                'Serie' => $activo->serial,
                'Descripción' => $activo->sys,
                'Costo' => '',
                'Depreciación' => '',
                'Valor Neto' => '',
            ];
        }
        return $datosExcel;
    }

    protected function crearArchivoExcel($datosExcel, $filename)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Agregar título "BAJAS DE ACTIVOS"
        $sheet->setCellValue('A1', 'BAJAS DE ACTIVOS');
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Agregar los encabezados
        $headers = array_keys($datosExcel[0]);
        $sheet->fromArray($headers, null, 'A2');

        // Aplicar formato a los encabezados
        foreach ($headers as $key => $header) {
            $column = chr(65 + $key);
            $sheet->getStyle($column . '2')->getFont()->setBold(true);
            $sheet->getStyle($column . '2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($column . '2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle($column . '2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF00FF00');

            if (in_array($header, ['Código EBS', 'Costo', 'Depreciación', 'Valor Neto'])) {
                $sheet->getStyle($column . '2')->getFill()->setStartColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_YELLOW));
            }
        }

        $sheet->fromArray($datosExcel, null, 'A3');

        $sheet->getStyle('A2:J' . (count($datosExcel) + 2))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ]);

        $sheet->getStyle('A2:J' . (count($datosExcel) + 2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:J' . (count($datosExcel) + 2))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('F' . (count($datosExcel) + 3), 'TOTAL BOLIVIANOS');
        $sheet->mergeCells('F' . (count($datosExcel) + 3) . ':G' . (count($datosExcel) + 3));
        $sheet->getStyle('F' . (count($datosExcel) + 3))->getFont()->setBold(true);
        $sheet->getStyle('F' . (count($datosExcel) + 3))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('F' . (count($datosExcel) + 4), 'TOTAL SUS');
        $sheet->mergeCells('F' . (count($datosExcel) + 4) . ':G' . (count($datosExcel) + 4));
        $sheet->getStyle('F' . (count($datosExcel) + 4))->getFont()->setBold(true);
        $sheet->getStyle('F' . (count($datosExcel) + 4))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $writer = new Xlsx($spreadsheet);
        $writer->save(storage_path('app/' . $filename));
    }
}