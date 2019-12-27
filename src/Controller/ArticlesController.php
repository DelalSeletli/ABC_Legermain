<?php

namespace App\Controller;

use App\Repository\ArticleImagesRepository;
use App\Repository\ArticleRepository;
use App\Repository\ImageRepository;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/charpente", name="charpente")
     */
    public function charpente(ArticleRepository $repo,ImageRepository $repo1, ArticleImagesRepository $repo2)
    {
        $articles = $repo->findBy(['category' => 1]);
        $list = new Array_();

        foreach($articles as $article) {
            $idImage = $repo2->findOneBy( ['article' => $article->getId()] );
            array_push( $list, $idImage->getImage() );
        }




        return $this->render( 'articles/charpente.html.twig', [
            'controller_name' => 'ArticlesController',  'articles' =>$articles, 'images' => $list
        ] );
    }
    /**
     * @Route("/couverture", name="couverture")
     */
    public function couverture(ArticleRepository $repo)
    {
        $articles = $repo->findBy(array('category'=>'Couverture'));
        return $this->render( 'articles/couverture.html.twig', [
            'controller_name' => 'ArticlesController', 'articles' =>$articles
        ] );
    }
    /**
     * @Route("/ouvrageSpecifique", name="ouvrage")
     */
    public function ouvrage(ArticleRepository $repo)
    {
        $articles = $repo->findBy(array('category'=>'Ouvrages spécifiques'));
        return $this->render( 'articles/ouvrage.html.twig', [
            'controller_name' => 'ArticlesController', 'articles' =>$articles
        ] );
    }

}
