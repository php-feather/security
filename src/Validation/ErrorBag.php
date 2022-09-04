<?php

namespace Feather\Security\Validation;

use Feather\Support\Util\Bag;

/**
 * Description of ErrorBag
 *
 * @author fcarbah
 */
class ErrorBag extends Bag
{

    public function first($key)
    {

        $val = $this->{$key};

        if (empty($val)) {
            return null;
        }

        if (is_array($val)) {
            return current($val);
        }

        return $val;
    }

    /**
     *
     * @{inheritDoc}
     */
    public function get($key, $default = null)
    {
        $keyParts = explode('.', $key);
        $index    = $keyParts[0];
        $subIndex = count($keyParts) > 1 ? $keyParts[1] : null;

        $val = $this->{$index};

        if (empty($val)) {
            return $val;
        }

        if ($subIndex) {
            return $val[$subIndex] ?? null;
        }

        if (is_array($val) && count($val) == 1) {
            return current($val);
        }

        return $val ?: $default;
    }

    public function last($key)
    {

        $val = $this->{$key};

        if (empty($val)) {
            return null;
        }

        if (is_array($val)) {
            $temp = array_values($val);
            return $temp[count($temp) - 1];
        }

        return $val;
    }

}
