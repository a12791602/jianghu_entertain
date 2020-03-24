<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use ReflectionClass;
use ReflectionProperty;

/**
 * 继承了BaseResource后, CustomResource 的属性必须是 private, 否则不能正常赋值.
 * Class BaseResource
 * @package App\Http\Resources
 */
class BaseResource extends JsonResource
{

    /**
     * BaseResource constructor.
     * @param JsonResource $resource JsonResource.
     * @throws \ReflectionException ReflectionException.
     */
    public function __construct($resource)
    {
        parent::__construct($resource);
        $reflection = new ReflectionClass($this);

        // Get all private property.
        $properties = $reflection->getProperties(ReflectionProperty::IS_PRIVATE);

        foreach ($properties as $property) {
            $getProperty = $reflection->getProperty($property->name);
            $getProperty->setAccessible(true);
            $getProperty->setValue($this, $resource->{$property->name});
        }
    }
}
