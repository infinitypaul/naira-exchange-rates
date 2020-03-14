<?php

namespace Infinitypaul\NairaExchangeRates\Traits;

use Infinitypaul\NairaExchangeRates\Exceptions\Exceptions;

trait TypeTraits
{
    // Set the base type:
    public function setType(string $type)
    {
        // Sanitize the code:
        $type = $this->sanitizeTypes($type);

        $this->verifyType($type);

        $this->type = $type;

        // Return object to preserve method-chaining:
        return $this;
    }

    // Get the specified type:
    public function getBaseType()
    {
        return (is_null($this->type)) ? 'cbn' : $this->type;
    }

    // Sanitize types:
    private function sanitizeTypes(string $code)
    {
        return trim(
            strtolower($code)
        );
    }

    /**
     * Verify Types.
     * @param \Infinitypaul\NairaExchangeRates\Traits\string $code
     *
     * @throws \Infinitypaul\NairaExchangeRates\Exceptions\Exceptions
     */
    private function verifyType(string $code)
    {
        $type = $this->sanitizeTypes($code);

        // Is it a supported type?
        if (! $this->typeIsSupported($type)) {
            throw Exceptions::create('format.unsupported_type');
        }
    }

    // Check if a type is in the supported range:
    private function typeIsSupported(string $code)
    {
        $type = $this->sanitizeTypes($code);

        return in_array($type, $this->_types);
    }
}
