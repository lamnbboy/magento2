<?php
namespace Cowell\Training\Model\ResourceModel;

/**
 * Training student mysql resource
 */
class Student extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * Construct
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param string|null $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
        $this->_date = $date;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('cowell_training_student', 'student_id');
    }

    /**
     * Process student data before saving
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {

        if (!$this->isValidStudentSlug($object)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('The student Slug contains capital letters or disallowed symbols.')
            );
        }

        if ($this->isNumericStudentSlug($object)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('The student Slug cannot be made of only numbers.')
            );
        }

        if ($object->isObjectNew() && !$object->hasCreationTime()) {
            $object->setCreationTime($this->_date->gmtDate());
        }

        $object->setUpdateTime($this->_date->gmtDate());

        return parent::_beforeSave($object);
    }

    /**
     * Load an object using 'slug' field if there's no field specified and value is not numeric
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @param mixed $value
     * @param string $field
     * @return $this
     */
    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        if (!is_numeric($value) && is_null($field)) {
            $field = 'slug';
        }

        return parent::load($object, $value, $field);
    }

    /**
     * Retrieve load select with filter by slug and activity
     *
     * @param string $slug
     * @return \Magento\Framework\DB\Select
     */
    protected function _getLoadBySlugSelect($slug)
    {
        $select = $this->getConnection()->select()->from(
            ['bp' => $this->getMainTable()]
        )->where(
            'bp.slug = ?',
            $slug
        );

        return $select;
    }

    /**
     *  Check whether student slug is numeric
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return bool
     */
    protected function isNumericStudentSlug(\Magento\Framework\Model\AbstractModel $object)
    {
        return preg_match('/^[0-9]+$/', $object->getData('slug'));
    }

    /**
     *  Check whether student slug is valid
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return bool
     */
    protected function isValidStudentSlug(\Magento\Framework\Model\AbstractModel $object)
    {
        return preg_match('/^[a-z0-9][a-z0-9_\/-]+(\.[a-z0-9_-]+)?$/', $object->getData('slug'));
    }

    /**
     * Check if student slug exists
     * return student id if student exists
     *
     * @param string $slug
     * @return int
     */
    public function checkSlug($slug)
    {
        $select = $this->_getLoadBySlugSelect($slug);
        $select->reset(\Zend_Db_Select::COLUMNS)->columns('bp.student_id')->limit(1);

        return $this->getConnection()->fetchOne($select);
    }
}