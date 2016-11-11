<?php
/**
 * Cards Manager
 */
namespace PinboardBundle\Manager;
use Doctrine\ORM\EntityManager;

/**
 * Class CardsManager
 *
 * Here is where all the Cards logic will be put (ex. Cards CRUD, Cards database find, etc )
 *
 * @package PinboardBundle\Manager
 */
class CardsManager
{
    /**
     * Entity Manager
     *
     * @var EntityManager
     */
    protected $em;

    /**
     * CardsManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * We do exactly the same we did inside the controller, using the CardRepository class, but now is incapsulated in a class where
     * all the application business logic is supposed to be ( and can be tested )
     *
     * @param string $sort
     * @return array
     */
    public function getCards($sort = 'ASC')
    {
        return $this->em->getRepository('PinboardBundle:Card')
            ->getActiveCards($sort);
    }
}