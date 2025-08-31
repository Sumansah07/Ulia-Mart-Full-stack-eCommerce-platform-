<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Illuminate\Http\Request;

class ProductSalesReportExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithColumnWidths
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

        $products = Product::shop()->orderBy('total_sale_count', $order);

        if ($this->request->search != null) {
            $products = $products->where('name', 'like', '%' . $this->request->search . '%');
        }

        return $products->select(['id', 'name', 'slug', 'min_price', 'max_price', 'stock_qty', 'total_sale_count', 'is_published', 'created_at']);
    }

    public function headings(): array
    {
        return [
            'S/L',
            'Product Name',
            'Product Code',
            'Min Price',
            'Max Price',
            'Stock Quantity',
            'Total Sales',
            'Status',
            'Revenue Generated',
            'Created Date'
        ];
    }

    public function map($product): array
    {
        static $serial = 1;

        return [
            $serial++,
            $product->name,
            $product->slug,
            formatPrice($product->min_price ?? 0),
            formatPrice($product->max_price ?? 0),
            $product->stock_qty > 0 ? $product->stock_qty : '0',
            $product->total_sale_count > 0 ? $product->total_sale_count : '0',
            $product->is_published ? 'Published' : 'Unpublished',
            formatPrice(($product->min_price ?? 0) * ($product->total_sale_count ?? 0)),
            $product->created_at->format('Y-m-d H:i:s')
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,   // S/L
            'B' => 25,  // Product Name
            'C' => 20,  // Product Code
            'D' => 12,  // Min Price
            'E' => 12,  // Max Price
            'F' => 15,  // Stock Quantity
            'G' => 12,  // Total Sales
            'H' => 15,  // Status
            'I' => 18,  // Revenue Generated
            'J' => 20,  // Created Date
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
            'A:J' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]
            ]
        ];
    }
}
