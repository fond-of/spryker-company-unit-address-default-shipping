<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\Model\CompanyBusinessUnitDefaultShippingAddressSaverInterface;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class CompanyUnitAddressDefaultShippingFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingFacadeInterface
     */
    protected $companyUnitAddressDefaultShippingFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\Model\CompanyBusinessUnitDefaultShippingAddressSaverInterface
     */
    protected $companyBusinessUnitDefaultShippingAddressSaverMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingBusinessFactory
     */
    protected $companyUnitAddressDefaultShippingBusinessFactoryMock;

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
        $this->companyUnitAddressDefaultShippingBusinessFactoryMock = $this->getMockBuilder(CompanyUnitAddressDefaultShippingBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitDefaultShippingAddressSaverMock = $this->getMockBuilder(CompanyBusinessUnitDefaultShippingAddressSaverInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressResponseTransferMock = $this->getMockBuilder(CompanyUnitAddressResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressDefaultShippingFacade = new CompanyUnitAddressDefaultShippingFacade();
        $this->companyUnitAddressDefaultShippingFacade->setFactory($this->companyUnitAddressDefaultShippingBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testSaveDefaultShippingAddressIdToCompanyBusinessUnit(): void
    {
        $this->companyUnitAddressDefaultShippingBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyBusinessUnitDefaultShippingAddressSaver')
            ->willReturn($this->companyBusinessUnitDefaultShippingAddressSaverMock);

        $this->companyBusinessUnitDefaultShippingAddressSaverMock->expects($this->atLeastOnce())
            ->method('saveDefaultShippingAddressIdToCompanyBusinessUnit')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->assertInstanceOf(
            CompanyUnitAddressResponseTransfer::class,
            $this->companyUnitAddressDefaultShippingFacade->saveDefaultShippingAddressIdToCompanyBusinessUnit(
                $this->companyUnitAddressTransferMock,
            ),
        );
    }
}
