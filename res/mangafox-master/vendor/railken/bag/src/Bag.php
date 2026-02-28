<?php

namespace Railken;

/**
 * Bag is a container for key/value pairs.
 */
class Bag implements \IteratorAggregate, \Countable
{
    /**
     * Parameter storage.
     *
     * @var array
     */
    protected $parameters;

    /**
     * New instance.
     *
     * @param self|array|\stdClass|object $parameters An array of parameters
     *
     * @return self
     */
    public static function factory($parameters = [])
    {
        return new static($parameters);
    }

    /**
     * Constructor.
     *
     * @param self|array|\stdClass|object $parameters An array of parameters
     */
    public function __construct($parameters = [])
    {
        if (is_array($parameters)) {
            $this->parameters = $parameters;
        } elseif ($parameters instanceof self) {
            $this->parameters = $parameters->all();
        } elseif ($parameters instanceof \stdClass || is_object($parameters)) {
            $this->parameters = json_decode(json_encode($parameters), true);
        } else {
            throw new \InvalidArgumentException('Bag::__construct() expects array, stdClass or Bag.');
        }
    }

    /**
     * Dynamically access a parameter.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * Dynamically set a value for a a parameter.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function __set($key, $value)
    {
        return $this->set($key, $value);
    }

    /**
     * Returns the parameters.
     *
     * @return array An array of parameters
     */
    public function all()
    {
        return $this->parameters;
    }

    /**
     * Returns the parameters.
     *
     * @return array An array of parameters
     */
    public function toArray()
    {
        return $this->all();
    }

    /**
     * Returns the parameter keys.
     *
     * @return array An array of parameter keys
     */
    public function keys()
    {
        return array_keys($this->parameters);
    }

    /**
     * Replaces the current parameters by a new set.
     *
     * @param array $parameters An array of parameters
     *
     * @return $this
     */
    public function replace(array $parameters = [])
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * Adds parameters.
     *
     * @param array $parameters An array of parameters
     *
     * @return $this
     */
    public function add(array $parameters = [])
    {
        $this->parameters = array_replace($this->parameters, $parameters);

        return $this;
    }

    /**
     * Returns a parameter by name.
     *
     * @param string $key     The key
     * @param mixed  $default The default value if the parameter key does not exist
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (isset($this->parameters[$key])) {
            return $this->parameters[$key];
        }

        $data = $this->parameters;

        foreach (explode('.', $key) as $pkey) {
            if (!is_array($data) || !array_key_exists($pkey, $data)) {
                return $default;
            }

            $data = $data[$pkey];
        }

        return $data;

        $this->has($key) ? $this->parameters[$key] : $default;
    }

    /**
     * Sets a parameter by name.
     *
     * @param string $key   The key
     * @param mixed  $value The value
     *
     * @return $this
     */
    public function set($key, $value)
    {
        $keys = explode('.', $key);

        $data = &$this->parameters;

        while (count($keys) > 1) {
            $pkey = $keys[0];

            if (!array_key_exists($pkey, $data) || !is_array($data[$pkey])) {
                $data[$pkey] = [];
            }

            $data = &$data[$pkey];
            array_shift($keys);
        }

        $data[$keys[0]] = $value;

        return $this;
    }

    /**
     * Returns true if the parameter is defined.
     *
     * @param string $key The key
     *
     * @return bool true if the parameter exists, false otherwise
     */
    public function has($key)
    {
        $data = $this->parameters;

        foreach (explode('.', $key) as $pkey) {
            if (!array_key_exists($pkey, $data) || !is_array($data)) {
                return false;
            }

            $data = $data[$pkey];
        }

        return true;
    }

    /**
     * Require the given parameter, if doesn't exists throw an exception
     *
     * @param string $key The key
     * 
     */
    public function require($key)
    {
        if ($this->has($key)) {
            return $this->get($key);
        }

        throw new \UnexpectedValueException(sprintf("Missing required key: %s", $key));
    }

    /**
     * Alias @has.
     *
     * @param string $key The key
     *
     * @return bool true if the parameter exists, false otherwise
     */
    public function exists($key)
    {
        return $this->has($key);
    }

    /**
     * Removes a parameter.
     *
     * @param string $key The key
     *
     * @return $this
     */
    public function remove($key)
    {
        unset($this->parameters[$key]);

        return $this;
    }

    /**
     * Returns an iterator for parameters.
     *
     * @return Traversable
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->parameters);
    }

    /**
     * Returns the number of parameters.
     *
     * @return int The number of parameters
     */
    public function count(): int
    {
        return count($this->parameters);
    }

    /**
     * Get only specific parameters by keys.
     *
     * @param array $keys
     *
     * @return self
     */
    public function only(array $keys)
    {
        return new static(array_intersect_key($this->parameters, array_flip($keys)));
    }

    /**
     * Filter current bag with specific parameters by keys.
     *
     * @param array $keys
     *
     * @return $this
     */
    public function filter(array $keys)
    {
        $this->parameters = array_intersect_key($this->parameters, array_flip($keys));

        return $this;
    }

    /**
     * Merge the current bag with another
     *
     * @param array $parameters
     *
     * @return static
     */
    public function merge($parameters)
    {
        return static::factory(array_merge($this->all(), static::factory($parameters)->all()));
    }
}
