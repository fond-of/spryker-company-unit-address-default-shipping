<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business;

use FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingFacadeInterface;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingBusinessFactory getFactory()
 */
class CompanyUnitAddressDefaultShippingFacade extends AbstractFacade implements CompanyUnitAddressDefaultShippingFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    public function saveDefaultShippingAddressIdToCompanyBusinessUnit(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressResponseTransfer {
        return $this->getFactory()->createCompanyBusinessUnitDefaultShippingAddressSaver()
            ->saveDefaultShippingAddressIdToCompanyBusinessUnit($companyUnitAddressTransfer);
    }
}
