<?php

namespace library\factories
{

    use library\handler\LibraryFilter;
    use library\handler\BooksQuery;
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
