<?php

namespace Web\Controllers;

use Cms\Models\Page;
use Web\Controllers\AppController;

class PageController extends AppController
{
    public function about()
    {
        $page = Page::find(1);
        $this->setSEO([
            'title' => $page->getName(),
            'url' => route('page.about'),
        ]);
        return view('web::pages.page.index', compact('page'));
    }

    public function shopping()
    {
        $page = Page::find(2);

        $this->setSEO([
            'title' => $page->getName(),
            'url' => route('page.shopping'),
        ]);
        return view('web::pages.page.index', compact('page'));

    }

    public function warranty()
    {
        $page = Page::find(3);

        $this->setSEO([
            'title' => $page->getName(),
            'url' => route('page.warranty'),
        ]);

        return view('web::pages.page.index', compact('page'));

    }

    public function delivery()
    {
        $page = Page::find(4);

        $this->setSEO([
            'title' => trans('web::label.warranty_policy'),
            'url' => route('page.delivery'),
        ]);

        return view('web::pages.page.index', compact('page'));

    }
}
