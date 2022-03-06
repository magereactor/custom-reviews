<?php
declare(strict_types = 1);

namespace MageReactor\CustomReviews\Model\Validators;

use MageReactor\CustomReviews\Api\Data\CustomReviewsInterface;
use MageReactor\CustomReviews\Api\ValidatorInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use MageReactor\CustomReviews\Model\CustomReview;

class ProductValidator implements ValidatorInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;

    /**
     * @var array
     */
    private $allowedProductTypes = [
        Configurable::TYPE_CODE,
        CustomReview::TYPE_CODE
    ];

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository
    ){
        $this->productRepository = $productRepository;
    }

    /**
     * {@inheritdoc }
     */
    public function validate(CustomReviewsInterface $review)
    {
        $product = $this->productRepository->get($review->getSku());
        if(!in_array($product->getTypeId(),$this->allowedProductTypes)) {
            throw new \InvalidArgumentException("Invalid Product Type");
        }

    }
}
