<?php
declare(strict_types = 1);

namespace MageReactor\CustomReviews\Api;

use MageReactor\CustomReviews\Api\Data\CustomReviewsInterface;

/**
 * Reviews Management Interface
 *
 * @api
 */
interface CustomReviewsManagementInterface
{
    /**
     * Save block.
     *
     * @param CustomReviewsInterface $block
     * @return CustomReviewsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(CustomReviewsInterface $review);

    /**
     * Retrieve review.
     *
     * @param string $reviewId
     * @return CustomReviewsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($reviewId);
}
