<?php
declare(strict_types=1);

namespace Kuliievych\PriceRequest\Controller\Adminhtml\PriceRequest;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;

class Edit extends \Kuliievych\PriceRequest\Controller\Adminhtml\PriceRequest
{
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('request_id');
        $model = $this->_objectManager->create(\Kuliievych\PriceRequest\Model\PriceRequest::class);

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Pricerequest no longer exists.'));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('kuliievych_pricerequest_pricerequest', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Pricerequest') : __('New Pricerequest'),
            $id ? __('Edit Pricerequest') : __('New Pricerequest')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Pricerequests'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __(
            'Edit Pricerequest %1',
            $model->getId()
        ) : __('New Pricerequest'));

        return $resultPage;
    }
}
