<?php

namespace Renz\ModelBundle\Entity;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
	public function findAll()
	{
		return $this->findBy(array(), array('id' => 'DESC'));
	}
}