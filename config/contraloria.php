<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Folder Path Save File
    |--------------------------------------------------------------------------
    |
    | Folder in which the pdf file returned by the comptroller will be saved
    |
    */
    'folder_path_save_file' => env('CONTRALORIA_FOLDER_PATH_SAVE', 'miguelgarces/contraloria/'),

    /*
    |--------------------------------------------------------------------------
    | Disk Storage
    |--------------------------------------------------------------------------
    |
    | Filesystem disk name to create the save folder of the pdf 
    | returned by the comptroller
    |
    */
    'disk_storage' => env('CONTRALORIA_DISK_STORAGE', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Path PDFTOTEXT
    |--------------------------------------------------------------------------
    |
    | Path to PDFTOTEXT binary
    |
    */
    'path_pdftotext' => ENV('CONTRALORIA_PATH_PDFTOTEXT', '/usr/local/bin/pdftotext'),
    
];