<?php

namespace TexLib\Analytics\Traits\Google;

use Google\Analytics\Data\V1beta\DateRange;
use TexLib\Analytics\Period;

trait DateRangeTrait
{
    public array $dateRanges = [];

    public function setDateRange(Period $period): self
    {
        $this->dateRanges = [
            new DateRange([
                'start_date' => $period->startDate->format('Y-m-d'),
                'end_date' => $period->endDate->format('Y-m-d'),
            ]),
        ];

        return $this;
    }

    public function setDateRanges(Period ...$items): self
    {
        $this->dateRanges = [];

        foreach ($items as $item) {
            $this->dateRanges[] = new DateRange([
                'start_date' => $item->startDate->format('Y-m-d'),
                'end_date' => $item->endDate->format('Y-m-d'),
            ]);
        }

        return $this;
    }
}
