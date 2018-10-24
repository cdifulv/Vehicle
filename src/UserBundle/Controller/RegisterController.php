<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Model\User;
use UserBundle\Form\RegisterFormType;
Use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     * @Template
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new RegisterFormType(), $user);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $user = $form->getData();

            $user->setPassword(
                $this->encodePassword($user, $user->getPlainPassword())
            );

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Welcome to the Car Repository');

            $this->authenticateUser($user);
            $url = $this->generateUrl('Vehicle');

            return $this->redirect($url);
        }
        return array('form' => $form->createView());
    }

    private function encodePassword(User $user, $plainPassword)
    {
        $encoder = $this->container->get('security.encoder_factory')
            ->getEncoder($user);

        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }

    private function authenticateUser(User $user)
    {
        $providerKey = 'secured_area';
        $token = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());

        $this->container->get('security.context')->setToken($token);
    }
}
