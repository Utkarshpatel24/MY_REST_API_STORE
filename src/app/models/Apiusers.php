<?php

use Phalcon\Mvc\Model;
use MongoDB\BSON\ObjectId;
class Apiusers extends Model
{
    public $collection;
    public function initialize()
    {
        $this->collection = $this->di->get("mongo");
        
        $this->collection = $this->collection->store->apiusers;

    }
    public function insert($productData)
    {

        $insert = $this->collection->insertOne($productData);
            
    }
}