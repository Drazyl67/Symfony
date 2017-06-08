<?php

namespace BDE\AppBundle\Controller;

use BDE\AppBundle\Entity\DateProposal;
use BDE\AppBundle\Entity\ActivityProposal;
use BDE\AppBundle\Entity\Activity;
use BDE\AppBundle\Entity\Picture;
use BDE\AppBundle\Entity\Inscription;
use BDE\AppBundle\Entity\Commentary;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use BDE\AppBundle\Entity\Cart;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BDE\UserBundle\Entity\User;
use BDE\AppBundle\Form\PictureType;
use BDE\AppBundle\Form\ActivityType;
use BDE\AppBundle\Form\CommentaryType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $evenementVoulu1 = 1;
        $evenementVoulu2 = 2;
        $evenementVoulu3 = 3;
        $evenementProposalVoulu1 = 1;
        $evenementProposalVoulu2 = 2;
        $evenementProposalVoulu3 = 3;
        $evenement1 = $this->getDoctrine()->getRepository('BDEAppBundle:Activity')->find($evenementVoulu1);
        $evenement2 = $this->getDoctrine()->getRepository('BDEAppBundle:Activity')->find($evenementVoulu2);
        $evenement3 = $this->getDoctrine()->getRepository('BDEAppBundle:Activity')->find($evenementVoulu3);
        $evenementProposal1 = $this->getDoctrine()->getRepository('BDEAppBundle:ActivityProposal')->find($evenementProposalVoulu1);
        $evenementProposal2 = $this->getDoctrine()->getRepository('BDEAppBundle:ActivityProposal')->find($evenementProposalVoulu2);
        $evenementProposal3 = $this->getDoctrine()->getRepository('BDEAppBundle:ActivityProposal')->find($evenementProposalVoulu3);
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
        {
            $user = $this->getUser();
            $userId = $user->getId();
            dump($userId);
            $Panier = $this->getDoctrine()->getRepository('BDEAppBundle:Cart')->findByUser($userId);
            return $this->render('BDEAppBundle:Default:accueil.html.twig', array('Panier' => $Panier, 'evenement1' => $evenement1, 'evenement2' => $evenement2, 'evenement3' => $evenement3, 'evenementProposal1' => $evenementProposal1, 'evenementProposal2' =>$evenementProposal2, 'evenementProposal3' => $evenementProposal3));            
        }
        else 
        {
            return $this->render('BDEAppBundle:Default:accueil.html.twig', array('evenement1' => $evenement1, 'evenement2' => $evenement2, 'evenement3' => $evenement3, 'evenementProposal1' => $evenementProposal1, 'evenementProposal2' => $evenementProposal2, 'evenementProposal3' => $evenementProposal3));                
        }
    }

    public function boutiqueAction()
    {
    	$articles = $this->getDoctrine()->getRepository('BDEAppBundle:Products')->findAll();
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
        {
            $user = $this->getUser();
            $userId = $user->getId();
            dump($userId);
            $panier = $this->getDoctrine()->getRepository('BDEAppBundle:Cart')->findByUser($userId);
            return $this->render('BDEAppBundle:Default:boutique.html.twig', array('articles' => $articles, 'panier' => $panier ));
        }
        else
        {
            return $this->render('BDEAppBundle:Default:boutique.html.twig', array('articles' => $articles));           
        }
    }
/*
    public function inscriptionAction(Request $request)
    {
        $panier = $this->getDoctrine()->getRepository('BDEAppBundle:Cart')->findAll();
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('save', SubmitType::class, array('label' => 'Create Post'))
            ->getForm();

         $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {            
            $user = $form->getData();
            return $this->redirectToRoute('bde_app_inscription');
        }
        return $this->render('BDEAppBundle:Default:inscription.html.twig', array('Panier' => $panier, 'form' => $form->createView()));
    }
*/
    
    public function propositionsAction(Request $request)
    {
    	$propositions = $this->getDoctrine()->getRepository('BDEAppBundle:ActivityProposal')->findAll();
        $activityProposal = new ActivityProposal();
        $form = $this->createFormBuilder($activityProposal)
            ->add('title', TextType::class, array('label' => 'Titre'))
            ->add('description', TextareaType::class, array(
                     'label' => 'Description'
                ))
            ->add('Envoyer', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $activityProposal = $form->getData();
            $activityProposal->setLikeActivity(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($activityProposal);
            $em->flush();
            return $this->redirectToRoute('bde_app_propositions');
        }
        
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
        {
            $user = $this->getUser();
            $userId = $user->getId();
            dump($userId);
            $Panier = $this->getDoctrine()->getRepository('BDEAppBundle:Cart')->findByUser($userId);
            return $this->render('BDEAppBundle:Default:propositions.html.twig', array('propositions' => $propositions, 'Panier' => $Panier, 'form' => $form->createView()));
        }
        else
        {
            return $this->render('BDEAppBundle:Default:propositions.html.twig', array('propositions' => $propositions));
        }
    }

    public function panierAction()
    {
    	$article = $this->getDoctrine()->getRepository('BDEAppBundle:Products')->findAll();
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
        {
            $user = $this->getUser();
            $userId = $user->getId();
            dump($userId);
            $Panier = $this->getDoctrine()->getRepository('BDEAppBundle:Cart')->findByUser($userId);
            $total = 0;
            foreach ($Panier as $value) 
            {
                $total += $value->getProduct()->getPrice();
            }            
            return $this->render('BDEAppBundle:Default:panier.html.twig', array('Panier' => $Panier, 'article' => $article, 'total' => $total));
        }
        else
        {
            return $this->render('BDEAppBundle:Default:panier.html.twig', array('article' => $article));
        }
    }

    public function evenementAction()
    {
    	$events = $this->getDoctrine()->getRepository('BDEAppBundle:Activity')->findAll();
        $datejour = new \DateTime("now");
        $state = array();
        foreach ($events as $event) {
            $datefin = $event->getDateActivity();

            $dfin = explode("/", $datefin->format("d/m/Y"));
            $djour = explode("/", $datejour->format("d/m/Y"));

            $finab = $dfin[2].$dfin[1].$dfin[0];
            $auj = $djour[2].$djour[1].$djour[0];
            if ($auj>$finab)
            {
                $state[$event->getId()] = "fini";
            }
            else
            {
                $state[$event->getId()] = "aVenir";
            }
        }
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
        {
            $user = $this->getUser();
            $userId = $user->getId();
            dump($userId);
            $Panier = $this->getDoctrine()->getRepository('BDEAppBundle:Cart')->findByUser($userId);



            return $this->render('BDEAppBundle:Default:evenement.html.twig', array('events' => $events, 'state' => $state, 'Panier' => $Panier));       
        }
        else
        {
            return $this->render('BDEAppBundle:Default:evenement.html.twig', array('events' => $events, 'state' => $state));
        }
    }

    public function articleAction($id)
    {
    	$article = $this->getDoctrine()->getRepository('BDEAppBundle:Products')->find($id);
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
        {
            $user = $this->getUser();
            $userId = $user->getId();
            dump($userId);
            $Panier = $this->getDoctrine()->getRepository('BDEAppBundle:Cart')->findByUser($userId);
            return $this->render('BDEAppBundle:Default:article.html.twig', array('article' => $article, 'Panier' => $Panier));
        }
        else
        {
            return $this->render('BDEAppBundle:Default:article.html.twig', array('article' => $article));        
        }        
    }

    public function detailEvenementAction($id, Request $request)
    {
        $comment = $this->getDoctrine()->getRepository('BDEAppBundle:Commentary')->findAll();
        $evenement = $this->getDoctrine()->getRepository('BDEAppBundle:Activity')->find($id);
        $picture = new Picture();
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $picture->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('upload_directory'),
                $fileName
            );


            $picture = $form->getData();
            $picture->setActivityId($id);
            $picture->setFileName($fileName);
            $picture->setActivity($evenement);

            $em = $this->getDoctrine()->getManager();
            $em->persist($picture);
            $em->flush();

            return $this->redirect($request->getUri());
        }

        $commentary = new Commentary();
        $datejour = new \DateTime("now");
        $form2 = $this->createForm(CommentaryType::class, $commentary);
        $form2->handleRequest($request);
        if ($form2->isSubmitted() && $form2->isValid()) 
        {
            $commentary = $form2->getData();
            $commentary->setUser($this->getUser()->getUsername());
            $commentary->setDateCommentary($datejour);

            $em = $this->getDoctrine()->getManager();
            $em->persist($commentary);
            $em->flush();

            return $this->redirect($request->getUri());
        }


		$activityPropose = $this->getDoctrine()->getRepository('BDEAppBundle:ActivityProposal')->findAll();
        $activityPicture = $this->getDoctrine()->getRepository('BDEAppBundle:Picture')->findByActivity($id);
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
        {
            $user = $this->getUser();
            $userId = $user->getId();
            dump($userId);
            $Panier = $this->getDoctrine()->getRepository('BDEAppBundle:Cart')->findByUser($userId);
            return $this->render('BDEAppBundle:Default:detailEvenement.html.twig', array('evenement' => $evenement, 'Panier' => $Panier, 'activity' => $activityPropose, 'picture' => $activityPicture, 'form' => $form->createView(), 'form2' => $form2->createView(), 'comment' => $comment));
        }
        else
        {
        return $this->render('BDEAppBundle:Default:detailEvenement.html.twig', array('evenement' => $evenement, 'activity' => $activityPropose, 'picture' => $activityPicture, 'form' => $form->createView(), 'form2' => $form2->createView(), 'comment' => $comment));        
        }        
    }

    public function deleteArticleAction($id)
    {
    	$em = $this->getDoctrine()->getManager();

		$product = $em->getRepository('BDEAppBundle:Cart')->find($id);

		$em->remove($product);
		$em->flush();


        return $this->redirectToRoute('bde_app_panier');
    }

    public function addArticleAction($id)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->getUser();
            $userId = $user->getId();
        }
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('BDEAppBundle:Products')->find($id);
    	$newArticlePanier = new Cart();
    	$newArticlePanier->setQuantity(1);
    	$newArticlePanier->setProduct($product);
        $newArticlePanier->setUser($user);
		  
		$em->persist($newArticlePanier);
		$em->flush();


        return $this->redirectToRoute('bde_app_panier');
    }

    public function addLikeAction($idEvenement)
    {
    	$em = $this->getDoctrine()->getManager();
    	$evenement = $em->getRepository('BDEAppBundle:ActivityProposal')->find($idEvenement);

    	$nbLike = $evenement->getLikeActivity();
    	$nbLike += 1;

		$evenement->setLikeActivity($nbLike);
		$em->flush();

        return $this->redirectToRoute('bde_app_propositions');
    }

    public function eventRegisterAction($id)
    {

        $user = $this->getUser();
        $userId = $user->getId();
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BDEAppBundle:Inscription');

        $qb = $repository->createQueryBuilder('i');
        $qb->where('i.user = :user')
            ->setParameter('user', $userId)
           ->andWhere('i.activity = :activity')
            ->setParameter('activity', $id);

        $inscrit = $qb->getQuery()->getResult();

        if ($inscrit)
        {
            throw new Exception("Vous êtes déjà inscrit pour cette activité !", 1);
        }

        $em = $this->getDoctrine()->getManager();
        $inscription = new Inscription();
        $user = $this->getUser();
        $inscription->setUser($user);
        $inscription->setActivity($id);
        $em->persist($inscription);
        $em->flush();
        return $this->redirectToRoute('bde_app_homepage');
    }

    public function adminAction($id)
    {
        $events = $this->getDoctrine()->getRepository('BDEAppBundle:Activity')->find($id);
        $inscrits = $this->getDoctrine()->getRepository('BDEAppBundle:Inscription')->findByActivity($id);
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
        {
            $user = $this->getUser();
            $userId = $user->getId();
            dump($userId);
            $Panier = $this->getDoctrine()->getRepository('BDEAppBundle:Cart')->findByUser($userId);
            return $this->render('BDEAppBundle:Default:administration.html.twig', array('evenement' => $events, 'Panier' => $Panier, 'inscrits' => $inscrits));       
        }

        return $this->render('BDEAppBundle:Default:administration.html.twig', array('evenement' => $events, 'inscrits' => $inscrits));  
    }
/*
    public function uploadAction($id, $file)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $picture = new Picture();
        $picture->setFile($file)
        $picture->uploadPicture();
        $em->persist($picture);
        $em->flush();
    }
*/

    public function addDateAction($idEvenement, Request $request)
    {
        $user = $this->getUser();
        $userId = $user->getId();
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BDEAppBundle:DateProposal');

        $qb = $repository->createQueryBuilder('d');
        $qb->where('d.user = :user')
            ->setParameter('user', $userId)
           ->andWhere('d.activityProposal = :activity')
            ->setParameter('activity', $idEvenement);

        $hasSetDate = $qb->getQuery()->getResult();

        if ($hasSetDate)
        {
            throw new Exception("Vous avez déjà proposez une date pour cette activité !", 1);
        }
        $event = $this->getDoctrine()->getRepository('BDEAppBundle:ActivityProposal')->findOneById($idEvenement);
        $dateProposal = new dateProposal();
        $form = $this->createFormBuilder($dateProposal)
            ->add('dateProposal', DateType::class, array('label' => 'Date proposée'))
            ->add('timeProposal', ChoiceType::class, array(
                     'choices' => array('Matin' => 'Matin', 'Après-midi' => 'Après-midi'),
                     'expanded' => true,
                     'multiple' => false,
                     'label' => 'Période'
                ))
            ->add('Envoyer', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $dateProposal = $form->getData();
            $dateProposal->setUser($this->getUser());
            $dateProposal->setActivityProposal($event);
            $em = $this->getDoctrine()->getManager();
            $em->persist($dateProposal);
            $em->flush();

            return $this->redirectToRoute('bde_app_propositions');
        }

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
        {
            $Panier = $this->getDoctrine()->getRepository('BDEAppBundle:Cart')->findByUser($userId);
            return $this->render('BDEAppBundle:Default:selectionDate.html.twig', array('form' => $form->createView(), 'Panier' => $Panier));
        }
        else
        {
            return $this->render('BDEAppBundle:Default:propositions.html.twig', array('propositions' => $propositions));
        }
    }


    public function adminPageAction(Request $request)
    {
        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $activity = $form->getData();
            $activity->setPictureSource('image/cheval.png');

            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();

            return $this->redirect($request->getUri());
        }
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
        {
            $user = $this->getUser();
            $userId = $user->getId();
            dump($userId);
            $Panier = $this->getDoctrine()->getRepository('BDEAppBundle:Cart')->findByUser($userId);
            return $this->render('BDEAppBundle:Default:administrationPage.html.twig', array('Panier' => $Panier, 'form' => $form->createView()));       
        }

        return $this->render('BDEAppBundle:Default:administrationPage.html.twig');  
    }

    public function dateAdminAction($idEvenement)
    {
        $event = $this->getDoctrine()->getRepository('BDEAppBundle:ActivityProposal')->findOneById($idEvenement);
        $dates = $this->getDoctrine()->getRepository('BDEAppBundle:DateProposal')->findByActivity_proposal($idEvenement);

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
        {
            $user = $this->getUser();
            $userId = $user->getId();
            dump($userId);
            $Panier = $this->getDoctrine()->getRepository('BDEAppBundle:Cart')->findByUser($userId);
            return $this->render('BDEAppBundle:Default:administrationDate.html.twig', array('Panier' => $Panier, 'event' => $event, 'dates' => $dates));       
        }
        return $this->render('BDEAppBundle:Default:administrationDate.html.twig', array('event' => $event, 'dates' => $dates));
    }
}
