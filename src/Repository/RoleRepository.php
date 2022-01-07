<?php

namespace App\Repository;

use App\Entity\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
/**
 * @method Role|null find($id, $lockMode = null, $lockVersion = null)
 * @method Role|null findOneBy(array $criteria, array $orderBy = null)
 * @method Role[]    findAll()
 * @method Role[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleRepository extends ServiceEntityRepository
{
    private $em;

    public function __construct(ManagerRegistry $registry,EntityManagerInterface $em)
    {
        parent::__construct($registry, Role::class);
        $this->em = $em;
    }

    public function createRole(array $data){

        extract($data);
        $role = new Role();
        $role->setName($data['name']);
        $this->em->persist($role);
        $this->em->flush();

        return  new JsonResponse('inserted Succesfully!!');
    }

    public function updateRole(array $data){

        extract($data);
        $data['role']->setName($data['name']);
        $this->em->persist($data['role']);
        $this->em->flush();

        return  new JsonResponse('updated Succesfully!!');
    }

    public function deleteRole(array $data){

        extract($data);
        $this->em->remove($data['role']);
        $this->em->flush();
        return  new JsonResponse('deleted Succesfully!!');
    }
    public function fetchallRole(array $data){

        extract($data);
        foreach ($data['role'] as $u) {
            $res[] = [
                'id'      => $u->getId(),
                'name'=> $u->getName(),
            ];
        }
        return  new JsonResponse($res);
    }
}
