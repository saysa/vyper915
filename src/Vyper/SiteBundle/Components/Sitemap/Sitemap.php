<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 11/09/2015
 * Time: 14:34
 */

namespace Vyper\SiteBundle\Components\Sitemap;

class Sitemap {

    public function update($option)
    {
        $em         = $option['entity_manager'];
        $router     = $option['router'];
        $app_root   = $option['app_root'];
        $assets     = $option['assets'];
        $request     = $option['request'];

        //-- Contenu xml sitemap
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        $xml .= "<url>\n";
        $xml .= "<loc>http://www.vyper-jmusic.com</loc>\n";
        $xml .= "<changefreq>daily</changefreq>\n";
        $xml .= "<priority>1.0</priority>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://www.vyper-jmusic.com/rss_fil_info.xml</loc>\n";
        $xml .= "<changefreq>daily</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/fr/magazine/actualites</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/fr/magazine</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/fr/actualites</loc>\n";
        $xml .= "<changefreq>daily</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/fr/evenements</loc>\n";
        $xml .= "<changefreq>weekly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/en/events</loc>\n";
        $xml .= "<changefreq>weekly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/fr/videos</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/en/videos</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/fr/concours</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/en/contests</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/fr/contact</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/en/contact</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/en/magazine/news</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/en/magazine</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/en/news</loc>\n";
        $xml .= "<changefreq>daily</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/fr/conditions-utilisation</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/en/conditions-of-use</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/fr/archives</loc>\n";
        $xml .= "<changefreq>daily</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/en/archives</loc>\n";
        $xml .= "<changefreq>daily</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/fr/interviews</loc>\n";
        $xml .= "<changefreq>daily</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/en/interviews</loc>\n";
        $xml .= "<changefreq>daily</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/fr/live-reports</loc>\n";
        $xml .= "<changefreq>daily</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/en/live-reports</loc>\n";
        $xml .= "<changefreq>daily</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/fr/chroniques</loc>\n";
        $xml .= "<changefreq>daily</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/en/chroniques</loc>\n";
        $xml .= "<changefreq>daily</changefreq>\n";
        $xml .= "</url>\n";
        /*
        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/galerie</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";
        */
        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/fr/artistes</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/en/artists</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/fr/jobs</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/en/jobs</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/fr/partenaires</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";

        $xml .= "<url>\n";
        $xml .= "<loc>http://vyper-jmusic.com/en/partners</loc>\n";
        $xml .= "<changefreq>monthly</changefreq>\n";
        $xml .= "</url>\n";



        $articles = $em->getRepository('VyperSiteBundle:Article')->myFindAll();
        foreach($articles as $article)
        {
            $loc = $request->getSchemeAndHttpHost() . $router->generate('showArticle', array('id' => $article->getId(), 'slug' => $article->getSlug()));
            //$lastmod = substr($article->modified, 0, 10);
            $xml .= "<url>\n";
            $xml .= "<loc>".$loc."</loc>\n";
            //$xml .= "<lastmod>".$lastmod."</lastmod>\n";
            $xml .= "<changefreq>never</changefreq>\n";
            $xml .= "<priority>0.8</priority>\n";
            $xml .= "</url>\n";
        }

        $events = $em->getRepository('VyperSiteBundle:Event')->myFindAll();
        foreach($events as $event)
        {
            $loc = $request->getSchemeAndHttpHost() . $router->generate('showEvent', array('id' => $event->getId(), 'slug' => $event->getSlug()));
            $xml .= "<url>\n";
            $xml .= "<loc>".$loc."</loc>\n";
            $xml .= "<changefreq>monthly</changefreq>\n";
            $xml .= "<priority>0.8</priority>\n";
            $xml .= "</url>\n";
        }

        $artists = $em->getRepository('VyperSiteBundle:Artist')->myFindAll();
        foreach($artists as $artist)
        {
            $loc = $request->getSchemeAndHttpHost() . $router->generate('showArtist', array('id' => $artist->getId(), 'slug' => $artist->getSlug()));
            $xml .= "<url>\n";
            $xml .= "<loc>".$loc."</loc>\n";
            $xml .= "<changefreq>weekly</changefreq>\n";
            $xml .= "<priority>0.8</priority>\n";
            $xml .= "</url>\n";
        }
/*
        $themes = Theme::all(array("deleted=?" => false, "showInMenu=?" => true));
        foreach($themes as $theme)
        {
            $loc = BASE_URL . "theme/" . $theme->id . "/1/" . $theme->getTitleUrlFormat($theme->id);
            $xml .= "<url>\n";
            $xml .= "<loc>".$loc."</loc>\n";
            $xml .= "<changefreq>monthly</changefreq>\n";
            $xml .= "<priority>0.5</priority>\n";
            $xml .= "</url>\n";
        }

        $albums = Album::all(array("deleted=?"=>false));
        foreach($albums as $album)
        {
            $loc = BASE_URL . "album/" . $album->id . "/" . $album->getTitleUrlFormat($album->id);
            $xml .= "<url>\n";
            $xml .= "<loc>".$loc."</loc>\n";
            $xml .= "<changefreq>monthly</changefreq>\n";
            $xml .= "<priority>0.7</priority>\n";
            $xml .= "</url>\n";
        }

        $discos = Disco::all(array("deleted=?"=>false));
        foreach($discos as $disco)
        {
            $loc = BASE_URL . "disco/" . $disco->id . "/" . $disco->getStringUrl($disco->id) . ".html";
            $xml .= "<url>\n";
            $xml .= "<loc>".$loc."</loc>\n";
            $xml .= "<changefreq>monthly</changefreq>\n";
            $xml .= "<priority>0.7</priority>\n";
            $xml .= "</url>\n";
        }
*/
        $xml .= "</urlset>\n";

        $fp = fopen("sitemap.xml", 'w+');
        fputs($fp, $xml);
        fclose($fp);

        return $this;
    }
}