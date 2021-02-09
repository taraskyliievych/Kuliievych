<?php
declare(strict_types=1);

namespace Kuliievych\PriceRequest\Controller\Adminhtml;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Registry;

abstract class PriceRequest extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Kuliievych_PriceRequest::top_level';
    protected $_coreRegistry;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param Page $resultPage
     * @return Page
     */
    public function initPage(Page $resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Kuliievych'), __('Kuliievych'))
            ->addBreadcrumb(__('Pricerequest'), __('Pricerequest'));

        return $resultPage;
    }
}
