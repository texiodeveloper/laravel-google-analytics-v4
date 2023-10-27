<?php

namespace TexLib\Analytics\Traits\Google;

use Google\Analytics\Data\V1beta\Metric;

trait MetricTrait
{
    public array $metrics = [];

    public function addMetric(string $name): self
    {
        if(!$this->existsInArray($name, $this->metrics)) {
            $this->metrics[] = new Metric([
                'name' => $name,
            ]);
        }

        return $this;
    }

    public function addMetrics(string ...$metrics): self
    {
        foreach ($metrics as $metric) {
            $this->addMetric($metric);
        }

        return $this;
    }

    public function existsInArray($name, $array) {
        foreach ($array as $compare) {
            if ($compare->getName() == $name) {
                return true;
            }
        }
        return false;
    }
}
