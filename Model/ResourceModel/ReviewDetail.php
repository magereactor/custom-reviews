<?php
declare(strict_types = 1);

namespace MageReactor\CustomReviews\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use MageReactor\CustomReviews\Api\Data\CustomReviewsInterface;

class ReviewDetail extends AbstractDb
{
    /**
     * Main table name
     *
     * @var string
     */
    protected $_mainTable = "mr_review_detail";

    /**
     * Main table primary key field name
     *
     * @var string
     */
    protected $_idFieldName = "mr_review_detail_id";

    /**
     * {@inheritdoc }
     */
    protected function _construct()
    {
        $this->_init($this->_mainTable, $this->_idFieldName);
    }

    public function loadByReview(CustomReviewsInterface $review)
    {
        $review = $this->load($this, $review->getId(), "mr_review_id");
        echo $review->getId();
        exit;
    }
}
