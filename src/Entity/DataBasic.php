<?php

namespace Etakeaway\Entity;

/**
 * DataBasic for response data when a proper object conversion isn't available.
 *
 * @implements DataInterface
 *
 * @final
 */
final class DataBasic implements DataInterface
{
    /**
     * List of properties.
     *
     * @var array
     */
    private $data = array();

    /**
     * Constructor.
     *
     * @param \stdClass $data Standard data object.
     */
    public function __construct(\stdClass $data)
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
    }

    /**
     * Getter for properties.
     *
     * @param string $property
     *
     * @throws \InvalidArgumentException If property argument isn't a string.
     *
     * @return mixed
     */
    public function get($property)
    {
        if (!is_string($property)) {
            throw new \InvalidArgumentException('Property argument must be a string, was: ' . gettype($property));

        }

        if (isset($this[$property])) {
            return $this[$property];
        }

        return null;
    }
}
