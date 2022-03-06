<?php
namespace MageReactor\CustomReviews\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_Cms::page';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;


    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ){
        parent::__construct($context);
        $this->resultPageFactory = $pageFactory;
    }

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magento_Cms::cms_page');
        $resultPage->addBreadcrumb(__('Custom Reviews'), __('Custom Reviews'));
        $resultPage->addBreadcrumb(__('Manage Reviews'), __('Manage Reviews'));
        $resultPage->getConfig()->getTitle()->prepend(__('MR Custom Reviews'));

        return $resultPage;
    }
}
