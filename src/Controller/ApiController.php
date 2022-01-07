<?php

namespace App\Controller;
use App\Entity\People;
use App\Entity\Role;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ApiController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/api/loginCheck", name="loginCheck", methods={"GET"})
     */
    public function loginCheck(Request $request): Response
    {
        $parameter = json_decode($request->getContent(), true);
        $login = $this->em->getRepository(User::class)->login($parameter['username'],$parameter['password']);
        return $login;
    }
     /**
     * @Route("/api/postRole", name="postRole", methods={"POST"})
     */
    public function postRole(Request $request): Response
    {
        $parameter = json_decode($request->getContent(), true);
        $data = ["name"=>$parameter['name']];
        $createRole = $this->em->getRepository(Role::class)->createRole($data);
        return $createRole;
    }
     /**
     * @Route("/api/updateRole/{id}", name="updateRole", methods={"PUT"})
     */
    public function updateRole(Request $request, $id): Response
    {
        $role = $this->em->getRepository(Role::class)->find($id);
        $parameter = json_decode($request->getContent(), true);
        $data = ["name"=>$parameter['name'],"role"=>$role];
        $updateRole = $this->em->getRepository(Role::class)->updateRole($data);

        return $updateRole;  
    }

      /**
     * @Route("/api/deleteRole/{id}", name="deleteRole", methods={"DELETE"})
     */
    public function deleteRole($id): Response
    {
        $role = $this->em->getRepository(Role::class)->find($id);
        $data = ["role"=>$role];
        $updateRole = $this->em->getRepository(Role::class)->deleteRole($data);

        return $updateRole;
    }

      /**
     * @Route("/api/fetchallRole", name="fetchallRole", methods={"GET"})
     */
    public function fetchallRole(): Response
    {
        $role =$this->em->getRepository(Role::class)->findAll();
        $data= ["role"=>$role];
        $fetchallRole = $this->em->getRepository(Role::class)->fetchallRole($data);
        return $fetchallRole;
    }

     /**
     * @Route("/api/postUser", name="postUser", methods={"POST"})
     */
    public function postUser(Request $request): Response
    {
      
        $parameter = json_decode($request->getContent(), true);
        $role = $this->em->getRepository(Role::class)->find($parameter['role']);
        $data = ['username'=>$parameter['username'],
                 'password'=>$parameter['password'],
                 'role'    =>$role
                ];
        $createUser = $this->em->getRepository(User::class)->createUser($data);
        return $createUser;
    }
    
     /**
     * @Route("/api/updateUser/{id}", name="updateUser", methods={"PUT"})
     */
    public function updateUser(Request $request, $id): Response
    {
        $user = $this->em->getRepository(User::class)->find($id);
        $parameter = json_decode($request->getContent(), true);
        $role = $this->em->getRepository(Role::class)->find($parameter['role']);
        $data = ['user'    =>$user,
                'username'=>$parameter['username'],
                'password'=>$parameter['password'],
                'role'    =>$role
                ];
        $updateUser = $this->em->getRepository(User::class)->updateUser($data);
        return $updateUser;
    }

      /**
     * @Route("/api/deleteUser/{id}", name="deleteUser", methods={"DELETE"})
     */
    public function deleteUser($id): Response
    {
        $user = $this->em->getRepository(User::class)->find($id);
        $data = ['user'=>$user];
        $deleteUser = $this->em->getRepository(User::class)->deleteUser($data);
        return $deleteUser;
    }

      /**
     * @Route("/api/fetchallUser", name="fetchallUser", methods={"GET"})
     */
    public function fetchallUser(): Response
    {
        $user = $this->em->getRepository(User::class)->findAll();
        $data = ['user'=>$user];
        $fetchallUser = $this->em->getRepository(User::class)->fetchallUser($data);        
        return $fetchallUser;
    }
  
     /**
     * @Route("/api/postPeople", name="postPeople", methods={"POST"})
     */

    public function postPeople(Request $request): Response
    {
        $parameter = json_decode($request->getContent(), true);
        $user = $this->em->getRepository(User::class)->find($parameter['user']);
        $data = [
                'user'     =>$user,
                'firstname'=>$parameter['firstname'],
                'lastname' =>$parameter['lastname'],
                'address'  =>$parameter['address'],
                'phone'    =>$parameter['phone'],
                'document' =>$parameter['document'],
                'state'    =>$parameter['state']
               ];
        $createPeople = $this->em->getRepository(People::class)->createPeople($data);
        return  $createPeople;
    }
     /**
     * @Route("/api/updatePeople/{id}", name="updatePeople", methods={"PUT"})
     */
    public function updatePeople(Request $request, $id): Response
    {
        $people = $this->em->getRepository(People::class)->find($id);
        $parameter = json_decode($request->getContent(), true);
        $user = $this->em->getRepository(User::class)->find($parameter['user']);
        $data = [
            'people'   =>$people,
            'user'     =>$user,
            'firstname'=>$parameter['firstname'],
            'lastname' =>$parameter['lastname'],
            'address'  =>$parameter['address'],
            'phone'    =>$parameter['phone'],
            'document' =>$parameter['document'],
            'state'    =>$parameter['state']
           ];
        $updatePeople = $this->em->getRepository(People::class)->updatePeople($data);
        return  $updatePeople;
    }

      /**
     * @Route("/api/deletePeople/{id}", name="deletePeople", methods={"DELETE"})
     */
    public function deletePeople($id): Response
    {
        $people = $this->em->getRepository(People::class)->find($id);
        $data = ['people'=>$people];
        $deletePeople = $this->em->getRepository(People::class)->deletePeople($data);

        return $deletePeople;
    }

      /**
     * @Route("/api/fetchallPeople", name="fetchallPeople", methods={"GET"})
     */
    public function fetchallPeople(): Response
    {
        $people = $this->em->getRepository(People::class)->findAll();
        $data = ['people'=>$people];
        $fetchallPeople = $this->em->getRepository(People::class)->fetchallPeople($data);
        return  $fetchallPeople;
    }


}