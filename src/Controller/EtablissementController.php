<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Etablissement;
use App\Form\EtablissementType;
use App\Form\EtablissementMapType;
use App\Repository\EtablissementRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

/**
 *
 * @Route("/etablissement")
 */
class EtablissementController extends AbstractController
{

    /* Index */

    /**
     * @Route("/index", name="etablissement")
     */
    public function index(): Response
    {
        return $this->render('etablissement/index.html.twig', [
            'controller_name' => 'EtablissementController',
        ]);
    }

    /* Fonction pour créer un nouvel établissement */

    /**
     * @Route("/etablissement/create", name="etablissementcreate")
     */
    public function create_etablissement(): Response
    {

        $entityManager = $this->getDoctrine()->getManager();

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

        $entityManager->persist($etablissement);

        $entityManager->flush();

        return new Response('Nouveau établissement de créé avec pour id: '.$etablissement->getId());
    }

    /* Filtre Toute la table */

    /**
     * @Route("/etablissements", name="etablissement_showall")
     */
    public function showAll(Request $request, PaginatorInterface $paginator)
    {
        $etablissements = $this->getDoctrine()->getRepository(Etablissement::class)->findAll();

        $articles = $paginator->paginate(
            $etablissements,
            $request->query->getInt('page', 1),
            10000
        );

        return $this->render('etablissement/etablissement.html.twig', array(
            'articles' => $articles, 'vu'=>' Toute la table'));
    }

    /* Filtre Département */

    /**
    * @Route("/departement/{departement}", name="etablissement_departement")
    */
    public function showDepartement(string $departement, Request $request, PaginatorInterface $paginator) {

        $etablissements = $this->getDoctrine()
            ->getRepository(Etablissement::class)
            ->findByDepartement($departement);

        if (!$etablissements) {
            throw $this->createNotFoundException(
                "Aucun établissement avec ce département ".$departement
            );
        }

        $articles = $paginator->paginate(
            $etablissements,
            $request->query->getInt('page', 1),
            50
        );

        return $this->render('etablissement/etablissement.html.twig', array(
            'articles' => $articles,'vu'=>' Département : '.$departement));

    }

    /* Filtre Commune */

    /**
    * @Route("/commune/{commune}", name="etablissement_commune")
    */
    public function showCommune(string $commune, Request $request, PaginatorInterface $paginator) {

        $etablissements = $this->getDoctrine()
            ->getRepository(Etablissement::class)
            ->findByCommune($commune);

        if (!$etablissements) {
            throw $this->createNotFoundException(
                "Aucun établissement avec cette commune ".$commune
            );
        }

        $articles = $paginator->paginate(
            $etablissements,
            $request->query->getInt('page', 1),
            50
        );

        return $this->render('etablissement/etablissement.html.twig', array(
            'articles' => $articles,'vu'=>' Commune : '.$commune));

    }

    /* Filtre Région */

    /**
    * @Route("/region/{region}", name="etablissement_region")
    */
    public function showRegion(string $region, Request $request, PaginatorInterface $paginator) {

        $etablissements = $this->getDoctrine()
            ->getRepository(Etablissement::class)
            ->findByRegion($region);

        if (!$etablissements) {
            throw $this->createNotFoundException(
                "Aucun établissement avec cette région ".$region
            );
        }

        $articles = $paginator->paginate(
            $etablissements,
            $request->query->getInt('page', 1),
            50
        );

        return $this->render('etablissement/etablissement.html.twig', array(
            'articles' => $articles,'vu'=>' Région : '.$region));
    }

    /* Filtre Académie */

    /**
    * @Route("/academie/{academie}", name="etablissement_academie")
    */
    public function showAcademie(string $academie, Request $request, PaginatorInterface $paginator) {

        $etablissements = $this->getDoctrine()
            ->getRepository(Etablissement::class)
            ->findByAcademie($academie);

        if (!$etablissements) {
            throw $this->createNotFoundException(
                "Aucun établissement avec cette académie ".$academie
            );
        }

        $articles = $paginator->paginate(
            $etablissements,
            $request->query->getInt('page', 1),
            50
        );

        return $this->render('etablissement/etablissement.html.twig', array(
            'articles' => $articles,'vu'=>' Académie : '.$academie));
    }

    /* Filtre Secteur */

    /**
    * @Route("/secteur/{secteur}", name="etablissement_secteur")
    */
    public function showSecteur(string $secteur, Request $request, PaginatorInterface $paginator) {

        $etablissements = $this->getDoctrine()
          ->getRepository(Etablissement::class)
          ->findBySecteur($secteur);

        if (!$etablissements) {
            throw $this->createNotFoundException(
                "Aucun établissement avec ce secteur ".$secteur
            );
        }

        $articles = $paginator->paginate(
            $etablissements,
            $request->query->getInt('page', 1),
            50
        );

        return $this->render('etablissement/etablissement.html.twig', array(
            'articles' => $articles,'vu'=>' Secteur : '.$secteur));
    }

    /* Filtre Nature */

    /**
    * @Route("/nature/{nature}", name="etablissement_nature")
    */
    public function showNature(string $nature, Request $request, PaginatorInterface $paginator) {

        $etablissements = $this->getDoctrine()
            ->getRepository(Etablissement::class)
            ->findByNature($nature);

        if (!$etablissements) {
            throw $this->createNotFoundException(
                "Aucun établissement avec cette nature ".$nature
            );
        }

        $articles = $paginator->paginate(
            $etablissements,
            $request->query->getInt('page', 1),
            50
        );

        return $this->render('etablissement/etablissement.html.twig', array(
            'articles' => $articles,'vu'=>' Nature : '.$nature));
    }

    /* Formulaire pour modifier un établissement*/

    /**
    * @Route("/{id}/edit", name="etablissement_edit")
    */
    public function etablissementAction(Etablissement $etablissement, Request $request): Response {
        $etablissementForm = $this->createForm(EtablissementType::class, $etablissement);

        $etablissementForm->handleRequest($request);

        if ($etablissementForm->isSubmitted() && $etablissementForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etablissement);
            $em->flush();
        }

        return $this->render('etablissement/etablissementFormEdit.html.twig', array(
        'form' => $etablissementForm->createView(), 'vu'=>"Modifier l'établissement suivant :"));
    }

    /* Formulaire pour ajouter un établissement*/

    /**
    *
    * @Route("/add", name="etablissement_add")
    * @Method({"GET", "POST"})
    */
    public function etablissementNewAction(Request $request): Response {
        $etablissement = new Etablissement();
        $etablissementForm = $this->createFormBuilder($etablissement)
            ->add('nom', TextType::class)
            ->add('nature', TextType::class)
            ->add('secteur', TextType::class)
            ->add('longitude', NumberType::class)
            ->add('latitude', NumberType::class)
            ->add('adresse', TextType::class)
            ->add('departement', NumberType::class)
            ->add('commune', TextType::class)
            ->add('region', TextType::class)
            ->add('academie', TextType::class)
            ->add('date_ouverture', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Sauvegarder'))
            ->getForm();

        $etablissementForm->handleRequest($request);

        if ($etablissementForm->isSubmitted() && $etablissementForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etablissement);
            $em->flush();

        return $this->redirectToRoute('etablissement_edit', array('id' => $etablissement->getId()));
        }

        return $this->render('etablissement/etablissementFormAdd.html.twig', array('etablissement' => $etablissement,
        'form' => $etablissementForm->createView(), 'vu'=>"Ajouter un établissement :"));
    }

    /**
    * @Route("/delete/{id}", name="etablissement_delete")
    */
    public function etablissementDeleteAction(Etablissement $etablissement): Response {
        $em = $this->getDoctrine()->getManager();
        $em->remove($etablissement);
        $em->flush();

        return $this->render('etablissement/etablissementFormDelete.html.twig', array('vu'=>"Supprimer un établissement :"));
    }

    /* Cartographie */

    /**
     * @Route("/cartographieCommune/{commune}", name="cartographie_commune")
     */
    public function mapCommune(string $commune)
    {
        $etablissements =$this->getDoctrine()
            ->getRepository(Etablissement::class)
            ->findBy(array('commune' => $commune));

        return $this->render('etablissement/mapCommune.html.twig' ,array('etablissements'=>$etablissements, 'vu'=>$commune));
    }

    /**
     * @Route("/cartographieCommune", name="cartographie")
     */
    public function map(Request $request, EtablissementRepository $etablissementRepository): Response
    {
        $etablissementMapForm = $this->createForm(EtablissementMapType::class);

        $etablissementMapForm->handleRequest($request);

        $etablissements = new Etablissement();

        if ($etablissementMapForm->isSubmitted() && $etablissementMapForm->isValid()) {
            $commune=$etablissementMapForm->getData();

            $etablissements =$this->getDoctrine()
                ->getRepository(Etablissement::class)
                ->findBy(array('commune' => $commune));
        }

        return $this->render('etablissement/map.html.twig', array('etablissements'=>$etablissements,
        'form' => $etablissementMapForm->createView()));
    }

    /* Fonction pour voir un établissement*/

    /**
     * @Route("/{id}", name="etablissement_show")
     * @ParamConverter("etablissement", class="App:Etablissement")
     */
    public function show(Etablissement $etablissement): Response
    {
        if (!$etablissement) {
            throw $this->createNotFoundException(
                "Aucun établissement avec cet id ".$id
            );
        }

        return new Response("Voici l'établissement : ".$etablissement->getNom());
    }

}
