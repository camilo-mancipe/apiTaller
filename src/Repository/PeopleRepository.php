<?php

namespace App\Repository;

use App\Entity\People;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method People|null find($id, $lockMode = null, $lockVersion = null)
 * @method People|null findOneBy(array $criteria, array $orderBy = null)
 * @method People[]    findAll()
 * @method People[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeopleRepository extends ServiceEntityRepository
{
    private $em;

    public function __construct(ManagerRegistry $registry,EntityManagerInterface $em)
    {
        parent::__construct($registry, People::class);
        $this->em = $em;
    }

    public function createPeople(array $data){

        extract($data);
        $people = new People();
        $people->setUsers($data['user']);
        $people->setFirstName($data['firstname']);
        $people->setLastName($data['lastname']);
        $people->setAddress($data['address']);
        $people->setPhone($data['phone']);
        $people->setDocument($data['document']);
        $people->setState($data['state']);
        $this->em->persist($people);
        $this->em->flush();
        return  new JsonResponse('inserted Succesfully!!');
    }
    public function updatePeople(array $data){

        extract($data);
        $data['people']->setUsers($data['user']);
        $data['people']->setFirstName($data['firstname']);
        $data['people']->setLastName($data['lastname']);
        $data['people']->setAddress($data['address']);
        $data['people']->setPhone($data['phone']);
        $data['people']->setDocument($data['document']);
        $data['people']->setState($data['state']);
        $this->em->persist($data['people']);
        $this->em->flush();
        return  new JsonResponse('updated Succesfully!!');
    }
    public function deletePeople(array $data){

        extract($data);
        $this->em->remove($data['people']);
        $this->em->flush();
        return  new JsonResponse('deleted Succesfully!!');
    }
    public function fetchallPeople(array $data)
    {
        extract($data);
        foreach ($data['people'] as $u) {
            $res[] = [
                'id'        => $u->getId(),
                'firts_name'=> $u->getFirstName(),
                'last_name' => $u->getLastName(),
                'addres'    => $u->getAddress(),
                'phone'     => $u->getPhone(),
                'document'  => $u->getDocument(),
                'state'     => $u->getState()
            ];
        }
        return  new JsonResponse($res);
    }

}
