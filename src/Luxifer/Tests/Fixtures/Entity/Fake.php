<?php

namespace Luxifer\Tests\Fixtures\Entity;

/**
 * @Entity
 * @Table(name="some_fake")
 */
class Fake
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    public $id;

    /**
     * @Column(type="date", nullable=false)
     */
    public $somedate;

    public function getId()
    {
        return $this->id;
    }

    public function getSomedate()
    {
        return $this->somedate;
    }
}
