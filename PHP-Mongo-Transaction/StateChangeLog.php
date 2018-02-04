<?php


namespace PHP_Mongo_Transaction;


use MongoDB\Model\BSONDocument;

// TODO: to be MongoDB\BSON\Persistable
class StateChangeLog
{
    const TYPE_INSERT = 'insert';
    const TYPE_UPDATE = 'update';
    const TYPE_DELETE = 'delete';

    /**
     * @var string
     */
    private $databaseName;

    /**
     * @var string
     */
    private $collectionName;

    /**
     * @var string
     */
    private $type;

    /**
     * @var BSONDocument|null
     */
    private $stateBefore;

    /**
     * @var BSONDocument|null
     */
    private $stateAfter;

    /**
     * StateChangeLog constructor.
     *
     * @param string $databaseName
     * @param string $collectionName
     * @param string $type
     */
    public function __construct(string $databaseName, string $collectionName, string $type)
    {
        $this->databaseName   = $databaseName;
        $this->collectionName = $collectionName;
        $this->type           = $type;
    }

    /**
     * @return string
     */
    public function getDatabaseName(): string
    {
        return $this->databaseName;
    }

    /**
     * @return string
     */
    public function getCollectionName(): string
    {
        return $this->collectionName;
    }


    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * @return BSONDocument|null
     */
    public function getStateAfter()
    {
        return $this->stateAfter;
    }

    /**
     * @return BSONDocument|null
     */
    public function getStateBefore()
    {
        return $this->stateBefore;
    }

    /**
     * @param BSONDocument $stateAfter
     */
    public function setStateAfter($stateAfter)
    {
        if ($this->type === self::TYPE_DELETE) {
            return;
        }
        $this->stateAfter = $stateAfter;
    }

    /**
     * @param BSONDocument $stateBefore
     */
    public function setStateBefore($stateBefore)
    {
        if ($this->type === self::TYPE_INSERT) {
            return;
        }
        $this->stateBefore = $stateBefore;
    }
}