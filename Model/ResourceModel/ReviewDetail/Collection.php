<?php
declare(strict_types = 1);

namespace MageReactor\CustomReviews\Model\ResourceModel\ReviewDetail;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use MageReactor\CustomReviews\Model\ReviewDetail;
use MageReactor\CustomReviews\Model\ResourceModel\ReviewDetail as ReviewDetailResource;

class Collection extends AbstractCollection
{
    /**
     * Model name
     *
     * @var string
     */
    protected $_model = ReviewDetail::class;

    /**
     * Resource model name
     *
     * @var string
     */
    protected $_resourceModel = ReviewDetailResource::class;
}
