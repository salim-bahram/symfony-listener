<?php

namespace App\Status;

use Symfony\Component\HttpFoundation\Response;

class Status
{
    /**
     * return bootstrap alert in html
     */
    public function alert(String $type, String $text): String
    {
        return "
        <h1 class='m-4 p-4 text-center'>Horaires d'ouverture</h1>
        <h4 class='m-4 p-4 text-center'>Ouvert du lundi au vendredi de 8h à 18h</h4>
        <div class='container'>
            <div class='m-4 p-5 text-center alert alert-".$type." alert-dismissible fade show' role='alert'>
                <strong>".$text."</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>
        </div>";
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
        return 
        '<head>
            <meta charset="UTF-8">
            <title>Status site</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        </head>';
    }

    public function getScripts()
    {
        return
        '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>';
    }
}