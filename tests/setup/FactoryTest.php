<?php

namespace library\setup
{

    use library\xmlhandler\XmlFormProcessor;
    use library\xmlhandler\XmlQuery;
    use PHPUnit\Framework\TestCase;

    /**
     * Class FactoryTest
     * @package library\setup
     * @covers library\setup\Factory
     * @uses   library\setup\Configuration
     */
    class FactoryTest extends TestCase
    {
        /** @var Factory */
        private $factory;

        /** @var \PHPUnit_Framework_MockObject_MockObject|Configuration */
        private $configuration;

        public function setUp()
        {
            $this->configuration = $this->getMockBuilder(Configuration::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->factory = new Factory($this->configuration);
        }

    }
}
