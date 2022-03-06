<?php
declare(strict_types = 1);

namespace MageReactor\CustomReviews\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use MageReactor\CustomReviews\Api\CustomReviewsManagementInterface;
use MageReactor\CustomReviews\Api\Data\CustomReviewsInterface;
use Magento\Framework\EntityManager\HydratorInterface;
use Magento\Store\Model\StoreManagerInterface;
use MageReactor\CustomReviews\Model\ResourceModel\CustomReview as CustomReviewResource;
use Magento\Framework\App\ObjectManager;

class CustomReviewsManagement implements CustomReviewsManagementInterface
{
    /**
     * @var CustomReviewResource
     */
    private CustomReviewResource $resource;

    /**
     * @var CustomReviewFactory
     */
    private CustomReviewFactory $reviewFactory;

    /**
     * @var StoreManagerInterface
     */
    private StoreManagerInterface $storeManager;

    /**
     * @var HydratorInterface
     */
    private HydratorInterface $hydrator;

    public function __construct(
        CustomReviewResource $resource,
        CustomReviewFactory $reviewFactory,
        HydratorInterface $hydrator,
        StoreManagerInterface $storeManager
    ){
        $this->resource = $resource;
        $this->reviewFactory = $reviewFactory;
        $this->hydrator = $hydrator ?? ObjectManager::getInstance()->get(HydratorInterface::class);
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc }
     */
    public function save(CustomReviewsInterface $review)
    {
        if (empty($review->getStoreId())) {
            $review->setStoreId($this->storeManager->getStore()->getId());
        }

        if($review->getId() && $review instanceof CustomReview && !$review->getOrigData()) {
            $review = $this->hydrator->hydrate($this->getById($review->getId()), $this->hydrator->extract($review));
        }

        try {
            $this->resource->save($review);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $review;
    }

    /**
     * {@inheritdoc }
     */
    public function getById($reviewId)
    {
        $review = $this->reviewFactory->create();
        $this->resource->load($review, $reviewId);
        if (!$review->getId()) {
            throw new NoSuchEntityException(__('This review no longer exist.'));
        }
        return $review;
    }
}
