<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use TCPDF;
use Illuminate\Http\Request;

class ExportCartController extends Controller
{
    public function exportPDF(Request $request)
    {
        $query = CartItem::with(['camera', 'turniket', 'barrier']);

        // Фильтрация по оборудованию
        if ($request->filled('equipment')) {
            $query->whereHas('camera', fn($q) => $q->where('name_camera', $request->equipment))
                ->orWhereHas('turniket', fn($q) => $q->where('name_turniket', $request->equipment))
                ->orWhereHas('barrier', fn($q) => $q->where('name_barrier', $request->equipment));
        }

        // Фильтрация по цене
        $query->where(function ($q) use ($request) {
            $filters = [];
            // Фильтрация по дате
            if ($request->filled('date_from') && $request->filled('date_to')) {
                $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
            } elseif ($request->filled('date_from')) {
                $q->whereDate('created_at', '>=', $request->date_from);
            } elseif ($request->filled('date_to')) {
                $q->whereDate('created_at', '<=', $request->date_to);
            }
        
            // Фильтрация по цене
            if ($request->filled('price_min') && $request->filled('price_max')) {
                $q->where(function ($q) use ($request) {
                    $q->whereHas('camera', fn($q) => $q->whereBetween('price', [$request->price_min, $request->price_max]))
                      ->orWhereHas('turniket', fn($q) => $q->whereBetween('price', [$request->price_min, $request->price_max]))
                      ->orWhereHas('barrier', fn($q) => $q->whereBetween('price', [$request->price_min, $request->price_max]));
                });
            } elseif ($request->filled('price_min')) {
                $q->whereHas('camera', fn($q) => $q->where('price', '>=', $request->price_min))
                  ->orWhereHas('turniket', fn($q) => $q->where('price', '>=', $request->price_min))
                  ->orWhereHas('barrier', fn($q) => $q->where('price', '>=', $request->price_min));
            } elseif ($request->filled('price_max')) {
                $q->whereHas('camera', fn($q) => $q->where('price', '<=', $request->price_max))
                  ->orWhereHas('turniket', fn($q) => $q->where('price', '<=', $request->price_max))
                  ->orWhereHas('barrier', fn($q) => $q->where('price', '<=', $request->price_max));
            }

            // Фильтрация по сумме заказа
            if ($request->filled('sum_min') || $request->filled('sum_max')) {
                $q->whereRaw("(COALESCE((SELECT price FROM cameras WHERE cameras.id = camera_id), 
                                            (SELECT price FROM turnikets WHERE turnikets.id = turniket_id), 
                                            (SELECT price FROM barriers WHERE barriers.id = barrier_id), 0) 
                                * quantity) BETWEEN ? AND ?", 
                                [$request->sum_min ?? 0, $request->sum_max ?? PHP_INT_MAX]);
                $filters['sum_min'] = $request->sum_min;
                $filters['sum_max'] = $request->sum_max;
            }
        });    

        // Получаем отфильтрованные заказы
        $orders = $query->get();

        // Создаём PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Заказы за период ' . ($request->date_from ?? 'начало') . ' - ' . ($request->date_to ?? 'сейчас'));
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();
        $pdf->SetFont('dejavusans', '', 12);

        // HTML для PDF
        $html = '<h1>Заказы за период ' . ($request->date_from ?? 'начало') . ' - ' . ($request->date_to ?? 'сейчас') . '</h1>';
        $html .= '<table border="1" cellpadding="5">';
        $html .= '<tr><th>Оборудование</th><th>Цена</th><th>Количество</th><th>Сумма</th><th>Дата покупки</th></tr>';

        foreach ($orders as $item) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($item->camera?->name_camera ?? $item->turniket?->name_turniket ?? $item->barrier?->name_barrier ?? 'Не указано') . '</td>';
            $html .= '<td>' . htmlspecialchars($item->camera?->price ?? $item->turniket?->price ?? $item->barrier?->price ?? '?') . ' BYN</td>';
            $html .= '<td>' . htmlspecialchars($item->quantity) . '</td>';
            $html .= '<td>' . htmlspecialchars((($item->camera?->price ?? $item->turniket?->price ?? $item->barrier?->price) ?? 0) * $item->quantity) . ' BYN</td>';
            $html .= '<td>' . htmlspecialchars($item->created_at) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        // Добавляем HTML в PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Возвращаем PDF как response
        return response($pdf->Output('', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="cart_items.pdf"');
    }
}
