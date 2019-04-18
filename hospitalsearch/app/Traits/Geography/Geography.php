<?php
/**
 * Created by PhpStorm.
 * User: vaishnavmhetre
 * Date: 18/4/19
 * Time: 2:51 PM
 */

namespace App\Traits\Geography;


use Illuminate\Database\Eloquent\Builder;
trait Geography
{
    /**
     * @param Builder $query
     * @param float $latitude Latitude
     * @param float $longitude Longitude
     * @return Builder
     */
    public function scopeDistance($query, $latitude, $longitude)
    {
        $latName = $this->getQualifiedLatitudeColumn();
        $lonName = $this->getQualifiedLongitudeColumn();
        $query->select($this->getTable() . '.*');
        $sql = "((ACOS(SIN(? * PI() / 180) * SIN(" . $latName . " * PI() / 180) + COS(? * PI() / 180) * COS(" .
            $latName . " * PI() / 180) * COS((? - " . $lonName . ") * PI() / 180)) * 180 / PI()) * 60 * ?) as distance";
        $kilometers = false;
        if (property_exists(static::class, 'kilometers')) {
            $kilometers = static::$kilometers;
        }
        if ($kilometers) {
            $query->selectRaw($sql, [$latitude, $latitude, $longitude, 1.1515 * 1.609344]);
        } else {
            // miles
            $query->selectRaw($sql, [$latitude, $latitude, $longitude, 1.1515]);
        }

        return $query;
    }
    public function scopeGeofence($query, $latitude, $longitude, $inner_radius, $outer_radius)
    {
        $query = $this->scopeDistance($query, $latitude, $longitude);
        return $query->havingRaw('distance BETWEEN ? AND ?', [$inner_radius, $outer_radius]);
    }
    protected function getQualifiedLatitudeColumn()
    {
        return $this->getTable() . '.' . $this->getLatitudeColumn();
    }
    protected function getQualifiedLongitudeColumn()
    {
        return $this->getTable() . '.' . $this->getLongitudeColumn();
    }
    public function getLatitudeColumn()
    {
        return defined('static::LATITUDE') ? static::LATITUDE : 'latitude';
    }
    public function getLongitudeColumn()
    {
        return defined('static::LONGITUDE') ? static::LONGITUDE : 'longitude';
    }
}
