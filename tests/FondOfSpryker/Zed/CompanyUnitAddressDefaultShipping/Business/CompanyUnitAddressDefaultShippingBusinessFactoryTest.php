<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\Model\CompanyBusinessUnitDefaultShippingAddressSaverInterface;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\CompanyUnitAddressDefaultShippingDependencyProvider;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Persistence\CompanyUnitAddressDefaultShippingEntityManager;
use Spryker\Zed\Kernel\Container;

class CompanyUnitAddressDefaultShippingBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingBusinessFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Persistence\CompanyUnitAddressDefaultShippingEntityManager
     */
    protected $entityManagerMockMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = $this->getMockBuilder(CompanyUnitAddressDefaultShippingBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitFacadeMock = $this
            ->getMockBuilder(CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMockMock = $this
            ->getMockBuilder(CompanyUnitAddressDefaultShippingEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyUnitAddressDefaultShippingBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setEntityManager($this->entityManagerMockMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyBusinessUnitDefaultShippingAddressSaver(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompanyUnitAddressDefaultShippingDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT)
            ->willReturn($this->companyBusinessUnitFacadeMock);

        $this->assertInstanceOf(
            CompanyBusinessUnitDefaultShippingAddressSaverInterface::class,
            $this->factory->createCompanyBusinessUnitDefaultShippingAddressSaver(),
        );
    }
}
