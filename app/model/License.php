<?php
namespace rosasurfer\bfx\model;

use rosasurfer\db\orm\PersistableObject;


/**
 * Represents an account license.
 *
 * @method int getId() Return the id (primary key) of the license.
 */
class License extends PersistableObject {


    /** @var int - primary key */
    protected $id;

    /** @var string - time of creation */
    protected $created;

    /** @var string - time of last modification */
    protected $modified;


    /**
     * Return the creation time of the instance.
     *
     * @param  string $format [optional] - format as used by date($format, $timestamp)
     *
     * @return string - creation time
     */
    public function getCreated($format = 'Y-m-d H:i:s') {
        if (!isSet($this->created) || $format=='Y-m-d H:i:s')
            return $this->created;
        return date($format, strToTime($this->created));
    }


    /**
     * Return the last modification time of the instance.
     *
     * @param  string $format [optional] - format as used by date($format, $timestamp)
     *
     * @return string - last modification time
     */
    public function getModified($format = 'Y-m-d H:i:s') {
        if (!isSet($this->modified) || $format=='Y-m-d H:i:s')
            return $this->modified;
        return date($format, strToTime($this->modified));
    }


    /**
     * Update the version field as this is not yet automated by the ORM.
     *
     * {@inheritdoc}
     */
    protected function beforeUpdate() {
        $this->modified = date('Y-m-d H:i:s');
        return true;
    }
}
