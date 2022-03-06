<?php
declare(strict_types = 1);

namespace MageReactor\CustomReviews\Model;

use Magento\Framework\Model\AbstractModel;
use MageReactor\CustomReviews\Model\ResourceModel\ReviewDetail as ReviewDetailResource;
use Magento\Framework\DataObject\IdentityInterface;
use MageReactor\CustomReviews\Api\Data\ReviewDetailInterface;

class ReviewDetail extends AbstractModel implements IdentityInterface, ReviewDetailInterface
{
    /**
     * ReviewDetail Cache Tag
     */
    const CACHE_TAG = 'mr_reviews_detail_';

    /**
     * @var string
     */
    protected $_eventObject = 'mr_reviews_detail_';

    /**
     * @var string
     */
    protected $_idFieldName = 'mr_review_detail_id';

    /**
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * @var string
     */
    protected $_resourceName = ReviewDetailResource::class;

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
    public function getIdentities()
    {
        return [self::CACHE_TAG."_".$this->getId()];
    }

    /**
     * {@inheritdoc }
     */
    public function setId($detailId)
    {
        return $this->setData(self::DETAIL_ID, $detailId);
    }

    /**
     * {@inheritdoc }
     */
    public function setReviewId($reviewId)
    {
        return $this->setData(self::REVIEW_ID, $reviewId);
    }

    /**
     * {@inheritdoc }
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * {@inheritdoc }
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * {@inheritdoc }
     */
    public function setDetail($detail)
    {
        return $this->setData(self::DETAIL, $detail);
    }

    /**
     * {@inheritdoc }
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * {@inheritdoc }
     */
    public function getId()
    {
        return $this->getData(self::DETAIL_ID);
    }

    /**
     * {@inheritdoc }
     */
    public function getReviewId()
    {
        return $this->getData(self::REVIEW_ID);
    }

    /**
     * {@inheritdoc }
     */
    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * {@inheritdoc }
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * {@inheritdoc }
     */
    public function getDetail()
    {
        return $this->getData(self::DETAIL);
    }

    /**
     * {@inheritdoc }
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }
}
