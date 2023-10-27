<?php

namespace TexLib\Analytics;

use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use TexLib\Analytics\Service\GoogleAnalyticsService;
use TexLib\Analytics\Traits\Analytics\DemographicAnalytics;
use TexLib\Analytics\Traits\Analytics\DevicesAnalytics;
use TexLib\Analytics\Traits\Analytics\RealtimeAnalytics;
use TexLib\Analytics\Traits\Analytics\ResourceAnalytics;
use TexLib\Analytics\Traits\Analytics\SessionsAnalytics;
use TexLib\Analytics\Traits\Analytics\UsersAnalytics;
use TexLib\Analytics\Traits\Analytics\ViewsAnalytics;
use TexLib\Analytics\Traits\ResponseFormatterTrait;

class Analytics
{
    use DemographicAnalytics,
        DevicesAnalytics,
        RealtimeAnalytics,
        ResourceAnalytics,
        ResponseFormatterTrait,
        SessionsAnalytics,
        UsersAnalytics,
        ViewsAnalytics;

    public ?int $propertyId = null;

    public ?string $credentials = null;

    public GoogleAnalyticsService $googleAnalytics;

    public function __construct(int $propertyId = null)
    {
        $this->googleAnalytics = new GoogleAnalyticsService();
        $this->propertyId = $propertyId ?? config('google-analytics.property_id') ?? null;
        $this->credentials = config('google-analytics.credentials') ?? null;
    }

    public function setPropertyId(int $propertyId): self
    {
        $this->propertyId = $propertyId;

        return $this;
    }

    public function setCredentials(string $credentials): self
    {
        $this->credentials = $credentials;

        return $this;
    }

    public function getCredentials(): ?string
    {
        return $this->credentials;
    }

    public function getPropertyId(): ?int
    {
        return $this->propertyId;
    }

    public function getClient(): BetaAnalyticsDataClient
    {
        return new BetaAnalyticsDataClient([
            'credentials' => $this->getCredentials(),
        ]);
    }

    public function getReport(GoogleAnalyticsService $googleAnalytics): AnalyticsResponse
    {
        $client = $this->getClient();

        $parameters = [
            'property' => 'properties/'.$this->getPropertyId(),
            'dateRanges' => $googleAnalytics->dateRanges,
            'minuteRanges' => $googleAnalytics->minuteRanges,
            'dimensions' => $googleAnalytics->dimensions,
            'metrics' => $googleAnalytics->metrics,
            'orderBys' => $googleAnalytics->orderBys,
            'metricAggregations' => $googleAnalytics->metricAggregations,
            'dimensionFilter' => $googleAnalytics->dimensionFilter,
            'metricFilter' => $googleAnalytics->metricFilter,
            'limit' => $googleAnalytics->limit,
            'offset' => $googleAnalytics->offset,
            'keepEmptyRows' => $googleAnalytics->keepEmptyRows,
        ];

        $response = $client->runReport($parameters);

        return $this->formatResponse($response);
    }

    public function getRealtimeReport(GoogleAnalyticsService $googleAnalytics): AnalyticsResponse
    {
        $client = $this->getClient();

        $parameters = [
            'property' => 'properties/'.$this->getPropertyId(),
            'dateRanges' => $googleAnalytics->dateRanges,
            'minuteRanges' => $googleAnalytics->minuteRanges,
            'dimensions' => $googleAnalytics->dimensions,
            'metrics' => $googleAnalytics->metrics,
            'orderBys' => $googleAnalytics->orderBys,
            'metricAggregations' => $googleAnalytics->metricAggregations,
            'dimensionFilter' => $googleAnalytics->dimensionFilter,
            'metricFilter' => $googleAnalytics->metricFilter,
            'limit' => $googleAnalytics->limit,
            'offset' => $googleAnalytics->offset,
            'keepEmptyRows' => $googleAnalytics->keepEmptyRows,
        ];

        $response = $client->runRealtimeReport($parameters);

        return $this->formatResponse($response);
    }
}
