<?php

declare(strict_types=1);

/*
 * This file is part of management
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Common\Helpers;

use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Class PropertyAccessorHelper
 */
final class PropertyAccessorHelper
{
    public static function getProperty($object, string $propertyTarget)
    {
        static $accessor;

        if (!$accessor) {
            $accessor = new PropertyAccessor();
        }

        return $accessor->getValue($object, $propertyTarget);
    }
}
