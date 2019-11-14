<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Facades\DB;

class ExperienceExport implements FromArray
{
    protected $Experience;

    public function __construct($Experience)
    {
        $this->Experience = $Experience;
    }

    public function array(): array
    {
        $array[] = ['작성자이름', '작성자연락처', '도시', '지역', '작성일자', '전도인이름', '전도인성별', '전도인회중명', '전도인연락처', '경함담내용'];
        $array[] = [ 
            $this->Experience->AdminName, 
            $this->Experience->AdminMobile,
            $this->Experience->MetroName,
            $this->Experience->CircuitName,
            $this->Experience->CreateDate,
            $this->Experience->PublisherName,
            $this->Experience->PublisherGender,
            $this->Experience->CongregationName,
            $this->Experience->PublisherMobile,
            $this->Experience->Contents,
        ];
        return $array;
    }
}

