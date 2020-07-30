<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade;

use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Dependency\Facade\CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacade;

class CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeBridge implements CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeInterface
{
    /**
     * @var \Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacade
     */
    protected $companyBusinessUnitFacade;

    /**
     * CompanyUnitAddressDefaultShippingToCompanyBusinessUnitFacadeBridge constructor.
     *
     * @param \Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacade $companyBusinessUnitFacade
     */
    public function __construct(CompanyBusinessUnitFacade $companyBusinessUnitFacade)
    {
        $this->companyBusinessUnitFacade = $companyBusinessUnitFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer
     */
    public function update(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): CompanyBusinessUnitResponseTransfer {
        return $this->companyBusinessUnitFacade->update($companyBusinessUnitTransfer);
    }
}
