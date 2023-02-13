<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ChartExports implements  FromView, ShouldAutoSize
{
   use Exportable;
   var $parsing;
   var $filename;

   public function parsing($parsing)
   {
       $this->parsing = $parsing;
       return $this;
   }
   public function filename($filename)
   {
       $this->filename = $filename;
       return $this;
   }

   public function view(): View
   {
     return view('dashboard.'.$this->filename, [
        'data' => $this->parsing
     ]);
   }

   public function columnFormats(): array
    {
        return [
            'A' => Text,
            'B' => Text,
            'C' => Text,
            'D' => Text,
            'E' => Text,
            'F' => Text,
            'H' => Text,
            'I' => Text,
            'J' => Text,
            'K' => Text,
            'L' => Text,
            'M' => Text,
            'N' => Text,
            'O' => Text,
            'P' => Text,
            'Q' => Text,
            'R' => Text,
        ];
    }

}
