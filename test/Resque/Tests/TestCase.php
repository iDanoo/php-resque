<?php

/**
 * Resque test case class. Contains setup and teardown methods.
 *
 * @package        Resque/Tests
 * @author        Chris Boulton <chris@bigcommerce.com>
 * @license        http://www.opensource.org/licenses/mit-license.php
 */

class Resque_Tests_TestCase extends PHPUnit\Framework\TestCase
{
    protected $resque;
    protected $redis;

    public static function setUpBeforeClass()
    {
        date_default_timezone_set('UTC');
    }

    public function setUp()
    {
//        $config = file_get_contents(REDIS_CONF);
//        preg_match('#^\s*port\s+([0-9]+)#m', $config, $matches);
        $this->redis = new Redis();
        $this->redis->connect('localhost');
        $this->redis->select(9);

        Resque::setBackend('localhost', 9);

        // Flush redis
        $this->redis->flushAll();
    }
}
