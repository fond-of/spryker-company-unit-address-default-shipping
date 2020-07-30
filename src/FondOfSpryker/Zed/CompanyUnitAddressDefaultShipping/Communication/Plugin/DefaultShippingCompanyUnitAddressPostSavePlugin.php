<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Communication\Plugin;

use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\Zed\CompanyUnitAddressExtension\Dependency\Plugin\CompanyUnitAddressPostSavePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\CompanyUnitAddressDefaultShipping\Business\CompanyUnitAddressDefaultShippingFacadeInterface getFacade()
 * @method \Spryker\Zed\CompanyUnitAddressLabel\Communication\CompanyUnitAddressLabelCommunicationFactory getFactory()
 * @method \Spryker\Zed\CompanyUnitAddressLabel\CompanyUnitAddressLabelConfig getConfig()
 */
class DefaultShippingCompanyUnitAddressPostSavePlugin extends AbstractPlugin implements CompanyUnitAddressPostSavePluginInterface
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
    public function postSave(CompanyUnitAddressTransfer $companyUnitAddressTransfer): CompanyUnitAddressResponseTransfer
    {
        return $this->getFacade()->saveDefaultShippingAddressIdToCompanyBusinessUnit($companyUnitAddressTransfer);
    }
}
