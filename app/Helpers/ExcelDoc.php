<?php

namespace App\Helpers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Registration;
use Carbon\Carbon;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class ExcelDoc implements FromView, WithEvents
{
    protected $registrations;

    public  function __construct($arg) {
        $this->registrations = $arg;
    }


    public function view(): View
    {
        foreach ($this->registrations as $registration) {
            $registration->smartphone->model->brand;
            $registration->client;
        }
        return view('export.registrations', [
            'registrations' => $this->registrations,
        ]);
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class  => function(AfterSheet $event) {
                $event->sheet->styleCells(
                    'A1:N1',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ],
                        'font' => [
                            'bold' => true,
                        ]
                    ]
                );
            },
        ];
    }

}