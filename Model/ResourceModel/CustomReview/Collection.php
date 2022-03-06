<?php
declare(strict_types = 1);

namespace MageReactor\CustomReviews\Model\ResourceModel\CustomReview;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use MageReactor\CustomReviews\Model\CustomReview;
use MageReactor\CustomReviews\Model\ResourceModel\CustomReview as CustomReviewResource;

class Collection extends AbstractCollection
{
    /**
     * Model name
     *
     * @var string
     */
    protected $_model = CustomReview::class;

    /**
     * Resource model name
     *
     * @var string
     */
    protected $_resourceModel = CustomReviewResource::class;
}
