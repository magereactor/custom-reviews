#Overview
MageReactor CustomReviews Module. Retrieve reviews based on product's SKU.

###Module Allow

* Save Review
* Get Review By Review ID

| Resource       | Method | Description                         |
|----------------|--------|-------------------------------------|
| /V2/review     | POST   | Method to save Review               |
| /V2/review/:id | GET    | Method to retrieve one review by id |

###Compatiblity
Currently, this module is compatible with Magento 2.4.x


##Install

####Composer

```bash
composer require magereactor/custom-reviews
```

####Enable Module

The package comes with the MageReactor_Base module. This Base module contains necessary configurations for all MageReactor's extensions

```php
php bin/magento module:enable MageReactor_Base
php bin/magento module:enable MageReactor_CustomReviews
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy -f | php bin/magento setup:static-content:deploy
```

You may need to Flush Magento Cache after installation.

####Save Review
/V2/review

#####Body
```json
{
    "review": {
        "sku": "MJ04",
        "status": 1,
        "review_detail": {
            "mr_review_id": null,
            "title": "Review Title",
            "detail": "Review Detail",
            "name": "Guest Name"
        }
    }
}
```

####Get Review
/V2/review/:reviewId

#####Response
```json
{
    "id": 27,
    "product_id": 302,
    "parent_id": 302,
    "sku": "MJ04",
    "status": 1,
    "created_at": "2022-03-06 17:57:19",
    "updated_at": "2022-03-06 17:57:19",
    "review_detail": "{\"mr_review_detail_id\":\"4\",\"mr_review_id\":\"27\",\"store_id\":\"1\",\"title\":\"Review Title\",\"detail\":\"Review Detail\",\"name\":\"Guest Name\"}"
}
```
