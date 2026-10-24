<?php

namespace TradeInTradeUp\Exports;

// use TradeInTradeUp\Submissions;
// use TradeInTradeUp\PaymentSection;
// use TradeInTradeUp\PaymentStatuses;
// use TradeInTradeUp\PaymentMethods;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InvoiceValue implements FromView, WithColumnWidths, WithStyles
{

    public function styles(Worksheet $sheet): ?array
    {
        return [
            // Styling an entire column.
            1  => ['font' => ['size' => 16, 'bold' => true]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 24,
            'B' => 45, 
            'C' => 38, 
            'D' => 24, 
            'E' => 24, 
            'F' => 30, 
            'G' => 35, 
            'H' => 24, 
            'I' => 35, 
            'J' => 35,
            'K' => 80,            
        ];
    }

    public function view(): View
    {
        // $payments = PaymentSection::whereHas('submission', function ($q) {
        //     $q->where('payment_status', 1);
        // })->with(['submission' => function ($q) {
        //     $q->with('customerInfo');
        // }])->orderBy('created_at', 'ASC')->get();

        $payments = 'cats';

        return view('exports.invoicevalue', ['payments' => $payments]);

      
    }
}