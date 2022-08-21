<?php

namespace LonnyX\NovaApexChart;

use Laravel\Nova\Metrics\Metric;
use Laravel\Nova\Http\Requests\NovaRequest;

class ApexMetric extends Metric
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = 'full';

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->withMeta([
            'options' => (object) [],
            'type' => 'bar',
            'chartWidth' => '100%',
            'chartHeight' => 'auto',
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'nova-apex-chart';
    }

    public function series(array $series): self
    {
        return $this->withMeta([ 'series' => $series ]);
    }

    public function type(string $type): self
    {
        return $this->withMeta([ 'type' => $type ]);
    }

    public function chartWidth(string $width): self
    {
        return $this->withMeta([ 'chartWidth' => $width ]);
    }

    public function chartHeight(string $type): self
    {
        return $this->withMeta([ 'chartHeight' => $type ]);
    }

    public function disableDate(bool $disabled = true): self
    {
        return $this->withMeta([ 'disableDate' => $disabled ]);
    }

    public function options(array $options): self
    {
        return $this->withMeta([ 'options' => (object) $options ]);
    }

    /**
     * Get the appropriate cache key for the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return string
     */
    public function getCacheKey(NovaRequest $request)
    {
        return sprintf(
            'nova.metric.%s.%s.%s.%s.%s.%s',
            $this->uriKey(),
            $request->input('startDate', 'no-startDate'),
            $request->input('endDate', 'no-endDate'),
            $request->input('timezone', 'no-timezone'),
            $this->onlyOnDetail ? $request->findModelOrFail()->getKey() : 'no-resource-id',
            md5($request->input('filter', 'no-filter'))
        );
    }
}
