<?php

namespace MyCompany\ExampleAdminNewPage\Controller\Adminhtml\CusCatalog;
use Magento\Backend\App\Action\Context;
use Magento\Catalog\Api\ProductRepositoryInterface;

class MassRemove extends  \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * Field id
     */
    const ID_FIELD = 'entity_id';

    /**
     * Redirect url
     */
    const REDIRECT_URL = '*/*/';

    /**
     * Resource collection
     *
     * @var string
     */
    protected $collection = 'MyCompany\ExampleAdminNewPage\Model\ResourceModel\CusCatalog\Collection';

    /**
     * Model
     *
     * @var string
     */
    protected $model = '\Magento\Catalog\Model\Product';


    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;


    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository = null
    ) {
        $this->productRepository = $productRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->create(ProductRepositoryInterface::class);

        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {

        $itemCount = count( $this->getRequest()->getParam('selected'));
        $this->messageManager->addSuccessMessage($itemCount . " product(s) has been removed ");
        return $this->getDefaultResult();
    }

    /**
     * {@inheritdoc}
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function getDefaultResult()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $itemsToremove = $this->getRequest()->getParam('selected');
        foreach ($itemsToremove  as $itemId){
            $product = $this->productRepository->getById($itemId);
            $this->productRepository->delete($product);
        }

        return $resultRedirect->setPath(static::REDIRECT_URL);
    }

}
