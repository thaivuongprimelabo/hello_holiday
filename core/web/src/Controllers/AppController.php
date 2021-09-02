<?php

namespace Web\Controllers;

use App\Http\Controllers\Controller;
use Cms\Models\Config;
use Illuminate\Support\Facades\View;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

class AppController extends Controller
{
    protected $config = null;
    public function __construct()
    {
        $this->getConfig();
    }

    private function getConfig() {
        $config = Config::first();
        $this->config = $config;
        View::share('config', $config);
    }

    public function setSEO($params)
    {
        $title_default = isset($params['title_default']) ? $params['title_default'] : $this->config->web_title;
        $title = isset($params['title']) ? $params['title'] : $this->config->web_title;
        $web_description= isset($params['web_description']) ? $params['web_description'] : $this->config->web_description;
        $web_keywords = isset($params['web_keywords']) ? $params['web_keywords'] : $this->config->web_keywords;
        $url = isset($params['url']) ? $params['url'] : route('home');
        $image = isset($params['image']) ? $params['image'] : $this->config->getWebBanner();

        SEOMeta::setTitleDefault($title_default);
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($web_description);
        SEOMeta::addKeyword($web_keywords);
        SEOMeta::setCanonical($url);
        
        OpenGraph::setDescription($web_description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl($url);
        OpenGraph::setSiteName($url);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'vi_VN');
        OpenGraph::addImage($image);

        TwitterCard::setTitle($title);
        TwitterCard::setSite($url);
        TwitterCard::setImages($image);
        TwitterCard::setDescription($web_description);

        JsonLd::setTitle($title . '-' . $title_default);
        JsonLd::setDescription($web_description);
        JsonLd::setType('WebSite');
        JsonLd::addImage($image);
    }
}
