<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 03/10/2014
 * Time: 13:49
 */

namespace Vyper\SiteBundle\Components\FluxRss;
use Symfony\Component\Routing\Router;

class FluxRss {

    public function update($option)
    {
        $em         = $option['entity_manager'];
        $router     = $option['router'];
        $app_root   = $option['app_root'];
        $assets     = $option['assets'];
        $request     = $option['request'];
        $articles = $em->getRepository('VyperSiteBundle:Article')->showRecentArticles(25);

        /*$url = $this->get('router')->generate(
            'oc_platform_view', // 1er argument : le nom de la route
            array('id' => 5)    // 2e argument : les valeurs des paramètres
        );*/

        $copy = "Copyright © 2014. vyper-jmusic.com - Vyper Japanese Music . Tous droits réservés.";

        //-- On affecte le futur contenu du fichier xml
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">\n";
        $xml .= "<channel>\n";
        $xml .= "<title>Japan FM</title>\n";
        $xml .= "<link>http://www.japanfm.fr</link>\n";
        $xml .= "<description>Toutes les news de japanfm.fr</description>\n";
        $xml .= "<language>fr</language>\n";
        $xml .= "<copyright>$copy</copyright>\n";
        $xml .= "<image>\n";
        $xml .= "	<title>Japan FM</title>\n";
        $xml .= "	<url>". $request->getSchemeAndHttpHost() ."/assets/img/logo.png</url>\n";
        $xml .= "	<link>http://www.japanfm.fr</link>\n";
        $xml .= "</image>\n";
        $xml .= "<atom:link href=\"" . $request->getSchemeAndHttpHost() . "/rss_fil_info.xml\" rel=\"self\" type=\"application/rss+xml\" />\n";

        foreach($articles as $article)
        {
            $loc = $request->getSchemeAndHttpHost() . $router->generate('showArticle', array('id' => $article->getId(), 'slug' => $article->getSlug()));
            $date = $article->getModified()->format("D, j M Y H:i:s +0200");
            $art = str_replace("&", "&amp;", $article->getDescription());

            $art .= "&lt;p&gt;";
            $path_img = $request->getSchemeAndHttpHost() . $assets->getUrl($article->getPicture()->getPath('flux-rss'));
            $art .= "&lt;img src=&quot;" . $path_img . "&quot; alt=&quot;&quot; /&gt;";

            $art .= "&lt;/p&gt;";

            $title  = str_replace("&", "&amp;", $article->getTitle());


            $xml .= "<item>\n";
            $xml .= "<title>" . $title . "</title>\n";
            $xml .= "<link>" . $loc . "</link>\n";
            $xml .= "<pubDate>" . $date . "</pubDate>\n";
            $xml .= "<description>" . $art . "</description>\n";
            $xml .= "<guid>".$loc."</guid>\n";
            $xml .= "</item>\n";

        }


        $xml .= "</channel>\n";
        $xml .= "</rss>\n";


        $fp = fopen(dirname($app_root) . "/web/rss_fil_info.xml", 'w+');
        fputs($fp, $xml);
        fclose($fp);

        return $this;
    }
} 