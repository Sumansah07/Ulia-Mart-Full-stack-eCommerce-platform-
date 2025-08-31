<?php

namespace App\Exports;

use App\Models\Order;
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

class DeliveryStatusReportExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function query()
    {
        // Date range filter
        if (Str::contains($this->request->date_range, 'to') && $this->request->date_range != null) {
            $date_var = explode(" to ", $this->request->date_range);
        } else {
            $date_var = [date("d-m-Y", strtotime('7 days ago')), date("d-m-Y", strtotime('today'))];
        }

        $orders = Order::where('created_at', '>=', date("Y-m-d", strtotime($date_var[0])))
            ->where('created_at', '<=', date("Y-m-d 23:59:59", strtotime($date_var[1])))
            ->groupBy('delivery_status')
            ->selectRaw('delivery_status, count(delivery_status) as total_order');

        return $orders;
    }

    public function headings(): array
    {
        return [
            'S/L',
            'Delivery Status',
            'Total Orders',
            'Percentage',
            'Status Description'
        ];
    }

    public function map($order): array
    {
        static $serial = 1;

        // Calculate total orders for percentage
        $totalOrders = Order::where('created_at', '>=', date("Y-m-d", strtotime($this->getDateRange()[0])))
            ->where('created_at', '<=', date("Y-m-d 23:59:59", strtotime($this->getDateRange()[1])))
            ->count();

        $percentage = $totalOrders > 0 ? round(($order->total_order / $totalOrders) * 100, 2) : 0;

        return [
            $serial++,
            ucfirst(str_replace('_', ' ', $order->delivery_status)),
            $order->total_order > 0 ? $order->total_order : '0',
            $percentage > 0 ? $percentage . '%' : '0%',
            $this->getStatusDescription($order->delivery_status)
        ];
    }

    private function getDateRange()
    {
        if (Str::contains($this->request->date_range, 'to') && $this->request->date_range != null) {
            return explode(" to ", $this->request->date_range);
        } else {
            return [date("d-m-Y", strtotime('7 days ago')), date("d-m-Y", strtotime('today'))];
        }
    }

    private function getStatusDescription($status)
    {
        $descriptions = [
            'order_placed' => 'Order has been placed and confirmed',
            'pending' => 'Order is pending processing',
            'confirmed' => 'Order has been confirmed',
            'on_the_way' => 'Order is out for delivery',
            'delivered' => 'Order has been successfully delivered',
            'cancelled' => 'Order has been cancelled',
            'returned' => 'Order has been returned'
        ];

        return $descriptions[$status] ?? 'Status description not available';
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,   // S/L
            'B' => 20,  // Delivery Status
            'C' => 15,  // Total Orders
            'D' => 12,  // Percentage
            'E' => 40,  // Status Description
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
            'A:E' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]
            ]
        ];
    }
}
