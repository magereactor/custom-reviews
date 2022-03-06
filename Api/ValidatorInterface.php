<?php
namespace MageReactor\CustomReviews\Api;

use Magento\Framework\Exception\NoSuchEntityException;
use MageReactor\CustomReviews\Api\Data\CustomReviewsInterface;

interface ValidatorInterface
{
    /**
     * @param CustomReviewsInterface $review
     * @return void
     * @throws NoSuchEntityException
     * @throws \InvalidArgumentException
     */
    public function validate(CustomReviewsInterface $review);
}
