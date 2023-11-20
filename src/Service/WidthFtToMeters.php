<?php

declare(strict_types=1);

namespace App\Service;

use Pimcore\Logger;
use Pimcore\Model\DataObject\Concrete;
use Pimcore\Model\DataObject\ClassDefinition\CalculatorClassInterface;
use Pimcore\Model\DataObject\Data\CalculatedValue;

class WidthFtToMeters extends FootToMeterConversionAbstract implements CalculatorClassInterface
{
    public function compute(Concrete $object, CalculatedValue $context): string
    {
        if ($context->getFieldname() === "widthMeters") {
            $footToMetersValue = $object->getWidthFt() * self::FACTOR;

            return (string) $footToMetersValue;
        } else {
            Logger::error("unknown field");
        }
    }

    public function getCalculatedValueForEditMode(Concrete $object, CalculatedValue $context): string
    {
        return $object->getWidthFt() . " * " . self::FACTOR . " = " . $this->compute($object, $context);
    }
}
