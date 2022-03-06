<?php
declare(strict_types = 1);

namespace MageReactor\CustomReviews\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomReview extends AbstractDb
{
    /**
     * Main table name
     *
     * @var string
     */
    protected $_mainTable = "mr_reviews";

    /**
     * Main table primary key field name
     *
     * @var string
     */
    protected $_idFieldName = "mr_review_id";

    /**
     * @var string
     */
    private $_mrReviewsStoreTable = "mr_reviews_store";

    /**
     * @var string
     */
    private $_mrReviewDetail = "mr_review_detail";

    /**
     * {@inheritdoc }
     */
    protected function _construct()
    {
        $this->_init($this->_mainTable, $this->_idFieldName);
    }

    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        //save stores
        $this->saveStores($object);

        //save review details
        $this->saveReviewDetail($object);
        return $this;
    }

    private function saveStores($object)
    {
        if( $object->getId() && !empty($object->getStoreId())){
            $storeIds = !is_array($object->getStoreId()) ? [$object->getStoreId()] : $object->getStoreId();
            $connection = $this->getConnection();
            $condition = [
                $this->_idFieldName . '= ?' => $object->getId(),
            ];
            $connection->delete($this->_mrReviewsStoreTable, $condition);
            $condition = [
                $this->_idFieldName.'= ?' => $object->getId(),
                'store_id IN (?)' => $storeIds,
            ];
            $connection->delete($this->_mrReviewsStoreTable, $condition);
            foreach ($storeIds as $storeId) {
                $connection->insertOnDuplicate($this->_mrReviewsStoreTable,[
                    $this->_idFieldName => $object->getId(),
                    "store_id" => $storeId
                ], []);
            }
        }
    }

    private function saveReviewDetail($object)
    {
        if( $object->getId() && !empty($object->getReviewDetail())){
            $connection = $this->getConnection();
            $storeIds = !is_array($object->getStoreId()) ? [$object->getStoreId()] : $object->getStoreId();
            $condition = [
                $this->_idFieldName . '= ?' => $object->getId(),
            ];
            $connection->delete($this->_mrReviewDetail, $condition);
            $condition = [
                $this->_idFieldName.'= ?' => $object->getId(),
                'store_id IN (?)' => $storeIds,
            ];
            $connection->delete($this->_mrReviewDetail, $condition);
            foreach ($storeIds as $storeId) {
                $connection->insertOnDuplicate($this->_mrReviewDetail,[
                    $this->_idFieldName => $object->getId(),
                    "store_id" => $storeId,
                    "title" => isset($object->getReviewDetail()["title"]) ? $object->getReviewDetail()["title"]:null,
                    "name" => isset($object->getReviewDetail()["name"]) ? $object->getReviewDetail()["name"]:null,
                    "detail" => isset($object->getReviewDetail()["detail"]) ? $object->getReviewDetail()["detail"]:null,
                ], []);
            }
        }
    }

}
