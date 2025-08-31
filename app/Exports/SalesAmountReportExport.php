<?php

namespace App\Exports;

use App\Models\OrderItem;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Illuminate\Http\Request;
use Str;

class SalesAmountReportExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $order = 'DESC';
        if ($this->request->order == "ASC") {
            $order = 'ASC';
        }

        // Date range filter
        if (Str::contains($this->request->date_range, 'to') && $this->request->date_range != null) {
            $date_var = explode(" to ", $this->request->date_range);
        } else {
            $date_var = [date("d-m-Y", strtotime('7 days ago')), date("d-m-Y", strtotime('today'))];
        }

        $orderItems = OrderItem::orderBy('total_price', $order)
            ->where('created_at', '>=', date("Y-m-d", strtotime($date_var[0])))
            ->where('created_at', '<=', date("Y-m-d 23:59:59", strtotime($date_var[1])))
            ->groupBy('created_at')
            ->selectRaw('created_at, sum(total_price) as total_price, count(*) as items_count');

        return $orderItems;
    }

    public function headings(): array
    {
        return [
            'S/L',
            'Date',
            'Total Sales Amount',
            'Items Sold',
            'Average Order Value',
            'Day of Week'
        ];
    }

    public function map($orderItem): array
    {
        static $serial = 1;

        return [
            $serial++,
            date('d M, Y', strtotime($orderItem->created_at)),
            formatPrice($orderItem->total_price ?? 0),
            $orderItem->items_count > 0 ? $orderItem->items_count : '0',
            formatPrice($orderItem->items_count > 0 ? $orderItem->total_price / $orderItem->items_count : 0),
            date('l', strtotime($orderItem->created_at)) // Day of week
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,   // S/L
            'B' => 15,  // Date
            'C' => 20,  // Total Sales Amount
            'D' => 15,  // Items Sold
            'E' => 20,  // Average Order Value
            'F' => 15,  // Day of Week
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Header row styling
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '198754'] // Green color
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]
            ],
            // Auto-size columns
            'A:F' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]
            ]
        ];
    }
}
