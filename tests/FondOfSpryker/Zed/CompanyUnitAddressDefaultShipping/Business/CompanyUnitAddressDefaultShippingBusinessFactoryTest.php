<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\Model\CompanyBusinessUnitDefaultShippingAddressSaverInterface;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\CompanyUnitAddressDefaultShippingDependencyProvider;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingiToEventFacadeInterface;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeInterface;
use Spryker\Zed\Kernel\Container;

class CompanyUnitAddressDefaultShippingBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingBusinessFactory
     */
    protected $companyUnitAddressDefaultShippingBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface
     */
    protected $companyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressDefaultShippingToCompanyUnitAddressFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingiToEventFacadeInterfaces
     */
    protected $companyUnitAddressDefaultShippingiToEventFacadeInterface;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressDefaultShippingBusinessFactory = $this->getMockBuilder(CompanyUnitAddressDefaultShippingBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeMock = $this
            ->getMockBuilder(CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressDefaultShippingToCompanyUnitAddressFacadeMock = $this
            ->getMockBuilder(CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressDefaultShippingiToEventFacadeInterface = $this
            ->getMockBuilder(CompanyUnitAddressDefaultShippingiToEventFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();


        $this->companyUnitAddressDefaultShippingBusinessFactory = new CompanyUnitAddressDefaultShippingBusinessFactory();
        $this->companyUnitAddressDefaultShippingBusinessFactory->setContainer($this->containerMock);
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
            ->withConsecutive(
                [CompanyUnitAddressDefaultShippingDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT],
                [CompanyUnitAddressDefaultShippingDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS],
                [CompanyUnitAddressDefaultShippingDependencyProvider::FACADE_EVENT]
            )->willReturnOnConsecutiveCalls(
                $this->companyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeMock,
                $this->companyUnitAddressDefaultShippingToCompanyUnitAddressFacadeMock,
                $this->companyUnitAddressDefaultShippingiToEventFacadeInterface
            );

        $this->assertInstanceOf(
            CompanyBusinessUnitDefaultShippingAddressSaverInterface::class,
            $this->companyUnitAddressDefaultShippingBusinessFactory->createCompanyBusinessUnitDefaultShippingAddressSaver()
        );
    }
}
