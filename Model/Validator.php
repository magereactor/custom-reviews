<?php
declare(strict_types = 1);

namespace MageReactor\CustomReviews\Model;

use MageReactor\CustomReviews\Api\Data\CustomReviewsInterface;
use MageReactor\CustomReviews\Api\ValidatorInterface;

class Validator
{
    /**
     * @var ValidatorInterface[]
     */
    private array $validators;

    /**
     * @param array $validators
     */
    public function __construct(array $validators){
        $this->validators = $validators;
    }

    /**
     * @param CustomReviewsInterface $review
     * @return void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function validate(CustomReviewsInterface $review)
    {
        foreach ($this->validators as $validator) {
            $validator->validate($review);
        }
    }
}
