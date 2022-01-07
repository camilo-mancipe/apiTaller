<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    private $em;
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $em)
    {
        parent::__construct($registry, User::class);
        $this->em = $em;
    }

   
    public function login($username,$password)
    {
        $result = $this->createQueryBuilder('u')
            ->Where('u.username = :username')
            ->andWhere('u.password = :password')
            ->setParameters(["username"=>"$username","password"=>"$password"])
            ->getQuery()
            ->getResult();

        if ($result) {
            return  new JsonResponse('Login Succesfully!!');
        }
        return new JsonResponse('Login Error!!');
       
    }
    public function createUser(array $data)
    {
        extract($data);
        $user = new User();
        $user->setUsername($data['username']);
        $user->setPassword($data['password']);
        $user->setRole($data['role']);
        $this->em->persist($user);
        $this->em->flush();

        return  new JsonResponse('inserted Succesfully!!');
    }

    public function updateUser(array $data)
    {
        extract($data);
       
        $data['user']->setUsername($data['username']);
        $data['user']->setPassword($data['password']);
        $data['user']->setRole($data['role']);
        $this->em->persist($data['user']);
        $this->em->flush();

        return  new JsonResponse('updated Succesfully!!');
    }

    public function deleteUser(array $data)
    {
        extract($data);
        $this->em->remove($data['user']);
        $this->em->flush();

        return  new JsonResponse('deleted Succesfully!!');
    }
    
    public function fetchallUser(array $data)
    {
        extract($data);
        foreach ($data['user'] as $u) {
            $res[] = [
                'id'      => $u->getId(),
                'username'=> $u->getUsername(),
                'password'=> $u->getPassword()
            ];
        }

        return  new JsonResponse($res);
    }

}
