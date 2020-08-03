<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingFacadeInterface;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\ProductListCompanyBrandConnectorFacadeInterface;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class DefaultShippingCompanyUnitAddressPostSavePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Communication\Plugin\DefaultShippingCompanyUnitAddressPostSavePlugin
     */
    protected $defaultShippingCompanyUnitAddressPostSavePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingFacadeInterface
     */
    protected $companyUnitAddressDefaultShippingFacadeInterface;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    protected $companyUnitAddressResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companyUnitAddressDefaultShippingFacadeInterface = $this->getMockBuilder(CompanyUnitAddressDefaultShippingFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressResponseTransferMock = $this->getMockBuilder(CompanyUnitAddressResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->defaultShippingCompanyUnitAddressPostSavePlugin = new class (
            $this->companyUnitAddressDefaultShippingFacadeInterface
        ) extends DefaultShippingCompanyUnitAddressPostSavePlugin {
            /**
             * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingFacadeInterface
             */
            protected $companyUnitAddressDefaultShippingFacade;

            /**
             *  constructor.
             * @param \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingFacadeInterface $companyUnitAddressDefaultShippingFacade
             */
            public function __construct(CompanyUnitAddressDefaultShippingFacadeInterface $companyUnitAddressDefaultShippingFacade)
            {
                $this->companyUnitAddressDefaultShippingFacade = $companyUnitAddressDefaultShippingFacade;
            }

            /**
             * @return \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingFacadeInterface
             */
            public function getFacade(): CompanyUnitAddressDefaultShippingFacadeInterface
            {
                return $this->companyUnitAddressDefaultShippingFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testPostSave(): void
    {
        $this->productListCompanyBrandConnectorFacadeMock->expects($this->atLeastOnce())
            ->method('saveDefaultShippingAddressIdToCompanyBusinessUnit')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->assertInstanceOf(
            CompanyUnitAddressResponseTransfer::class,
            $this->defaultShippingCompanyUnitAddressPostSavePlugin->postSave(
                $this->companyUnitAddressTransferMock
            )
        );
    }
}
