<?php

namespace Jone\BlogBundle\Entity;
use Doctrine\ORM\EntityRepository;    

class PropertyRepository extends EntityRepository
{
	public function findLatestPropertybyId()
	{
		return $this->getEntityManager()
		->createQuery('SELECT p.propertyName,MAX(p.datePublished),p.propertyImage,p.slug FROM JoneBlogBundle:Property p')
		->getResult();
	}
}
?>  
