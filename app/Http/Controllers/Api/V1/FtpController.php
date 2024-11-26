<?php

namespace App\Http\Controllers\Api\V1;

use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FtpController extends Controller
{
    use HttpResponses;

    public function list()
    {
        // Acessar o sistema de arquivos FTP
        $files = Storage::disk('ftp')->files('/');

        // Remover o prefixo "folder_name/" e a extensão dos arquivos
        $processedFiles = array_map(function ($file) {
            // Extrair o nome do arquivo sem extensão
            return pathinfo($file, PATHINFO_FILENAME);
        }, $files);

        $items = $processedFiles;

        return response()->view('components.select-picker', compact('items'));
    }
}
