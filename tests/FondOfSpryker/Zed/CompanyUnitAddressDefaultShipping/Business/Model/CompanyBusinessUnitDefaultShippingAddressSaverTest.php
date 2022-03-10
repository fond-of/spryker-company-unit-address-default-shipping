<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitDefaultShippingAddress\Business\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\Model\CompanyBusinessUnitDefaultShippingAddressSaver;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingiToEventFacadeInterface;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class CompanyBusinessUnitDefaultShippingAddressSaverTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\Model\CompanyBusinessUnitDefaultShippingAddressSaver
     */
    protected $companyBusinessUnitDefaultShippingAddressSaver;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer
     */
    protected $companyBusinessUnitResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer
     */
    protected $companyUnitAddressCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingiToEventFacadeInterface
     */
    protected $eventFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitFacadeMock = $this
            ->getMockBuilder(CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeMock = $this
            ->getMockBuilder(CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventFacadeMock = $this
            ->getMockBuilder(CompanyUnitAddressDefaultShippingiToEventFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this
            ->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitResponseTransferMock = $this
            ->getMockBuilder(CompanyBusinessUnitResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressCollectionTransferMock = $this
            ->getMockBuilder(CompanyUnitAddressCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitDefaultShippingAddressSaver =
            new CompanyBusinessUnitDefaultShippingAddressSaver(
              $this->companyBusinessUnitFacadeMock,
              $this->companyUnitAddressFacadeMock,
              $this->eventFacadeMock
            );
    }

    /**
     * @return void
     */
    public function testSaveDefaultShippingAddressIdToCompanyBusinessUnit(): void
    {
        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompanyBusinessUnit')
            ->willReturn(1);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIsDefaultShipping')
            ->willReturn(true);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn(1);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn(1);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressCollection')
            ->willReturn($this->companyUnitAddressCollectionTransferMock);

        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('update')
            ->willReturn($this->companyBusinessUnitResponseTransferMock);

        $companyUnitAddressResponseTransfer = $this->companyBusinessUnitDefaultShippingAddressSaver
            ->saveDefaultShippingAddressIdToCompanyBusinessUnit($this->companyUnitAddressTransferMock);

        $this->assertInstanceOf(
            CompanyUnitAddressResponseTransfer::class,
            $companyUnitAddressResponseTransfer
        );

        $this->assertEquals(
            true,
            $companyUnitAddressResponseTransfer->getIsSuccessful()
        );
    }
}
