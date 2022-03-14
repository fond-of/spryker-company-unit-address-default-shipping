<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingFacade;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class DefaultShippingCompanyUnitAddressPostSavePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Communication\Plugin\DefaultShippingCompanyUnitAddressPostSavePlugin
     */
    protected $defaultShippingCompanyUnitAddressPostSavePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingFacadeInterface
     */
    protected $companyUnitAddressDefaultShippingFacadeMock;

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
        $this->companyUnitAddressDefaultShippingFacadeMock = $this->getMockBuilder(CompanyUnitAddressDefaultShippingFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressResponseTransferMock = $this->getMockBuilder(CompanyUnitAddressResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->defaultShippingCompanyUnitAddressPostSavePlugin = new class (
            $this->companyUnitAddressDefaultShippingFacadeMock
        ) extends DefaultShippingCompanyUnitAddressPostSavePlugin {
            /**
             * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingFacadeInterface
             */
            protected $companyUnitAddressDefaultShippingFacade;

            /**
             * @param \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingFacade $companyUnitAddressDefaultShippingFacade
             */
            public function __construct(CompanyUnitAddressDefaultShippingFacade $companyUnitAddressDefaultShippingFacade)
            {
                $this->companyUnitAddressDefaultShippingFacade = $companyUnitAddressDefaultShippingFacade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            public function getFacade(): AbstractFacade
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
        $this->companyUnitAddressDefaultShippingFacadeMock->expects($this->atLeastOnce())
            ->method('saveDefaultShippingAddressIdToCompanyBusinessUnit')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->assertInstanceOf(
            CompanyUnitAddressResponseTransfer::class,
            $this->defaultShippingCompanyUnitAddressPostSavePlugin->postSave(
                $this->companyUnitAddressTransferMock,
            ),
        );
    }
}
