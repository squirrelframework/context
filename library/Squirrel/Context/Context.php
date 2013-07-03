<?php

namespace Squirrel\Context;

use Squirrel\Context\Exception\NotFoundException;
use Squirrel\Context\Exception\InvalidTypeException;

/**
 * Container class for dependencies injection.
 *
 * @package Squirrel\Context
 * @author Valérian Galliat
 */
class Context
{
    /**
     * @var mixed[string]
     */
    protected $context;

    /**
     * Initializes context array.
     */
    public function __construct()
    {
        $this->context = array();
    }

    /**
     * Ensures that an item is an instance of given class.
     *
     * @throws NotFoundException
     * @throws InvalidTypeException
     * @param string $name Item name to test.
     * @param string $type Type or parent class name.
     */
    public function ensure($name, $type)
    {
        $value = $this->get($name);

        switch ($type) {
            case 'int':
                $pass = is_int($value);
                break;
            case 'integer':
                $pass = is_integer($value);
                break;
            case 'bool':
                $pass = is_bool($value);
                break;
            case 'boolean':
                $pass = is_bool($value);
                break;
            case 'float':
                $pass = is_float($value);
                break;
            case 'double':
                $pass = is_double($value);
                break;
            case 'real':
                $pass = is_real($value);
                break;
            case 'string':
                $pass = is_string($value);
                break;
            case 'array':
                $pass = is_array($value);
                break;
            case 'object':
                $pass = is_object($value);
                break;
            default:
                $pass = $value instanceof $type;
        }

        if (!$pass) {
            throw new InvalidTypeException(sprintf('Context item "%s" is required as a "%s".', $name, $type));
        }
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function has($name)
    {
        return isset($this->context[$name]);
    }

    /**
     * @throws NotFoundException
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        if (!$this->has($name)) {
            throw new NotFoundException(sprintf('Context item "%s" is required.', $name));
        }

        return $this->context[$name];
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function set($name, $value)
    {
        $this->context[$name] = $value;
    }
}
