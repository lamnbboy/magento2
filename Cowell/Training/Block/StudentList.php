<?php
namespace Cowell\Training\Block;

use Cowell\Training\Api\Data\StudentInterface;
use Cowell\Training\Model\ResourceModel\Student\Collection as StudentCollection;

class StudentList extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{
    /**
     * @var \Cowell\Training\Model\ResourceModel\Student\CollectionFactory
     */
    protected $_studentCollectionFactory;

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Cowell\Training\Model\ResourceModel\Student\CollectionFactory $studentCollectionFactory,
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Cowell\Training\Model\ResourceModel\Student\CollectionFactory $studentCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_studentCollectionFactory = $studentCollectionFactory;
    }

     /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        /** @var \Magento\Theme\Block\Html\Pager */
        $pager = $this->getLayout()->createBlock(
           'Magento\Theme\Block\Html\Pager',
           'training.student.list.pager'
        );
        $pager->setLimit(2)
            ->setShowAmounts(false)
            ->setCollection($this->getStudents());
        $this->setChild('pager', $pager);
        return $this;
    }

   /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @return \Cowell\Training\Model\ResourceModel\Student\Collection
     */
    public function getStudents()
    {
        // Check if students has already been defined
        // makes our block nice and re-usable! We could
        // pass the 'students' data to this block, with a collection
        // that has been filtered differently!
        if (!$this->hasData('students')) {
            $students = $this->_studentCollectionFactory->create();
            $this->setData('students', $students);
        }
        return $this->getData('students');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\Cowell\Training\Model\Student::CACHE_TAG . '_' . 'list'];
    }

}