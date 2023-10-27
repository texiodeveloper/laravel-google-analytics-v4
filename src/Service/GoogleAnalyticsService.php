<?php

namespace TexLib\Analytics\Service;

use TexLib\Analytics\Traits\Google\DateRangeTrait;
use TexLib\Analytics\Traits\Google\DimensionTrait;
use TexLib\Analytics\Traits\Google\FilterByTrait;
use TexLib\Analytics\Traits\Google\MetricAggregationTrait;
use TexLib\Analytics\Traits\Google\MetricTrait;
use TexLib\Analytics\Traits\Google\MinuteRangeTrait;
use TexLib\Analytics\Traits\Google\OrderByTrait;
use TexLib\Analytics\Traits\Google\RowConfigTrait;
use TexLib\Analytics\Traits\ResponseFormatterTrait;

class GoogleAnalyticsService
{
    use DateRangeTrait,
        DimensionTrait,
        FilterByTrait,
        MetricAggregationTrait,
        MetricTrait,
        MinuteRangeTrait,
        OrderByTrait,
        ResponseFormatterTrait,
        RowConfigTrait;
}
