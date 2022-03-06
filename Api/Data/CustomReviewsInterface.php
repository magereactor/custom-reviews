<?php
namespace MageReactor\CustomReviews\Api\Data;

use Magento\Tests\NamingConvention\true\mixed;

/**
 * Represents a Review object
 *
 * @api
 */
interface CustomReviewsInterface
{
    const ID = "mr_review_id";
    const PRODUCT_ID = "product_id";
    const PARENT_ID = "parent_id";
    const SKU = "sku";
    const STATUS = "status";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    const REVIEW_DETAIL = "review_detail";

    /**
     * Set Review Id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set Product Id
     *
     * @param int $productId
     * @return $this
     */
    public function setProductId($productId);

    /**
     * Set Parent Product Id
     *
     * @param int $parentId
     * @return $this
     */
    public function setParentId($parentId);

    /**
     * Set Product Sku
     *
     * @param string $sku
     * @return $this
     */
    public function setSku($sku);

    /**
     * Set Review Status
     *
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Set Created At Time
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Set Updated At Time
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);

    /**
     * @param $reviewDetail
     * @return mixed
     */
    public function setReviewDetail($reviewDetail);

    /**
     * Get Review Id
     *
     * @return int
     */
    public function getId();

    /**
     * Get Product Id
     *
     * @return int
     */
    public function getProductId();

    /**
     * Get Parent Product Id
     *
     * @return int
     */
    public function getParentId();

    /**
     * Get Product Sku
     *
     * @return string
     */
    public function getSku();

    /**
     * Get Review Status
     *
     * @return int
     */
    public function getStatus();

    /**
     * Get Created At Time
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Get Updated At Time
     *
     * @return string
     */
    public function getUpdatedAt();

    /**
     * Get ReviewDetail
     *
     * @return mixed
     */
    public function getReviewDetail();
}
