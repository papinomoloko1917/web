<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PortfolioController extends Controller
{
    /**
     * Display the Gallery of Taste project page.
     */
    public function galleryOfTaste(): Response
    {
        return Inertia::render('Portfolio/GalleryOfTaste');
    }

    /**
     * Display the NESK project page.
     */
    public function nesk(): Response
    {
        return Inertia::render('Portfolio/NESK');
    }

    /**
     * Display the Dynasty project page.
     */
    public function dynasty(): Response
    {
        return Inertia::render('Portfolio/Dynasty');
    }

    /**
     * Display the KFH project page.
     */
    public function kfh(): Response
    {
        return Inertia::render('Portfolio/KFH');
    }
}
