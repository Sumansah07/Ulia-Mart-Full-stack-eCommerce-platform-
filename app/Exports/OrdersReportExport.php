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

class OrdersReportExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $orders = Order::with(['orderGroup', 'orderItems'])->latest();

        // Apply same filters as in controller
        if ($this->request->delivery_status != null) {
            $orders = $orders->where('delivery_status', $this->request->delivery_status);
        }

        if ($this->request->payment_status != null) {
            $orders = $orders->where('payment_status', $this->request->payment_status);
        }

        // Date range filter
        if (Str::contains($this->request->date_range, 'to') && $this->request->date_range != null) {
            $date_var = explode(" to ", $this->request->date_range);
        } else {
            $date_var = [date("d-m-Y", strtotime('7 days ago')), date("d-m-Y", strtotime('today'))];
        }

        $orders = $orders->where('created_at', '>=', date("Y-m-d", strtotime($date_var[0])))
                        ->where('created_at', '<=', date("Y-m-d 23:59:59", strtotime($date_var[1])));

        return $orders;
    }

    public function headings(): array
    {
        return [
            'S/L',
            'Order Code',
            'Placed On',
            'Customer Name',
            'Customer Email',
            'Customer Phone',
            'Items Count',
            'Payment Status',
            'Delivery Status',
            'Total Amount',
            'Payment Method',
            'Shipping Address',
            'Created Date'
        ];
    }

    public function map($order): array
    {
        static $serial = 1;

        $itemsCount = $order->orderItems()->count();

        return [
            $serial++,
            $order->orderGroup->order_code ?? 'N/A',
            date('d M, Y', strtotime($order->created_at)),
            $order->orderGroup->name ?? 'Guest',
            $order->orderGroup->email ?? 'N/A',
            $order->orderGroup->phone ?? 'N/A',
            $itemsCount > 0 ? $itemsCount : '0',
            ucfirst(str_replace('_', ' ', $order->payment_status)),
            ucfirst(str_replace('_', ' ', $order->delivery_status)),
            formatPrice($order->orderGroup->grand_total_amount ?? 0),
            $order->orderGroup->payment_method ?? 'N/A',
            $this->getShippingAddress($order),
            $order->created_at->format('Y-m-d H:i:s')
        ];
    }

    private function getShippingAddress($order)
    {
        $address = $order->orderGroup->shippingAddress ?? null;
        if (!$address) return 'N/A';

        return trim(implode(', ', array_filter([
            $address->address,
            $address->city->name ?? null,
            $address->state->name ?? null,
            $address->country->name ?? null
        ])));
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,   // S/L
            'B' => 15,  // Order Code
            'C' => 15,  // Placed On
            'D' => 20,  // Customer Name
            'E' => 25,  // Customer Email
            'F' => 18,  // Customer Phone
            'G' => 12,  // Items Count
            'H' => 15,  // Payment Status
            'I' => 15,  // Delivery Status
            'J' => 15,  // Total Amount
            'K' => 15,  // Payment Method
            'L' => 30,  // Shipping Address
            'M' => 20,  // Created Date
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
            'A:M' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]
            ]
        ];
    }
}
