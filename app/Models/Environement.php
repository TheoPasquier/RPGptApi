<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Environment\Environment;

class Environement extends Model
{
    use HasFactory;

    public $id;
    public $environement;

    public function __construct(int $id, string $environement)
    {
        $this->setId($id)
        -> setEnvironement($environement);
    
    }

    /**
     * Get the value of environement
     */ 
    public function getEnvironement()
    {
        return $this->environement;
    }

    /**
     * Set the value of environement
     *
     * @return  self
     */ 
    public function setEnvironement($environement)
    {
        $this->environement = $environement;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
