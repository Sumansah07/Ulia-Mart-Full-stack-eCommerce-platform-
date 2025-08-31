<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\ProductCategory;
use App\Scopes\ThemeCategoryScope;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Illuminate\Http\Request;

class CategorySalesReportExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithColumnWidths
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

        $categories = Category::withoutGlobalScope(ThemeCategoryScope::class)->orderBy('total_sale_count', $order);

        if ($this->request->search != null) {
            $categories = $categories->where('name', 'like', '%' . $this->request->search . '%');
        }

        return $categories->select(['id', 'name', 'slug', 'total_sale_count', 'is_featured', 'created_at']);
    }

    public function headings(): array
    {
        return [
            'S/L',
            'Category Name',
            'Category Code',
            'Total Sales',
            'Featured Status',
            'Products Count',
            'Created Date'
        ];
    }

    public function map($category): array
    {
        static $serial = 1;

        // Get products count for this category
        $productsCount = ProductCategory::where('category_id', $category->id)->count();

        return [
            $serial++,
            $category->name ?? 'N/A',
            $category->slug ?? 'N/A',
            $category->total_sale_count > 0 ? $category->total_sale_count : '0',
            $category->is_featured ? 'Featured' : 'Not Featured',
            $productsCount > 0 ? $productsCount : '0',
            $category->created_at ? $category->created_at->format('Y-m-d H:i:s') : 'N/A'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,   // S/L
            'B' => 25,  // Category Name
            'C' => 20,  // Category Code
            'D' => 15,  // Total Sales
            'E' => 18,  // Featured Status
            'F' => 15,  // Products Count
            'G' => 20,  // Created Date
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
            'A:G' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]
            ]
        ];
    }
}
