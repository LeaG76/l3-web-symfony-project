<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Entity\Etablissement;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

/**
 *
 * @Route("/commentaire")
 */
class CommentaireController extends AbstractController
{

    /* Index */

    /**
     * @Route("/index", name="commentaire")
     */
    public function index(): Response
    {

        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }

    /* Fonction pour créer un nouveau commentaire */

    /**
     * @Route("/create", name="commentairecreate")
     */
    public function create_commentaire(): Response
    {
        $etablissement = new Etablissement();
        $etablissement->setNom('UFR Sciences et Techniques');
        $etablissement->setNature('Université');
        $etablissement->setSecteur('Public');
        $etablissement->setLongitude(0.1291150003671646);
        $etablissement->setLatitude(49.4958610534668);
        $etablissement->setAdresse('27 Rue Philippe Lebon');
        $etablissement->setDepartement('76');
        $etablissement->setCommune('Le Havre');
        $etablissement->setRegion('Normandie');
        $etablissement->setAcademie('Rouen');
        $etablissement->setDateOuverture('22-03-2021');

        $commentaire = new Commentaire();
        $commentaire->setNomAuteur("Madame Loisel");
        $commentaire->setDateCreation(\DateTime::createFromFormat('Y-m-d', date('Y-m-d')));
        $commentaire->setNote(2);
        $commentaire->setTexte("Peut mieux faire");
        $commentaire->setEtablissement($etablissement);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($etablissement);
        $entityManager->persist($commentaire);

        $entityManager->flush();

        return new Response('Nouveau commentaire de créé avec pour id : '.$commentaire->getId()." et l'établissement d'id : ".$etablissement->getId());
    }

    /* Filtre Toute la Table */

    /**
     * @Route("/commentaires", name="commentaire_showall")
     */
    public function showAll(Request $request, PaginatorInterface $paginator)
    {
        $commentaires = $this->getDoctrine()->getRepository(Commentaire::class)->findAll();

        $articles = $paginator->paginate(
            $commentaires,
            $request->query->getInt('page', 1),
            50
        );

        return $this->render('commentaire/commentaire.html.twig', array(
            'articles' => $articles, 'vu'=>' Toute la table'));
    }

    /* Formulaire pour modifier un commentaire */

    /**
    * @Route("/{id}/edit", name="commentaire_edit")
    */
    public function commentaireAction(Commentaire $commentaire, Request $request): Response {

        $commentaireForm = $this->createForm(CommentaireType::class, $commentaire);

        $commentaireForm->handleRequest($request);

        if ($commentaireForm->isSubmitted() && $commentaireForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();
        }

        return $this->render('commentaire/commentaireFormEdit.html.twig', array(
            'form' => $commentaireForm->createView(), 'vu'=>"Modifier le commentaire suivant :"));
    }

    /* Formulaire pour modifier les commentaires d'un établissement */

    /**
    * @Route("/etablissement/{id}/edit", name="commentaireEtab_edit")
    */
    public function commentaireEtabAction(Commentaire $commentaire, Request $request): Response {
        $commentaireForm = $this->createForm(CommentaireType::class, $commentaire);

        $commentaireForm->handleRequest($request);

        if ($commentaireForm->isSubmitted() && $commentaireForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();
        }

        $nom=$commentaire->getEtablissement()->getNom();

        return $this->render('commentaire/commentaireEtabFormEdit.html.twig', array(
        'form' => $commentaireForm->createView(), 'vu'=>"Modifier le commentaire de l'établissement ".$nom." :"));
    }

    /* Formulaire pour ajouter un commentaire pour un établissement */

    /**
    *
    * @Route("/etablissement/add/{id}", name="commentaireEtab_add")
    * @Method({"GET", "POST"})
    */
    public function commentaireEtabNewAction(int $id, Request $request): Response {

        $commentaire = new Commentaire();
        
        $commentaire->setEtablissement($this->getDoctrine()
            ->getRepository(Etablissement::class)
            ->findOneBy(['id' => $id]));

        $commentaireForm = $this->createForm(CommentaireType::class, $commentaire);

        $commentaireForm->handleRequest($request);

        if ($commentaireForm->isSubmitted() && $commentaireForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();

        return $this->redirectToRoute('commentaireEtab_edit', array('id' => $commentaire->getId()));
        }

        $id_etab = $commentaire->getEtablissement()->getId();
        $nom = $commentaire->getEtablissement()->getNom();

        return $this->render('commentaire/commentaireEtabFormAdd.html.twig', array('commentaire' => $commentaire,
        'form' => $commentaireForm->createView(), 'vu'=>"Ajouter un commentaire pour l'établissement ".$nom." (id=".$id_etab.") :"));
    }

    /**
    * @Route("/{id}/delete", name="commentaire_delete")
    */
    public function commentaireDeleteAction(Commentaire $commentaire): Response {
        $em = $this->getDoctrine()->getManager();
        $em->remove($commentaire);
        $em->flush();

        return $this->render('commentaire/commentaireFormDelete.html.twig', array('vu'=>"Supprimer un commentaire :"));
    }

    /* Fonction pour voir les commentaires d'un établissement */

    /**
     * @Route("/{id}", name="commentaireEtab_show")
     */
    public function showCommentaires(int $id): Response {
        $entityManager = $this->getDoctrine()->getManager();

        $etablissement=$this->getDoctrine()
            ->getRepository(Etablissement::class)
            ->find($id);

        $entityManager->persist($etablissement);

        $nom = $etablissement->getNom();

        $commentaires=$etablissement->getCommentaires();

        $nb=$commentaires->count();

        return $this->render('commentaire/commentaireVue.html.twig', array(
            'articles' => $commentaires, 'nb'=>$nb, 'vu'=>"Les commentaires de l'établisement ".$nom));
    }

    /* Fonction pour voir les commentaires d'un établissement pour modifier le commentaire*/

    /**
     * @Route("/showEdit/{id}", name="commentaireEtab_showToEdit")
     */
    public function showEditCommentaires(int $id): Response {
        $entityManager = $this->getDoctrine()->getManager();

        $etablissement=$this->getDoctrine()
            ->getRepository(Etablissement::class)
            ->find($id);

        $entityManager->persist($etablissement);

        $nom = $etablissement->getNom();

        $commentaires=$etablissement->getCommentaires();

        $nb=$commentaires->count();

        return $this->render('commentaire/commentaireEtabVue.html.twig', array(
            'articles' => $commentaires, 'nb'=>$nb, 'vu'=>"Les commentaires de l'établisement ".$nom));
    }

    /* Fonction pour voir un commentaire avec le nom de l'établissement concerné */

    /**
     * @Route("/etablissement/{id}", name="commentaire_show_with_etablissement")
     */
    public function showWithEtablissment(int $id): Response
    {
        $commentaire = $this->getDoctrine()
        ->getRepository(Commentaire::class)
        ->find($id);

        if (!$commentaire) {
            throw $this->createNotFoundException(
                "Aucun commentaire avec cet id ".$id
            );
        }

        $etablissement = $commentaire->getEtablissement()->getNom();

        return new Response('Etablissement : '.$etablissement.'</br></br>Commentaire : «'.$commentaire->getTexte().'» - Note : '.$commentaire->getNote().'</br>Le '.$commentaire->getDateCreation()->format('Y-m-d').', par '.$commentaire->getNomAuteur().'.');
    }

    /* Fonction pour voir un commentaire mais sans le nom de l'établissement concerné */

    /**
     * @Route("/show/{id}", name="commentaire_show_jointure")
     */
    public function showJointure(int $id): Response
    {
        $commentaire = $this->getDoctrine()
        ->getRepository(Commentaire::class)
        ->findOneByIdJoinedToEtablissement($id);

        if (!$commentaire) {
            throw $this->createNotFoundException(
                "Aucun commentaire avec cet id ".$id
            );
        }

        $etablissement = $commentaire->getEtablissement();

        return new Response('Commentaire : «'.$commentaire->getTexte().'» - Note : '.$commentaire->getNote().'</br>Le '.$commentaire->getDateCreation()->format('Y-m-d').', par '.$commentaire->getNomAuteur().'.');
    }
}
