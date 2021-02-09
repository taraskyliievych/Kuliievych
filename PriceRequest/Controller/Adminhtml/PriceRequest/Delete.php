<?php
declare(strict_types=1);

namespace Kuliievych\PriceRequest\Controller\Adminhtml\PriceRequest;

class Delete extends \Kuliievych\PriceRequest\Controller\Adminhtml\PriceRequest
{
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('request_id');

        if ($id) {
            try {
                $model = $this->_objectManager->create(\Kuliievych\PriceRequest\Model\PriceRequest::class);
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the Pricerequest.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['request_id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find a Pricerequest to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
