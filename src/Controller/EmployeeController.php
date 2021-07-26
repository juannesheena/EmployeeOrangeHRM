<?php 
namespace App\Controller;

use App\Entity\Employee;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Controller\console;

class EmployeeController extends AbstractController{
    /**
     * @Route("/")
     * @Method({"GET"})
    */
    public function index(){
       
        // check if the user is authenticated first
        // returns the User object, or null if the user is not authenticated
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $employeeId = $user->getEmployee()->getId();
        $employee= $this->getDoctrine()->getRepository(Employee::class)->find($employeeId);

        return $this->render('Employee/index.html.twig',
        array('firstname'=>$employee->getFirstname(),'lastname'=>$employee->getLastname(),'address'=>$employee->getAddress()));
    }

    
}
