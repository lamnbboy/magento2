<?php
namespace Cowell\Training\Model;

use Cowell\Training\Api\Data\StudentInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Student extends \Magento\Framework\Model\AbstractModel implements StudentInterface, IdentityInterface{

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'training_student';

    /**
     * @var string
     */
    protected $_cacheTag = 'training_student';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'training_student';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Cowell\Training\Model\ResourceModel\Student');
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
        return $this->_getResource()->checkSlug($slug);
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::STUDENT_ID);
    }

    /**
     * Get Slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->getData(self::SLUG);
    }

    /**
     * Get Name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Get Gender
     *
     * @return int|null
     */
    public function getGender()
    {
        return $this->getData(self::GENDER);
    }

    /**
     * Get Dob
     *
     * @return string|null
     */
    public function getDob()
    {
        return $this->getData(self::DOB);
    }

    /**
     * Get Address
     *
     * @return string|null
     */
    public function getAddress()
    {
        return $this->getData(self::ADDRESS);
    }

    /**
     * Get Email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Get created at
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Get Updated At
     *
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return \Ashsmith\Blog\Api\Data\PostInterface
     */
    public function setId($id)
    {
        return $this->setData(self::STUDENT_ID, $id);
    }

    /**
     * Set Slug
     *
     * @param string $slug
     * @return \Cowell\Training\Api\Data\StudentInterface
     */
    public function setSlug($slug)
    {
        return $this->setData(self::SLUG, $slug);
    }

    /**
     * Set Name
     *
     * @param string $name
     * @return \Cowell\Training\Api\Data\StudentInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set gender
     *
     * @param int|bool $gender
     * @return \Cowell\Training\Api\Data\StudentInterface
     */
    public function setGender($gender)
    {
        return $this->setData(self::GENDER, $gender);
    }

    /**
     * Set Dob
     *
     * @param string $dob
     * @return \Cowell\Training\Api\Data\StudentInterface
     */
    public function setDob($dob)
    {
        return $this->setData(self::DOB, $dob);
    }

    /**
     * Set Address
     *
     * @param string $address
     * @return \Cowell\Training\Api\Data\StudentInterface
     */
    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS, $address);
    }

    /**
     * Set Email
     *
     * @param string $email
     * @return \Cowell\Training\Api\Data\StudentInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Set Created At
     *
     * @param string $createdAt
     * @return \Cowell\Training\Api\Data\StudentInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Set Updated At
     *
     * @param string $updatedAt
     * @return \Cowell\Training\Api\Data\StudentInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}