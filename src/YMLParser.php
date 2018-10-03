<?php

/**
 * @author Serkin Alexander <serkin.alexander@gmail.com>
 * @license https://github.com/serkin/ymlparser/LICENSE MIT
 */

namespace YMLParser;

class YMLParser
{
    /**
     * Driver for parsing xml.
     *
     * @var Driver\DriverInterface
     */
    private $driver;

    /**
     *
     * @param \YMLParser\Driver\DriverInterface $driver
     */
    public function __construct(Driver\DriverInterface $driver)
    {
        $this->driver = $driver;
    }


    /**
     * OpeС‚s and creates XML DOM tree.
     *
     * Sets error for YMLParser if cannot open file or xml is invalid
     *
     * @param string $filename Path to file
     *
     * @throws \Exception Throws exception if file doesn't exist or its size = 0
     *
     * @return bool
     */
    public function open($filename)
    {
        if ((file_exists($filename) === false || filesize($filename) === 0) && (strpos($filename, '://') < 1)):
            throw new \Exception("File: {$filename} does not exist or empty.");
        endif;

        return $this->driver->open($filename);
    }

    public function __call($method, $args = null)
    {
        return call_user_func_array([$this->driver, $method], $args);
    }
}
