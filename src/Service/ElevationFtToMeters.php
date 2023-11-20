<?php

declare(strict_types=1);

namespace App\Service;

use Pimcore\Logger;
use Pimcore\Model\DataObject\Concrete;
use Pimcore\Model\DataObject\ClassDefinition\CalculatorClassInterface;
use Pimcore\Model\DataObject\Data\CalculatedValue;

class ElevationFtToMeters extends FootToMeterConversionAbstract implements CalculatorClassInterface
{
    public function compute(Concrete $object, CalculatedValue $context): string
    {
        if ($context->getFieldname() === "elevationMeters") {
            $footToMetersValue = $object->getElevationFt() * self::FACTOR;

            return (string) $footToMetersValue;
        } else {
            Logger::error("unknown field");
        }
    }

    public function getCalculatedValueForEditMode(Concrete $object, CalculatedValue $context): string
    {
        return $object->getElevationFt() . " * " . self::FACTOR . " = " . $this->compute($object, $context);
    }
}
