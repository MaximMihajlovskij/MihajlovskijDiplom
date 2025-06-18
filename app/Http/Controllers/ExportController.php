<?php

namespace App\Http\Controllers;

use App\Models\RepairCamera;
use TCPDF;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportPDF(Request $request)
    {
        // Фильтрация по датам
        $query = RepairCamera::query();

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('DateCreateRepair', [$request->date_from, $request->date_to]);
        } elseif ($request->filled('date_from')) {
            $query->whereDate('DateCreateRepair', '>=', $request->date_from);
        } elseif ($request->filled('date_to')) {
            $query->whereDate('DateCreateRepair', '<=', $request->date_to);
        }

        // Получаем отфильтрованные заявки
        $requests = $query->get();

        // Создаём PDF-документ
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Заявки на ремонт камер');
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();
        $pdf->SetFont('dejavusans', '', 12);

        // HTML для PDF
        $html = '<h1>Заявки на ремонт камер</h1>';
        $html .= '<table border="1" cellpadding="5">';
        $html .= '<tr><th>Клиент</th><th>Название</th><th>Описание проблемы</th><th>Дата заявки</th><th>Статус срочности</th><th>Статус выполнения</th></tr>';

        foreach ($requests as $request) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($request->user->name) . '</td>';
            $html .= '<td>' . htmlspecialchars($request->name_camera) . '</td>';
            $html .= '<td>' . htmlspecialchars($request->ProblemDescription) . '</td>';
            $html .= '<td>' . htmlspecialchars($request->DateCreateRepair) . '</td>';
            $html .= '<td>' . htmlspecialchars($request->status->СтатусСрочности) . '</td>';
            $html .= '<td>' . htmlspecialchars($request->complete->СтатусВыполнения) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        // Добавляем HTML в PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Возвращаем PDF как response
        return response($pdf->Output('', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="repair_requests.pdf"');
    }
}


