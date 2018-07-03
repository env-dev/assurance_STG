<?php

namespace App\Helpers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Registration;
use Carbon\Carbon;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExcelDoc implements FromView, WithEvents, ShouldAutoSize
{
    protected $data;
    protected $view;
    protected $data_name;
    protected $total_surprime;

    public  function __construct($arg, $view, $data_name, $total_surprime = null) {
        $this->data = $arg;
        $this->view = $view;
        $this->data_name = $data_name;
        $this->total_surprime = $total_surprime;
    }


    public function view(): View
    {
        return view($this->view, [
             $this->data_name => $this->data,
            'total_surprime' => $this->total_surprime
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