<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface;
use Generated\Shared\Transfer\BrandRelationTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressLabelCollectionTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface;

class CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeBridge
     */
    protected $companyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitFacadeMock = $this->getMockBuilder(CompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeBridge =
            new CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeBridge($this->companyBusinessUnitFacadeMock);
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->assertInstanceOf(
            CompanyBusinessUnitResponseTransfer::class,
            $this->companyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeBridge
                ->update($this->companyBusinessUnitTransferMock)
        );
    }
}
