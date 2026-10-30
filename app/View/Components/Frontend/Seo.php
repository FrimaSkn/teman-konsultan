<?php

namespace App\View\Components\Frontend;

use App\Support\Seo\SeoResolver;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View as ViewFactory;
use Illuminate\View\Component;

class Seo extends Component
{
    public function __construct(public ?Model $model = null)
    {
    }

    public function render(): View
    {
        $seo = app(SeoResolver::class)->resolve(
            $this->model,
            ViewFactory::getSection('title') ?: null,
            ViewFactory::getSection('meta_description') ?: null,
        );

        return view('components.frontend.seo', [
            'seo' => $seo,
        ]);
    }
}
