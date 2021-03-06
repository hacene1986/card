<?php

namespace App\Repository;

use App\Entity\Card;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Card|null find($id, $lockMode = null, $lockVersion = null)
 * @method Card|null findOneBy(array $criteria, array $orderBy = null)
 * @method Card[]    findAll()
 * @method Card[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Card::class);
    }

    public function findAllAssoc()
      {
        $conn = $this->getEntityManager()->getConnection();
        $sql =
        'SELECT
          card.id,
          card.image,
          card.title,
          card.body,
          card.edition,
          card.rarity,
          card.artist
          FROM card
        ';
        $query = $conn->prepare($sql);
        $query->execute();
        return $query->fetchAll();
      }
}
