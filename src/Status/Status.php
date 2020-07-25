<?php

namespace App\Status;

use Symfony\Component\HttpFoundation\Response;

class Status
{
    /**
     * \Twig\Environment $twig
     */
    private $twig;

    public function __construct(\Twig\Environment $twig)
    {
        $this->twig = $twig;
    } 

    /**
     * return bootstrap alert in html
     */
    public function alert(String $type, String $text): String
    {
        return $this->twig->render('alert.html.twig', [
            'type' => $type,
            'text' => $text
        ]);
    }

    public function pageStatus(Response $response, String $type, String $text): Response
    {
        $content = 
            '<html>'
                .$this->getHead().
                '<body>'.
                    $this->alert($type, $text).
                    $this->getScripts().
                '</body>
            </html>';

        $response->setContent($content);

        return $response;
    }

    public function pageOpened(Response $response): Response
    {
        return $this->pageStatus($response, 'success', 'It\'s opened !');
    }

    public function pageClosed(Response $response): Response
    {
        return $this->pageStatus($response, 'danger', 'It\'s closed !');
    }

    public function getHead()
    {
        return $this->twig->render('head.html.twig');
    }

    public function getScripts()
    {
        return $this->twig->render('scripts.html.twig');
    }
}