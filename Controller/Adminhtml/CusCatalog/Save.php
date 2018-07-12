<?php

namespace MyCompany\ExampleAdminNewPage\Controller\Adminhtml\CusCatalog;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

class Save extends Action {


    /**
     * @var \Magento\Catalog\Model\Product
     */
    protected $_model;


    /**
     * Save constructor.
     * @param Action\Context $context
     * @param \Magento\Catalog\Model\Product $model
     */
    public function __construct(
        Action\Context $context,
        \Magento\Catalog\Model\Product $model
    )
    {
        parent::__construct($context);
        $this->_model = $model;
    }



    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \Magento\Catalog\Model\Product $model */
            $model = $this->_model;

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }

            $data["type_id"] = "simple";
            $model->setData($data);



            $this->_eventManager->dispatch(
                'cuscatalog_product_save',
                ['product' => $model, 'request' => $this->getRequest()]
            );



            try {
                $model->save();
                $this->messageManager->addSuccess(__('Product saved'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the product'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }


}


