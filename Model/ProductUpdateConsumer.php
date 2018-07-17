<?php

namespace MyCompany\ExampleAdminNewPage\Model;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;

class ProductUpdateConsumer implements \Rcason\Mq\Api\ConsumerInterface
{

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository = null
    ) {
        $this->productRepository = $productRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->create(ProductRepositoryInterface::class);
    }


    /**
     * {@inheritdoc}
     */
    public function process($productToUpdate)
    {

        try {

            $productObject = json_decode($productToUpdate,true);

            $product = $this->productRepository->getById($productObject['entity_id']);

            $product->setData("vpn_number",$productObject['vpn_number']);
            $product->setData("copy_write_info",$productObject['copy_write_info']);
            $this->productRepository->save($product);
            print_r($productObject['entity_id']." has been updated ");

        } catch (NoSuchEntityException $e) {
            print_r("Entity not found");
        } catch (StateException $e) {
            print_r($e->getLogMessage());
        } catch (CouldNotSaveException $e) {
            print_r($e->getLogMessage());
        } catch (InputException $e) {
            print_r($e->getLogMessage());
        }
    }
}
