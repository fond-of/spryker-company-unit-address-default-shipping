<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface;
use Generated\Shared\Transfer\BrandRelationTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressLabelCollectionTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface;

class CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeBridge
     */
    protected $companyUnitAddressDefaultShippingToCompanyUnitAddressFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressCriteriaFilterTransfer
     */
    protected $companyUnitAddressCriteriaFilterTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(CompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressCriteriaFilterTransferMock = $this->getMockBuilder(CompanyUnitAddressCriteriaFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressDefaultShippingToCompanyUnitAddressFacadeBridge =
            new CompanyUnitAddressDefaultShippingToCompanyUnitAddressFacadeBridge($this->companyUnitAddressFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyUnitAddressCollection(): void
    {
        $this->assertInstanceOf(
            CompanyUnitAddressCollectionTransfer::class,
            $this->companyUnitAddressDefaultShippingToCompanyUnitAddressFacadeBridge
                ->getCompanyUnitAddressCollection($this->companyUnitAddressCriteriaFilterTransferMock)
        );
    }
}
