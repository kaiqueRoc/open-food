<?php

namespace App\Services;

use App\Helpers\Products;
use App\Mail\AlertEmail;
use Illuminate\Support\Facades\Mail;

class EmailService
{

    public function alertImportProducts($importedProducts)
    {

        $data = 'Todos os ' . $importedProducts . ' produtos do dia foram importados';

        return Mail::send(new AlertEmail($data));


    }

    public function alertErroImportProducts($page, $error = null)
    {
        $data = 'Ocorreu erro na importação da pagina ' . $page;
        if(isset($error)){
            $errorImport = 'Ocorreu erro na importação ' . $error;
            Mail::send(new AlertEmail($errorImport));
        }

        return Mail::send(new AlertEmail($data));
    }
    public function alertErroNotFoundProducts($responde)
    {
        $data = 'Ocorreu erro na importação do produto' . $responde;

        return Mail::send(new AlertEmail($data));

    }
    public function alertTotalImportProducts($importedProducts, $currentPage)
    {
        $data = 'Total de podutos importados até o momento ' . $importedProducts . ' Pagina verificada ' . $currentPage;

        return Mail::send(new AlertEmail($data));

    }
}