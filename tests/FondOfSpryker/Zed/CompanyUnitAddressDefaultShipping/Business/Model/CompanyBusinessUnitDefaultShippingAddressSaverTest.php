<?php

namespace FondOfSpryker\Zed\CompanyBusinessUnitDefaultShippingAddress\Business\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\Model\CompanyBusinessUnitDefaultShippingAddressSaver;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Persistence\CompanyUnitAddressDefaultShippingEntityManager;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    protected $companyUnitAddressResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer
     */
    protected $companyUnitAddressCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Persistence\CompanyUnitAddressDefaultShippingEntityManager
     */
    protected $entityManagerMock;

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

        $this->entityManagerMock = $this
            ->getMockBuilder(CompanyUnitAddressDefaultShippingEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this
            ->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressResponseTransferMock = $this
            ->getMockBuilder(CompanyUnitAddressResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this
            ->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitDefaultShippingAddressSaver =
            new CompanyBusinessUnitDefaultShippingAddressSaver(
                $this->companyBusinessUnitFacadeMock,
                $this->entityManagerMock,
            );
    }

    /**
     * @return void
     */
    public function testSaveDefaultShippingAddressIdToCompanyBusinessUnitUpdate(): void
    {
        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompanyBusinessUnit')
            ->willReturn(1);

        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitById')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIsDefaultShipping')
            ->willReturn(true);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn(1);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getDefaultShippingAddress')
            ->willReturn(2);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('saveCompanyBusinessUnitDefaultShippingAddress')
            ->with($this->companyBusinessUnitTransferMock, 1)
            ->willReturn($this->companyBusinessUnitTransferMock);

        $companyUnitAddressResponseTransfer = $this->companyBusinessUnitDefaultShippingAddressSaver
            ->saveDefaultShippingAddressIdToCompanyBusinessUnit($this->companyUnitAddressTransferMock);

        $this->assertInstanceOf(
            CompanyUnitAddressResponseTransfer::class,
            $companyUnitAddressResponseTransfer,
        );

        $this->assertEquals(
            true,
            $companyUnitAddressResponseTransfer->getIsSuccessful(),
        );
    }

    /**
     * @return void
     */
    public function testSaveDefaultShippingAddressIdToCompanyBusinessUnitRemove(): void
    {
        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompanyBusinessUnit')
            ->willReturn(1);

        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitById')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIsDefaultShipping')
            ->willReturn(false);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn(1);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getDefaultShippingAddress')
            ->willReturn(1);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('saveCompanyBusinessUnitDefaultShippingAddress')
            ->with($this->companyBusinessUnitTransferMock, null)
            ->willReturn($this->companyBusinessUnitTransferMock);

        $companyUnitAddressResponseTransfer = $this->companyBusinessUnitDefaultShippingAddressSaver
            ->saveDefaultShippingAddressIdToCompanyBusinessUnit($this->companyUnitAddressTransferMock);

        $this->assertInstanceOf(
            CompanyUnitAddressResponseTransfer::class,
            $companyUnitAddressResponseTransfer,
        );

        $this->assertEquals(
            true,
            $companyUnitAddressResponseTransfer->getIsSuccessful(),
        );
    }

    /**
     * @return void
     */
    public function testSaveDefaultShippingAddressIdToCompanyBusinessUnitWithNoFkCompanyBusinessUnit(): void
    {
        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompanyBusinessUnit')
            ->willReturn(null);

        $companyUnitAddressResponseTransfer = $this->companyBusinessUnitDefaultShippingAddressSaver
            ->saveDefaultShippingAddressIdToCompanyBusinessUnit($this->companyUnitAddressTransferMock);

        $this->assertInstanceOf(
            CompanyUnitAddressResponseTransfer::class,
            $companyUnitAddressResponseTransfer,
        );

        $this->assertEquals(
            false,
            $companyUnitAddressResponseTransfer->getIsSuccessful(),
        );
    }
}
