<?php
namespace Cowell\Training\Api\Data;

/**
 * Interface StudentInterface
 * @package Cowell\Training\Api\Data
 */
interface StudentInterface
{
    /**
     * Constants used as data array keys
     */
    const STUDENT_ID           = 'student_id';
    const SLUG              = 'slug';
    const NAME              = 'name';
    const GENDER              = 'gender';
    const DOB              = 'dob';
    const ADDRESS              = 'address';
    const EMAIL              = 'email';
    const UPDATED_AT        = 'updated_at';
    const CREATED_AT        = 'created_at';

    const ATTRIBUTES = [
        self::STUDENT_ID,
        self::SLUG,
        self::NAME,
        self::GENDER,
        self::DOB,
        self::ADDRESS,
        self::EMAIL
    ];

    /**
     * Get Student id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set Student id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setId($id);

    /**
     * Get Student Name
     *
     * @return string/null
     */
    public function getName();

    /**
     * Set Student Name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name);

    /**
     * Get Student Slug
     *
     * @return string/null
     */
    public function getSlug();

    /**
     * Set Student Slug
     *
     * @param string $slug
     *
     * @return $this
     */
    public function setSlug($slug);

    /**
     * Get Student Gender
     *
     * @return int/null
     */
    public function getGender();

    /**
     * Set Student Gender
     *
     * @param int $gender
     *
     * @return $this
     */
    public function setGender($gender);

    /**
     * Get Student Dob
     *
     * @return string/null
     */
    public function getDob();

    /**
     * Set Student Dob
     *
     * @param string $dob
     *
     * @return $this
     */
    public function setDob($dob);

    /**
     * Get Student Addresss
     *
     * @return string/null
     */
    public function getAddress();

    /**
     * Set Student Address
     *
     * @param string $address
     *
     * @return $this
     */
    public function setAddress($address);

    /**
     * Get Student Email
     *
     * @return string/null
     */
    public function getEmail();

    /**
     * Set Student Email
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email);

    /**
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * @param string $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Get Student updated date
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set Student updated date
     *
     * @param string $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt($updatedAt);
}