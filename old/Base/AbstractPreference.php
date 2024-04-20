<?php

namespace Base;

abstract class AbstractPreference
{
    protected string $id;


    function __construct(array $data)
    {
        $this->id = $data['id'];
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id
        ];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
