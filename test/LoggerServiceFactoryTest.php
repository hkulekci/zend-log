<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendTest\Log;

use Zend\Log\Logger;
use Zend\Log\LoggerServiceFactory;
use Zend\Log\Writer\Mock;
use Zend\Log\Writer\Noop;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

/**
 * @group      Zend_Log
 */
class LoggerServiceFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Zend\ServiceManager\ServiceLocatorInterface
     */
    protected $serviceManager;

    /**
     * Set up LoggerAbstractServiceFactory and loggers configuration.
     *
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    protected function setUp()
    {
        $this->serviceManager = new ServiceManager();
        $config = new Config([
            'services' => [
                'config' => [
                    'log' => [
                        'logger' => [
                            'writers' => [
                                [
                                    'name'     => 'mock',
                                    'priority' => 1000,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);
        $config->configureServiceManager($this->serviceManager);
    }

    public function testValidLoggerServiceFactory()
    {
        $factory = new LoggerServiceFactory();
        $actual  = $factory($this->serviceManager, Logger::class);
        $this->assertInstanceOf(Logger::class, $actual);
    }
}
