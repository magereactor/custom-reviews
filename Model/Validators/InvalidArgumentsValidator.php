<?php
declare(strict_types = 1);

namespace MageReactor\CustomReviews\Model\Validators;

use MageReactor\CustomReviews\Api\Data\CustomReviewsInterface;
use MageReactor\CustomReviews\Api\ValidatorInterface;


class InvalidArgumentsValidator implements ValidatorInterface
{
    /**
     * {@inheritdoc }
     */
    public function validate(CustomReviewsInterface $review)
    {
        if(!empty($review->getParentId())) {
            throw new \InvalidArgumentException("Invalid argument \"parent_id\"");
        }

        if(!empty($review->getProductId())) {
            throw new \InvalidArgumentException("Invalid argument \"product_id\"");
        }
    }
}
