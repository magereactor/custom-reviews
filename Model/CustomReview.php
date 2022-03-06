<?php
declare(strict_types = 1);

namespace MageReactor\CustomReviews\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Model\AbstractModel;
use MageReactor\CustomReviews\Model\ResourceModel\CustomReview as CustomReviewResource;
use Magento\Framework\DataObject\IdentityInterface;
use MageReactor\CustomReviews\Api\Data\CustomReviewsInterface;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;

/**
 * MageReactor CustomReview model
 */
class CustomReview extends AbstractModel implements IdentityInterface, CustomReviewsInterface
{
    const TYPE_CODE = "simple";

    /**
     * CustomReviews Cache Tag
     */
    const CACHE_TAG = 'mr_reviews_';

    /**
     * @var string
     */
    protected $_eventObject = 'mr_reviews_';

    /**
     * @var string
     */
    protected $_eventPrefix = 'mr_reviews_';

    /**
     * @var string
     */
    protected $_idFieldName = 'mr_review_id';

    /**
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * @var string
     */
    protected $_resourceName = CustomReviewResource::class;

    /**
     * @var Validator
     */
    private Validator $validator;

    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;

    /**
     * @var Configurable
     */
    private Configurable $configurable;

    /**
     * @var ReviewDetail
     */
    private ReviewDetail $reviewDetail;

    /**
     * @param ReviewDetail $reviewDetail
     * @param Validator $validator
     * @param ProductRepositoryInterface $productRepository
     * @param Configurable $configurable
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        ReviewDetail $reviewDetail,
        Validator $validator,
        ProductRepositoryInterface $productRepository,
        Configurable $configurable,
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ){
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
        $this->validator = $validator;
        $this->productRepository = $productRepository;
        $this->configurable = $configurable;
        $this->reviewDetail = $reviewDetail;
    }

    /**
     * Construct
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init($this->_resourceName);
    }

    /**
     * {@inheritdoc }
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG."_".$this->getId()];
    }

    /**
     * Receive custom review store ids
     *
     * @return int[]
     */
    public function getStores(): array
    {
        return $this->hasData('stores') ? $this->getData('stores') : $this->getData('store_id');
    }

    /**
     * {@inheritdoc }
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * {@inheritdoc }
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * {@inheritdoc }
     */
    public function setParentId($parentId)
    {
        return $this->setData(self::PARENT_ID, $parentId);
    }

    /**
     * {@inheritdoc }
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * {@inheritdoc }
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * {@inheritdoc }
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * {@inheritdoc }
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * {@inheritdoc }
     */
    public function setReviewDetail($reviewDetail)
    {
        return $this->setData(self::REVIEW_DETAIL, $reviewDetail);
    }

    /**
     * {@inheritdoc }
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * {@inheritdoc }
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * {@inheritdoc }
     */
    public function getParentId()
    {
        return $this->getData(self::PARENT_ID);
    }

    /**
     * {@inheritdoc }
     */
    public function getSku()
    {
        return $this->getData(self::SKU);
    }

    /**
     * {@inheritdoc }
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * {@inheritdoc }
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * {@inheritdoc }
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * {@inheritdoc }
     */
    public function getReviewDetail()
    {
        return $this->getData(self::REVIEW_DETAIL);
    }

    /**
     * @return $this|CustomReview
     * @throws NoSuchEntityException
     */
    public function beforeSave()
    {
        $this->validator->validate($this);
        return $this->prepareDataBeforeSave($this);
    }

    protected function _afterLoad()
    {
        if($this->getId()) {
            $this->prepareDataAfterLoad();
        }
        return parent::_afterLoad();
    }

    private function prepareDataAfterLoad()
    {
        $reviewDetail = $this->reviewDetail->load($this->getId(), $this->_idFieldName);
        $this->setReviewDetail(json_encode($reviewDetail->toArray()));
        return $this;
    }

    /**
     * @param CustomReviewsInterface $review
     * @return $this
     * @throws NoSuchEntityException
     */
    private function prepareDataBeforeSave(CustomReviewsInterface $review): CustomReview
    {
        $product = $this->productRepository->get($review->getSku());
        $review->setProductId($product->getId());
        if($product->getTypeId() === Configurable::TYPE_CODE) {
            $review->setParentId($product->getId());
        }

        if($product->getTypeId() === self::TYPE_CODE) {
            $parentIds = $this->configurable->getParentIdsByChild($product->getId());
            $review->setParentId((count($parentIds) > 0) ? $parentIds[0]: $product->getId());
        }
        return $this;
    }
}
