<?php

namespace App\Traits;

trait secureDelete {
    
    public function secureDelete($relations)
    {
        $hasRelation = false;
        
        foreach ($relations as $relation) {
            if ($this->$relation()->count() > 0) {
                $hasRelation = true;
                break;
            }
        }
        
        return $hasRelation;
    }
    
}   