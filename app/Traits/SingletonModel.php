<?php

namespace App\Traits;

trait SingletonModel
{
    protected function store($data = [])
    {
        return $this->updateOrCreate($this->singletonIdentifiableBy(), $data);
    }

    public function singletonIdentifiableBy()
    {
        return [
            $this->getKeyName() => optional($this->first())->getKey()
        ];
    }
}
