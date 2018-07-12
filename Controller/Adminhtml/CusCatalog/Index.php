<?php
namespace MyCompany\ExampleAdminNewPage\Controller\Adminhtml\CusCatalog;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;
    protected $context;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->context = $context;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        $resultPage->getConfig()->getTitle()->prepend((__('Custom Catalog ')));



        return $resultPage;
    }
}