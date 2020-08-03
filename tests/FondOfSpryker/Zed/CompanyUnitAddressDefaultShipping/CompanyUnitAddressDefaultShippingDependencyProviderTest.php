<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeBridge;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToBrandCompanyFacadeBridge;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface;
use Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class CompanyUnitAddressDefaultShippingDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\CompanyUnitAddressDefaultShippingDependencyProvider
     */
    protected $companyUnitAddressDefaultShippingDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'offsetSet', 'offsetGet', 'set', 'get'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitFacadeMock = $this->getMockBuilder(CompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(CompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressDefaultShippingDependencyProvider =
            new CompanyUnitAddressDefaultShippingDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->withConsecutive(['companyBusinessUnit'], ['companyUnitAddress'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturnOnConsecutiveCalls(
                $this->companyBusinessUnitFacadeMock,
                $this->companyUnitAddressFacadeMock
            );

        $this->assertEquals(
            $this->containerMock,
            $this->companyUnitAddressDefaultShippingDependencyProvider->provideBusinessLayerDependencies($this->containerMock)
        );

        $this->assertInstanceOf(
            CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeBridge::class,
            $this->containerMock[CompanyUnitAddressDefaultShippingDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT]
        );

        $this->assertInstanceOf(
            CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeBridge::class,
            $this->containerMock[CompanyUnitAddressDefaultShippingDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS]
        );
    }
}
