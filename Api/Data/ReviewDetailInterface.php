<?php
namespace MageReactor\CustomReviews\Api\Data;


/**
 * Represents a ReviewDetail object
 *
 * @api
 */
interface ReviewDetailInterface
{
    const DETAIL_ID = "mr_review_detail_id";
    const REVIEW_ID = "mr_review_id";
    const STORE_ID = "store_id";
    const TITLE = "title";
    const DETAIL = "detail";
    const NAME = "name";

    /**
     * @param int $detailId
     * @return $this
     */
    public function setId($detailId);

    /**
     * @param int $reviewId
     * @return $this
     */
    public function setReviewId($reviewId);

    /**
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($storeId);

    /**
     * @param int $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * @param int $detail
     * @return $this
     */
    public function setDetail($detail);

    /**
     * @param int $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return int
     */
    public function getId();

    /**
     * @return int
     */
    public function getReviewId();

    /**
     * @return int
     */
    public function getStoreId();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getDetail();

    /**
     * @return string
     */
    public function getName();
}
